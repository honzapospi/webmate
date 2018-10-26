<?php

namespace App\Presenters;


use Nette\Localization\ITranslator;

abstract class BasePresenter extends \Nette\Application\UI\Presenter {

	private $translator;

	public function injectTranslator(ITranslator $translator){
		$this->translator = $translator;
	}

	protected function beforeRender(){
		parent::beforeRender();
		$this->template->setTranslator($this->translator);
	}


}