<?php

class UserModel {
	use \Nette\SmartObject;

	private $connection;
	private $password;

	public function __construct(\Nette\Database\Context $context){
		$this->connection = $context;
		$this->password = new \Nette\Security\Passwords();
	}

	public function createRegistration(strinbg $username, string $password): int {
		$data = [
			'username' => $username,
			'password' => $this->password->hash($password)
		];
	}



}