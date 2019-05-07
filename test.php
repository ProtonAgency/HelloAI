<?php

require_once __DIR__ . '/vendor/autoload.php';

use Phpml\Dataset\FilesDataset;
$a = [];
for ($i=0; $i < 500; $i++) { 
	$new_dataset = [];
	$dataset = new FilesDataset(__DIR__ . '/app/Analysis/1mb');
	$labels = $dataset->getTargets();
	foreach($dataset->getSamples() as $key => $string)
	{
		$new_dataset[$key] = $string;
	}

	$time = microtime(true);

	$t = new \App\Analysis\TextAnalysis($new_dataset, $labels);
	$a[] = $t->train();
}

$average = array_sum($a) / count($a);
// echo $average;

$new_dataset = [];
$dataset = new FilesDataset(__DIR__ . '/app/Analysis/1mb');
$labels = $dataset->getTargets();
foreach($dataset->getSamples() as $key => $string)
{
	$new_dataset[$key] = $string;
}

$time = microtime(true); // time in Microseconds

$t = new \App\Analysis\TextAnalysis($new_dataset, $labels);
$t->train();

echo 'Average Accuracy: ' .  $average . PHP_EOL;
echo 'Train Time: ' . (microtime(true) - $time) . 's' . PHP_EOL;

echo PHP_EOL . PHP_EOL . '----TESTS----' . PHP_EOL . PHP_EOL;

// var_dump($t->predict(["i am an american web developer that has a passion for coding"]), $t->predict(["this should not be flagged as spam"]));

echo collect($t->predict(["i am an american web developer that has a passion for coding"]))->flatten()->first() . PHP_EOL;
echo collect($t->predict(["this should not be flagged as spam"]))->flatten()->first() . PHP_EOL;