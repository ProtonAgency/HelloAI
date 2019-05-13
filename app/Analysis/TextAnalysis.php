<?php
namespace App\Analysis;

use Phpml\Classification\SVC;
use Phpml\Classification\NaiveBayes;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\Dataset\ArrayDataset;
use Phpml\FeatureExtraction\StopWords\English;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Metric\Accuracy;
use Phpml\Tokenization\NGramTokenizer;
use Phpml\Pipeline;

use App\Traits\DatasetParser;

class TextAnalysis {

	use DatasetParser;
	
	/**@var array[] */
	protected $dataset = [];

	/**@var array[] */
	protected $labels = [];

	/**@var Svc */
	protected $classifier;

	public function __construct(array $dataset, array $labels, ?Pipeline $classifier = null)
	{
		$this->dataset = $this->prepareDataset($dataset);
		$this->labels = $labels;
		$this->classifier = $classifier;
	}

	public function train()
	{
		$dataset = new ArrayDataset($this->dataset, $this->labels);

		$split = new StratifiedRandomSplit($dataset);
		// $samples = $split->getTrainSamples();

		// $vectorizer = new TokenCountVectorizer(new NGramTokenizer(1, 3), new English());
		// $vectorizer->fit($samples);
		// $vectorizer->transform($samples);

		// $transformer = new TfIdfTransformer();
		// $transformer->fit($samples);
		// $transformer->transform($samples);

		if($this->classifier === null)
		{
			$this->classifier = new Pipeline([
			    new TokenCountVectorizer(new NGramTokenizer(1, 3), new English()),
			    // new TfIdfTransformer(),
			], new NaiveBayes());
		}

		$this->classifier->train($split->getTrainSamples(), $split->getTrainLabels());

		$predicted = $this->classifier->predict($split->getTestSamples());

		return Accuracy::score($split->getTestLabels(), $predicted);
	}

	public function predict(array $dataset)
	{
		return $this->classifier->predict($this->prepareDataset($dataset));
	}

	public function export()
	{
		return serialize($this->classifier);
	}
}