<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ArtificialIntellegence;

use Phpml\Dataset\CsvDataset;
use Phpml\Dataset\ArrayDataset;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WordTokenizer;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Metric\Accuracy;
use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

class TrainingController extends Controller {

	public function train(Request $request, ArtificialIntellegence $ai)
	{
		$request->validate([
			'dataset' => 'required|file',
		]);

		// only allow csv datasets for now todo: add json support
		$dataset = new CsvDataset($request->dataset->path(), 1);

		$vectorizer = new TokenCountVectorizer(new WordTokenizer());
		$tfIdfTransformer = new TfIdfTransformer();
	}
}