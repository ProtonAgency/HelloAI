<?php
ini_set('memory_limit', '-1');
require_once __DIR__ . '/vendor/autoload.php';

use App\Analysis\TextAnalysis;

$samples = [
	'hey i love this so so so much i love this',
	'fuck this it sucks its so awful fuck this',
];
$labels = [
	'good',
	'bad'
];

$analysis = new TextAnalysis($samples, $labels);

echo $analysis->train() . PHP_EOL;

$text = 'The future of the games industry, at least as Google sees it, is in streaming.
It’s a trend that feels inevitable - just ask anyone in the music, TV or film business. Streaming is where it\'s at, and the possibility for what can be streamed has only ever been bound by the limitations of internet connectivity.
Google thinks its technology can make streaming games a plausible and possibly even pleasurable reality. One where gamers aren’t driven to insanity by stuttering gameplay and slow-reacting characters.
For the sake of argument, let’s assume it succeeds. Where might Google - with its track record for upending business models, often with unintended consequences - lead the industry?
Shifting costs
Games consoles are expensive. The games are (mostly) expensive.
Google’s Stadia could eliminate both costs, replacing them with a subscription fee. A ballpark figure might be $15-$30 a month - though some predict big name titles might have an additional fee on top, like buying a new movie on Amazon Prime Video.
Good news? It depends on where you’re coming from.
For gamers, there are a number of hurdles. Phil Harrison, Google’s man in charge of Stadia, told me his team\'s tests managed 4K gaming on download speeds of “around 25mbps”.
For context, Microsoft currently suggests a minimum of just 3mbps to play “traditional” games online. And the difference between getting 3mbps and 25mbps? Hundreds of dollars a year in payments to your internet service provider.
Or, the difference could be not being able to play at all - 25mbps is more than double the average connection speed across the US, according to research commissioned and part-funded by, er, Google.';

echo $analysis->predict([$text]);