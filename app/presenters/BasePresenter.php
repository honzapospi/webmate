<?php

namespace App\Presenters;


use App\Layout\IMenuControlFactory;
use App\Layout\MenuControl;
use Nette\Localization\ITranslator;

abstract class BasePresenter extends \Nette\Application\UI\Presenter {

	private $translator;
	private $menuControlFactory;

	public function injectMenuControlFactory(IMenuControlFactory $menuControlFactory){
		$this->menuControlFactory = $menuControlFactory;
	}

	public function injectTranslator(ITranslator $translator){
		$this->translator = $translator;
	}

	protected function beforeRender(){
		parent::beforeRender();
		$this->template->setTranslator($this->translator);
	}

	protected function createComponentMenu()
	{
		return $this->menuControlFactory->create();
	}





}