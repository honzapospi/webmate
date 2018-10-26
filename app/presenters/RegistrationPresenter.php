<?php

namespace App\Presenters;

use App\Base\IFormFactory;
use App\Utils\Utils;
use Nette;
use Nette\Application\UI\Form;

final class RegistrationPresenter extends BasePresenter {

	private $formFactory;

	public function __construct(IFormFactory $formFactory)	{
		$this->formFactory = $formFactory;
	}


	protected function createComponentRegistrationForm(): Form {
		$form = $this->formFactory->create();
		$form->addText('username', 'Username')->setRequired()->addRule(Form::MIN_LENGTH, 'Username has to has at least %d chars.', 6);
		$form->addPassword('password', 'Password')->setRequired();
		$form->addPassword('password_again', Utils::upperCaseFirstLetter('Password check'))
			->setRequired()
			->addRule(Form::EQUAL, 'Password do not match.', $form['password']);
		$form->addText('rbt', 'Email')->setOption('class', 'hidden')->setOption('rbt', 'cokoliv');
		$form->addProtection();
		$form->addSubmit('formsubmit', 'Sign up');
		$form->addEmail('email', 'email')->setOption('class', 'hidden');
		$form->addEmail('xxxx', 'Email')->setRequired();
		$form->onSuccess[] = [$this, 'formSubmitted'];
		return $form;
	}

	public function formSubmitted(Nette\Application\UI\Form $form){
		//dumpe($form->values);

		if(!$form->values->email){
			if($form->values->username === 'honzaaa'){
				return $form['username']->addError('Invalid username');
			}

			dumpe($form->getValues());
		}
	}
}
