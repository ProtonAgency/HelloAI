<?php
namespace App\Analysis;

use Phpml\Dataset\CsvDataset;
use Phpml\Dataset\ArrayDataset;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WordTokenizer;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Metric\Accuracy;
use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

class TextAnalysis {
	
	/**@var array[] */
	protected $dataset = [];

	/**@var array[] */
	protected $labels = [];

	/**@var Svc */
	protected $classifier;

	public function __construct(array $dataset, array $labels)
	{
		$this->dataset = $dataset;
		$this->labels = $labels;
	}

	public function train()
	{
		$dataset = new ArrayDataset($this->dataset, $this->labels);

		$vectorizer = new TokenCountVectorizer(new WordTokenizer());
		$tfIdfTransformer = new TfIdfTransformer();

		$samples = [];
		foreach ($dataset->getSamples() as $sample) {
		    $samples[] = $sample[0];
		}

		$vectorizer->fit($samples);
		$vectorizer->transform($samples);
		$tfIdfTransformer->fit($samples);
		$tfIdfTransformer->transform($samples);

		$dataset = new ArrayDataset($samples, $dataset->getTargets());
		$randomSplit = new StratifiedRandomSplit($dataset, 0.1);

		$this->classifier = new SVC(Kernel::RBF, 1000);
		$this->classifier->train($randomSplit->getTrainSamples(), $randomSplit->getTrainLabels());

		return (float) Accuracy::score($randomSplit->getTestLabels(), $this->classifier->predict($randomSplit->getTestSamples()));
	}

	public function predict(array $dataset)
	{
		return $this->classifier->predict($dataset);
	}
}