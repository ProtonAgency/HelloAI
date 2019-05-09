<?php

require_once __DIR__ . '/vendor/autoload.php';

use phpseclib\Net\SFTP;
use phpseclib\Crypt\RSA;

$sftp = new SFTP('ssh.us.magentosite.cloud', 22);

$key = new RSA;
$key->loadKey(file_get_contents('C:\Users\JakeCasto\.ssh\id_rsa'));

$login = $sftp->login(
	'1.ent-hdbgo6fxks4a2-production-vohbr3y', 
	$key
);

// var_dump($login, $sftp->getErrors());exit;
// var_dump($sftp->nlist('/app/hdbgo6fxks4a2'));exit;
// var_dump($sftp->nlist($request->input('sftp.directory')));exit;
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

var_dump($new_labels[0], $dataset[0]);