<?php

class Translator implements \Nette\Localization\ITranslator {

	private $dict = [
		'Username' => 'Uživatel',
		'Password' => 'Heslo'
	];

	function translate($message, $count = null): string	{
		return $this->dict[$message] ??  $message;
	}

}