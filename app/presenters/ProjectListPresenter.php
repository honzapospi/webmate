<?php

namespace App\Presenters;

use App\Model\ProjectModel;
use App\ProjectModule\IProjectListControlFactory;
use Nette;
use Tracy\Debugger;


final class ProjectListPresenter extends BasePresenter {


	private $projectListControlFactory;
	private $projectModel;

	public function __construct(IProjectListControlFactory $projectListControlFactory, ProjectModel $projectModel)	{
		$this->projectListControlFactory = $projectListControlFactory;
		$this->projectModel = $projectModel;
	}

	protected function startup(){
		parent::startup();
		if(!$this->user->isLoggedIn()){
			$this->redirect('Login:default');
		}
		Debugger::barDump($this->link('ajax'));
	}

	public function actionAjax(){
		$data = [];
		foreach($this->projectModel->getProjects($this->user->identity->data['account_id']) as $project){
			$data[] = [
				'id' => $project->id,
				'name' => $project->name
			];
		}
		$this->sendJson($data);
	}

	protected function createComponentLoginForm(){
		$form = new Nette\Forms\Form();
		$form->addText('username', 'Username')->setRequired();
		$form->addPassword('password', 'Password')->setRequired();
		$form->addSubmit('formsubmit', 'Login');
		$form->onSuccess[] = [$this, 'formSubmitted'];
	}

	protected function createComponentProjectList(){
		return $this->projectListControlFactory->create();
	}


}
