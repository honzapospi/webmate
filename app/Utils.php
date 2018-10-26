<?php

namespace App\Utils;

use Nette\StaticClass;

class Utils {
	use StaticClass;

	public static function upperCaseFirstLetter($s){
		$new = [];
		foreach(explode(' ', $s) as $word){
			$new[] = ucfirst($word);
		}
		return join($new, ' ');
	}

}