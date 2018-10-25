<?php

namespace App\Model;

use Nette\Database\Context;
use Nette\SmartObject;

class ProjectModel {
	use SmartObject;

	private $connection;

	public function __construct(Context $context)	{
		$this->connection = $context;
	}

	public function getProjects(int $accountId){
		return $this->connection->table('project')->where('account_id = ?', $accountId);
	}


}