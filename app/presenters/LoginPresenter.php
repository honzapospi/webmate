<?php

namespace App\Presenters;

use App\UserModule\LoginFormController;
use Nette;


final class LoginPresenter extends BasePresenter {

	private $loginFormController;

	public function __construct(LoginFormController $loginFormController)	{
		$this->loginFormController = $loginFormController;
	}

	protected function startup() {
		parent::startup();
		if($this->user->isLoggedIn()){
			$this->redirect('ProjectList:default');
		}
	}

	public function actionDefault(){

	}

	protected function createComponentLoginForm(){
		$form = $this->loginFormController->create();
		$form->onSuccess[] = function (){
			$this->flashMessage('Login successful.');
			$this->redirect('ProjectList:default');
		};
		return $form;
	}



}
