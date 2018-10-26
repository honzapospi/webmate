<?php

namespace App\Presenters;

use App\Base\IFormFactory;
use App\Model\UserModel;
use App\Model\ValidationException;
use App\Utils\Utils;
use Nette;
use Nette\Application\UI\Form;

final class RegistrationPresenter extends BasePresenter {

	private $formFactory;
	private $userModel;

	public function __construct(IFormFactory $formFactory, UserModel $userModel)	{
		$this->formFactory = $formFactory;
		$this->userModel = $userModel;
	}


	protected function createComponentRegistrationForm(): Form {
		$form = $this->formFactory->create();
		$form->addText('username', 'Username')->setRequired()->addRule(Form::MIN_LENGTH, 'Username has to has at least %d chars.', 6);
		$form->addPassword('password', 'Password')->setRequired();
		$form->addPassword('password_again', Utils::upperCaseFirstLetter('Password check'))
			->setRequired()
			->addRule(Form::EQUAL, 'Password do not match.', $form['password']);
		//$form->addText('rbt', 'Email')->setOption('class', 'hidden')->setOption('rbt', 'cokoliv');
		$form->addProtection();
		$form->addSubmit('formsubmit', 'Sign up');
		$form->addEmail('email', 'email')->setOption('class', 'hidden');
		$form->addEmail('xxxx', 'Email')->setRequired();
		$form->onSuccess[] = [$this, 'formSubmitted'];
		return $form;
	}

	public function formSubmitted(Nette\Application\UI\Form $form){
		if(!$form->values->email){
			try{
				$this->userModel->createRegistration($form->values->username, $form->values->password, $form->values->xxxx);
			} catch (Nette\Database\UniqueConstraintViolationException $e){
				$form['username']->addError('Duplacate username.');
			} catch (ValidationException $e){
				$form->addError($e->getMessage());
			}
			if($form->hasErrors())
				return;

			$this->flashMessage('Registration has been done.');
			$this->redirect(':Login:default');
		} else {
			die('robot');
		}
	}
}
