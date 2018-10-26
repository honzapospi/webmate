<?php

namespace App\Model;

use Nette\Database\Context;
use Nette\Database\Table\ActiveRow;
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

	public function addProject(string $name, int $accountId): ActiveRow {
		return $this->connection->table('project')->insert([
			'account_id' => $accountId,
			'name' => $name
		]);
	}

}