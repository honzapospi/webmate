<?php

namespace App\Presenters;

use App\Model\ProjectModel;
use Nette;


final class ProjectListPresenter extends BasePresenter {


	private $projectModel;
	private $projects;

	public function __construct(ProjectModel $projectModel)	{
		$this->projectModel = $projectModel;
	}

	public function actionDefault(){
		$this->projects = $this->projectModel->getProjects(3);
	}

	public function renderDefault(){
		$this->template->projects = $this->projects;
	}

	protected function createComponentLoginForm(){
		$form = new Nette\Forms\Form();
		$form->addText('username', 'Username')->setRequired();
		$form->addPassword('password', 'Password')->setRequired();
		$form->addSubmit('formsubmit', 'Login');
		$form->onSuccess[] = [$this, 'formSubmitted'];
	}






}
