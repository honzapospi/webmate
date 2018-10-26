<?php

namespace App\Layout;

use Nette\Security\User;

class MenuControl extends \Nette\Application\UI\Control {

	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function render(){
		$this->template->setFile(__DIR__.'/MenuControl.latte');
		$this->template->render();
	}

	public function handleLogout(){
		$this->user->logout();
		$this->redirect('this');
	}


}