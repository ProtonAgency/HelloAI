<?php
namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Analysis\TextAnalysis;
use App\ArtificalIntelligence;
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
		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
			'type' => 'required|string',
		]);

		if($validator->fails())
		{    
		    return response()->json([
		    	'success' => false,
		    	'errors' => $validator->messages(),
		    ]);
		}

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

		$ai = ArtificalIntelligence::create([
			'name' => $request->input('name'),
			'type' => $request->input('type'),
			'identifier' => str_random(32),
			'user_id' => $request->user()->id,
		]);

		$latest_train = $ai->trainresults()->orderBy('created_at', 'desc')->first();

		$ai->training = $latest_train === null ? false : ($latest_train->index === $latest_train->of);
		$ai->accuracy = $latest_train === null ? 0 : ($latest_train->index !== $latest_train->of ? $latest_train->accuracy : 0);

		// if accuracy === 0 then it hasn't been trained or not enough data
		return response()->json([
			'success' => true,
			'data' => $ai,
		]);
	}

	/**
	 *
	 * Get a model
	 *
	 * @param Request $request
	 * @param string $identifier
	 */
	public function fetchModel(Request $request,  string $identifier)
	{
		$ai = ArtificalIntelligence::where('identifier', $identifier)->get()->first();
		if($ai === null)
		{
			return response()->json([
				'success' => false,
				'error' => 'Unable to locate model',
			]);
		}

		$latest_train = $ai->trainresults()->orderBy('created_at', 'desc')->first();

		$ai->training = $latest_train === null ? false : ($latest_train->index === $latest_train->of);
		$ai->accuracy = $latest_train === null ? 0 : ($latest_train->index !== $latest_train->of ? $latest_train->accuracy : 0);

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
		$ai = ArtificalIntelligence::where('identifier', $identifier)->get()->first();
		if($ai === null)
		{
			return response()->json([
				'success' => false,
				'error' => 'Unable to locate model',
			]);
		}

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
		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
		]);

		if($validator->fails())
		{    
		    return response()->json([
		    	'success' => false,
		    	'errors' => $validator->messages(),
		    ]);
		}

		$ai = ArtificalIntelligence::where('identifier', $identifier)->get()->first();
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
		$ai = ArtificalIntelligence::where('identifier', $identifier)->get()->first();
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
		$validator = Validator::make($request->all(), [
			// 'dataset' => 'required_without:sftp|array_or_file|bail',
			'sftp.host' => [
				'required',
				new Host,
				'bail',
			],
			'sftp.port' => 'required|integer|bail',
			'sftp.username' => 'required|string|bail',
			// 'sftp.password' => 'required_without:sftp.key|string|bail',
			'sftp.key' => 'required_without:sftp.password|string|bail',
			'sftp.directory' => 'required|string|bail',
		]);

		if($validator->fails())
		{    
		    return response()->json([
		    	'success' => false,
		    	'errors' => $validator->messages(),
		    ]);
		}

		$samples = [];
		$labels = [];

		$type = $request->input('dataset', null) !== null ? 'dataset' : 'sftp';
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

				$labels = (array) $sftp->nlist($request->input('sftp.directory'));

				$removeFromArray = [
					'..',
					'.',
				];

				foreach($removeFromArray as $key)
				{
					if(in_array($key, $removeFromArray))
					{
						unset($labels[array_search($key, $removeFromArray)]);
					}
				}

				var_dump($labels); exit;

				$dataset = [];
				$new_labels = [];
				foreach($labels as $key => $label)
				{
					$path = rtrim($request->input('sftp.directory'), '/') . '/' . $label;
					$list = $sftp->nlist($path);
					if(!empty($list)) //its a directory
					{
						foreach($list as $file)
						{
							$contents = $sftp->get($path . '/' . $file);
							if(strlen($contents) > 0 && !in_array($file, $removeFromArray))
							{
								$new_labels[] = $label;
								$dataset[] = $contents;
							}
						}
					}
				}

				$labels = $new_labels;
				$dataset = $dataset;
			break;
		}

		$ai = ArtificalIntelligence::where('identifier', $identifier)->get()->first();
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
	public function predictModel(Request $request, string $identifier)
	{
		$validator = Validator::make($request->all(), [
			'dataset' => 'required|array',
		]);

		if($validator->fails())
		{    
		    return response()->json([
		    	'success' => false,
		    	'errors' => $validator->messages(),
		    ]);
		}

		$ai = ArtificalIntelligence::where('identifier', $identifier)->get()->first();
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

        $type = '\App\Analysis\\' . str_replace(' ', '', ucwords(strtr($ai->type, '_', ' ')));
        $trainer = new $type([], [], $svc);

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
		$ai = ArtificalIntelligence::where('identifier', $identifier)->get()->first();
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