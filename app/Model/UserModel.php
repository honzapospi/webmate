<?php

namespace App\Model;

use Nette\Database\Table\ActiveRow;
use Nette\Security\AuthenticationException;
use Nette\Security\Passwords;
use Nette\Utils\Validators;

class UserModel {
	use \Nette\SmartObject;

	private $connection;

	public function __construct(\Nette\Database\Context $context){
		$this->connection = $context;
	}

	public function getUserByUsername(string $username): ActiveRow {
		return $this->connection->table('user')->where('username', $username)->fetch();
	}

	public function createRegistration(string $username, string $password, string $email) {
		if(!Validators::isEmail($email)){
			throw new ValidationException('Email is not valid.');
		}
		$data = [
			'username' => $username,
			'password' => Passwords::hash($password),
			'email' => $email
		];
		$this->connection->beginTransaction();
		$accountRow = $this->connection->table('account')->insert([]);
		$data['account_id'] = $accountRow->id;
		$this->connection->table('user')->insert($data);
		$this->connection->commit();
	}

	public function verify($username, $password){
		$row = $this->connection->table('user')->where('username', $username)->fetch();
		if(!$row){
			new AuthenticationException('Username not found.');
		} elseif(!Passwords::verify($password, $row->password)){
			new AuthenticationException('Invalid password.');
		}
		return $row;
	}



}