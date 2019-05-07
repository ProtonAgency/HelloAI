<?php
namespace App\Traits;

trait DatasetParser {
	
	/** 
	 *
	 * Prepare a dataset for training
	 *
	 * @param array $dataset
	 * @return array
	 */
	public function prepareDataset(array $dataset)
	{
		// var_dump(count(collect($dataset)->flatten()->values())); exit;
		return collect($dataset)->flatten()->values()->map(function($string) {
			// replace url
			$string = preg_replace('/^((http[s]?|ftp):\/)?\/?([^:\/\s]+)((\/\w+)*\/)([\w\-\.]+[^#?\s]+)(.*)?(#[\w\-]+)?$/', 'httpaddr', $string);
	        $string = strip_tags($string);
			// replace emails
			$string = preg_replace('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', 'emailaddr', $string);
			// strip escapes
			$string = stripslashes($string);
			// convert to lowercase
			$string = strtolower($string);
			// remove html tags
			$string = preg_replace('/<style[\s\S]*?>[\s\S]*?<\/style>/mixu', '', $string);
			$string = preg_replace('/<script[\s\S]*?>[\s\S]*?<\/script>/mixu', '', $string);
			$string = preg_replace('/<noscript[\s\S]*?>[\s\S]*?<\/noscript>/mixu', '', $string);
			$string = preg_replace( '/[\r\n\t ]+/', ' ', $string);
			// match any non alphanumeric
			$string = preg_replace('/[^[:alnum:][:space:]]/u', '', $string);
			// match any numbers
			// $string = preg_replace('/([0-9])/', 'number', $string);
			// replace any tabs, newlines
			$string = preg_replace('/[^\\S ]/', '', $string);
			// replace multiple spaces
			$string = preg_replace('!\s+!', ' ', $string);
			// remove whitespace on left/right
			$string = ltrim(rtrim($string));

			return $string;
		})->all();
	}
}