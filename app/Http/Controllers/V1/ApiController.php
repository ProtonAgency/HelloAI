<?php
namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;

use App\Analysis\TextAnalysis;
use App\ArtificialIntellegence;
use App\Rules\Host;

use phpseclib\Net\SFTP;
use phpseclib\Crypt\RSA;

class ApiController extends \App\Http\Controllers\Controller {

	/**
	 *
	 * Create Artifical Intellegence Model
	 *
	 * @param Request $request
	 */
	public function createModel(Request $request)
	{
		$request->validate([
			'name' => 'required|string',
			'type' => 'required|string',
		]);

		$types = [
			'text_analysis',
		];

		if(!in_array($request->input('type'), $types))
		{
			return response()->json([
				'success' => false,
				'error' => 'Invalid model type',
			]);
		}

		$ai = ArtificialIntellegence::create([
			'name' => $request->input('name'),
			'type' => $request->input('type'),
			'identifier' => str_random(32),
		]);

		$latest_train = $ai->trainresults()->orderBy('created_at', 'desc')->first();

		$ai->training = $latest_train === null || $latest_train->index === $latest_train->of;
		$ai->accuracy = $latest_train !== null || $latest_train->index !== $latest_train->of ? $latest_train->accuracy : 0;

		// if accuracy === 0 then it hasn't been trained or not enough data
		return response()->json([
			'success' => true,
			'data' => $ai,
		]);
	}

	/**
	 *
	 * List Your Artifical Intellegence Models
	 *
	 * @param Request $request
	 */
	public function listModels(Request $request)
	{
		return response()->json([
			'success' => true,
			'data' => $request->user()->models(),
		]);
	}

	/**
	 *
	 * Update Artifical Intellegence Model
	 *
	 * @param Request $request
	 * @param string $identifier
	 */
	public function updateModel(Request $request, string $identifier)
	{
		$request->validate([
			'name' => 'required|string',
		]);

		$ai = ArtificialIntellegence::where('identifier', $identifier)->get()->first();
		if($ai === null)
		{
			return response()->json([
				'success' => false,
				'error' => 'Unable to locate model',
			]);
		}

		$ai->name = $request->input('name');
		$ai->save();

		return response()->json([
			'success' => true,
			'data' => $ai,
		]);
	}

	/**
	 *
	 * Delete Artifical Intellegence Model
	 *
	 * @param Request $request
	 * @param string $identifier
	 */
	public function deleteModel(Request $request, string $identifier)
	{
		$ai = ArtificialIntellegence::where('identifier', $identifier)->get()->first();
		if($ai === null)
		{
			return response()->json([
				'success' => false,
				'error' => 'Unable to locate model',
			]);
		}

		$ai->delete();

		return response()->json([
			'success' => true,
		]);
	}

	/**
	 *
	 * Train Artifical Intellegence Model
	 *
	 * @param Request $request
	 * @param string $identifier
	 */
	public function trainModel(Request $request, string $identifier)
	{
		// todo: allow file uploads
		$request->validate([
			'dataset' => 'required_without:sftp|array_or_file|bail',
			'sftp' => 'required_without:dataset|array|bail',
			'sftp.host' => [
				'required',
				new Host,
				'bail',
			],
			'sftp.post' => 'required|integer|bail',
			'sftp.username' => 'required|string|bail',
			'sftp.password' => 'required_without:sftp.key|string|bail',
			'sftp.key' => 'required_without:sftp.password|string|bail',
			'sftp.directory' => 'required|string|bail',
		]);

		$samples = [];
		$labels = [];

		$type = $request->input('dataset', null) === null ? 'dataset' : 'sftp';
		switch ($type) {
			case 'dataset':
				$dataset = $request->input('dataset');

				$rows = count($dataset);
				foreach($dataset as $row)
				{
					if(count(array_keys($row)) !== 2)
					{
						return response()->json([
							'success' => false,
							'error' => 'All dataset rows must have two columns: a sample and label',
						]);
					}
					else
					{
						$samples[] = $row[0];
						$labels[] = $row[1];
					}
				}
			break;
			case 'sftp':
				$sftp = new SFTP($request->input('sftp.host'));

				if($request->input('sftp.password', null) !== null)
				{
					$login = $sftp->login(
						$request->input('sftp.username'), 
						$request->input('sftp.password')
					);
				}
				else
				{
					$key = new RSA;
					$key->loadKey($request->input('sftp.key'));

					$login = $sftp->login(
						$request->input('sftp.username'), 
						$key
					);
				}

				if(!$login)
				{
					return response()->json([
						'success' => false,
						'error' => 'Unable to authenticate on ' . $request->query('sftp.host'),
					]);
				}

				$data = (array) collect($sftp->rawlist())->flat()->all();

				$removeFromArray = [
					'..',
					'.',
				];

				foreach($removeFromArray as $key)
				{
					if(isset($data[$key]))
					{
						unset($data[$key]);
					}
				}

				$samples = array_values($data);
				$labels = array_keys($data);
			break;
		}

		$ai = ArtificialIntellegence::where('identifier', $identifier)->get()->first();
		if($ai === null)
		{
			return response()->json([
				'success' => false,
				'error' => 'Unable to locate model',
			]);
		}

		if(count($samples) !== count($labels) || empty($samples) || empty($labels))
		{
			return response()->json([
				'success' => false,
				'error' => 'Invalid or empty dataset. Please validate that your dataset is not empty or all values have alphanumeric keys',
			]);
		}

		$ai->train($samples, $labels);

		// cannot train during web request / don't have enough RAM
		// maybe use a cloud service and offload the training there and bill users at cost for it?

		// $import = $ai->export;
		// if($import !== null)
		// {
		// 	$import = unserialize($import, [\Phpml\Estimator::class]);
		// }

		// $trainer = new TextAnalysis($samples, $labels, $import);
		// $accuracy = $trainer->train();

		// $ai->export = $trainer->export();
		// $ai->save();

		return response()->json([
			'success' => true,
			'data' => [
				'status' => 'Training 0 of ' . round($rows / 3),
				'accuracy' => 0,
			],
		]);
	}

	/**
	 *
	 * Get models prediction
	 *
	 * @param Request $request
	 * @param string $identifier
	 */
	public function predictModel(Request $request, $identifier)
	{
		$request->validate([
			'dataset' => 'required|array',
		]);

		$ai = ArtificialIntellegence::where('identifier', $identifier)->get()->first();
		if($ai === null)
		{
			return response()->json([
				'success' => false,
				'error' => 'Unable to locate model',
			]);
		}

        $svc = null;
        if($ai->export !== null)
        {
            $svc = unserialize($ai->export, [\Phpml\Estimator::class]);
        }

        $trainer = new \App\Analysis\{ucwords(implode(' ', explode('_', $ai->type)))}([], [], $svc);

		return response()->json([
			'success' => true,
			'data' => [
				'status' => $trainer->predict($request->input('dataset')),
				'input' => $request->input('dataset'),
			],
		]);
	}

	/**
	 *
	 * Check if a model is being trained
	 *
	 * @param Request $request
	 * @param string $identifier
	 */
	public function isTrainingModel(Request $request, $identifier)
	{
		$ai = ArtificialIntellegence::where('identifier', $identifier)->get()->first();
		if($ai === null)
		{
			return response()->json([
				'success' => false,
				'error' => 'Unable to locate model',
			]);
		}

		$latest_train = $ai->trainresults()->orderBy('created_at', 'desc')->first();
		if($latest_train === null || $latest_train->index === $latest_train->of)
		{
			return response()->json([
				'success' => true,
				'data' => [
					'training' => false,
				],
			]);
		}
		else
		{
			return response()->json([
				'success' => false,
				'data' => [
					'training' => false,
				],
			]);
		}
	}
}