<?php

namespace App\Presenters;

use App\Model\ProjectModel;
use Nette;


final class LoginPresenter extends BasePresenter {


	protected function createComponentLoginForm(){
		$form = new Nette\Application\UI\Form();
		$form->addText('username', 'Username')->setRequired();
		$form->addPassword('password', 'Password')->setRequired();
		$form->addSubmit('formsubmit', 'Login');
		$form->onSuccess[] = [$this, 'formSubmitted'];
	}

	public function formSubmitted(Nette\Application\UI\Form $form){
		dumpe($form->getValues());
	}






}
