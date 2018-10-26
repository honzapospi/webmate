<?php

namespace App\Presenters;

use App\UserModule\LoginFormController;
use Nette;


final class LoginPresenter extends BasePresenter {

	private $loginFormController;

	public function __construct(LoginFormController $loginFormController)	{
		$this->loginFormController = $loginFormController;
	}

	protected function createComponentLoginForm(){
		return $this->loginFormController->create();
	}

	public function formSubmitted(Nette\Application\UI\Form $form){

	}


}
