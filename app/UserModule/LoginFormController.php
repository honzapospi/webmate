<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace App\UserModule;
use App\Base\IFormFactory;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;
use Nette\SmartObject;

/**
 * LoginFormController.php
 * @author Jan Pospisil
 */

class LoginFormController {
	use SmartObject;

	private $formFactory;
	private $user;

	public function __construct(IFormFactory $formFactory, User $user){
		$this->formFactory = $formFactory;
		$this->user = $user;
	}

	public function create(): Form {
		$form = $this->formFactory->create();
		$form->addText('username', 'Username')->setRequired();
		$form->addPassword('password', 'Password')->setRequired();
		$form->addSubmit('formsubmit', 'Login');
		$form->addProtection();
		$form->onSuccess[] = [$this, 'formSubmitted'];
		return $form;
	}

	public function formSubmitted(Form $form){
		try {
			$this->user->login($form->values->username, $form->values->password);
		} catch (AuthenticationException $e){
			return $form->addError($e->getMessage());
		}

	}

}
