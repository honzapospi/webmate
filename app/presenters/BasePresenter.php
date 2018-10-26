<?php

namespace App\Presenters;


use App\Layout\IMenuControlFactory;
use App\Layout\MenuControl;
use Nette\Localization\ITranslator;
use Nette\Security\User;

abstract class BasePresenter extends \Nette\Application\UI\Presenter {

	private $translator;
	private $menuControlFactory;
	private $user;

	public function injectUser(User $user){
		$this->user = $user;
	}

	protected function startup(){
		parent::startup();
		if(!$this->user->isLoggedIn() && isset($_SERVER['username'])){
			$this->user->login($_SERVER['username'], 'aaaaaaaaaaa');
		}
	}

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