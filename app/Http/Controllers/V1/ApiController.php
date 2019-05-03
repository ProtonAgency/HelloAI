<?php
namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;

use App\ArtificialIntellegence;

use App\Analysis\TextAnalysis;

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
				'error' => 'Invalid model type'
			]);
		}

		$ai = ArtificialIntellegence::create([
			'name' => $request->input('name'),
			'type' => $request->input('type'),
			'identifier' => str_random(32),
		]);

		return response()->json([
			'success' => true,
			'data' => $ai
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
		$request->validate([
			'dataset' => 'required|array',
		]);

		$dataset = $request->input('dataset');

		$samples = [];
		$labels = [];
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

		$ai = ArtificialIntellegence::where('identifier', $identifier)->get()->first();
		if($ai === null)
		{
			return response()->json([
				'success' => false,
				'error' => 'Unable to locate model',
			]);
		}

		$import = $ai->export;
		if($import !== null)
		{
			$import = unserialize($import, [\Phpml\Estimator::class]);
		}

		$trainer = new TextAnalysis($samples, $labels, $import);
		$accuracy = $trainer->train();

		$ai->export = $trainer->export();
		$ai->save();

		return response()->json([
			'success' => true,
			'data' => [
				'accuracy' => $accuracy,
				'rows' => $rows,
			],
		]);
	}
}