<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Analysis\TextAnalysis;

$samples = [
];
$labels = [
];

$analysis = new TextAnalysis($samples, $labels);

echo $analysis->train() . PHP_EOL;

$test = [];

echo $analysis->predict();