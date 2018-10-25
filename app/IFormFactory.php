<?php

namespace App\Base;

Interface IFormFactory {


	/**
	 * @return \Nette\Application\UI\Form
	 */
	public function create();

}
