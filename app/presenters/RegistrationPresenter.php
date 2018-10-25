<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

final class RegistrationPresenter extends BasePresenter {

	private $formFactory;

	public function __construct(FormFactory $formFactory)	{
		$this->formFactory = $formFactory;
	}


	protected function createComponentLoginForm(): Form {
		$form = $this->formFactory->create();
		$form->addText('username', 'Username')->setRequired()->addRule(Form::MIN_LENGTH, 'Username has to has at least %d chars.', 6);
		$form->addPassword('password', 'Password')->setRequired();
		$form->addPassword('password_again', 'Password check')
			->setRequired()
			->addRule(Form::EQUAL, 'Password do not match.', $form['password']);
		$form->addSubmit('formsubmit', 'Sign up');
		$form->onSuccess[] = [$this, 'formSubmitted'];
		return $form;
	}

	public function formSubmitted(Nette\Application\UI\Form $form){
		if($form->values->username === 'honzaaa'){
			return $form['username']->addError('Invalid username');
		}

		dumpe($form->getValues());
	}

}
