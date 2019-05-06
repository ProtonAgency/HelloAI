<?php
namespace App\Analysis;

use Phpml\Classification\SVC;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Dataset\FilesDataset;
use Phpml\Dataset\ArrayDataset;
use Phpml\FeatureExtraction\StopWords\English;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Metric\Accuracy;
use Phpml\Tokenization\NGramTokenizer;
use Phpml\Estimator;

class TextAnalysis {
	
	/**@var array[] */
	protected $dataset = [];

	/**@var array[] */
	protected $labels = [];

	/**@var Svc */
	protected $classifier;

	public function __construct(array $dataset, array $labels, ?Svc $classifier = null)
	{
		$this->dataset = $dataset;
		$this->labels = $labels;
		$this->classifier = $classifier;
	}

	public function train()
	{
		$dataset = new ArrayDataset($this->dataset, $this->labels);
		// uncomment for testing
		// $dataset = new FilesDataset(__DIR__ . '/bbc');

		$split = new StratifiedRandomSplit($dataset, 0.3);
		$samples = $split->getTrainSamples();

		$vectorizer = new TokenCountVectorizer(new NGramTokenizer(1, 3), new English());
		$vectorizer->fit($samples);
		$vectorizer->transform($samples);

		$transformer = new TfIdfTransformer();
		$transformer->fit($samples);
		$transformer->transform($samples);

		if($this->classifier === null)
		{
			$this->classifier = new SVC();
		}

		$this->classifier->train($samples, $split->getTrainLabels());

		$testSamples = $split->getTestSamples();
		$vectorizer->transform($testSamples);
		$transformer->transform($testSamples);

		return (float) Accuracy::score($split->getTestLabels(), $this->classifier->predict($testSamples));
	}

	public function predict(array $dataset)
	{
		return $this->classifier->predict($dataset);
	}

	public function export()
	{
		return serialize($this->classifier);
	}
}