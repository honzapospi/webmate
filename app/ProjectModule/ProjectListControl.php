<?php

namespace App\ProjectModule;

use App\Base\IFormFactory;
use App\Model\ProjectModel;
use Nette\Application\UI\Control;
use Nette\Http\Request;
use Nette\Security\User;

class ProjectListControl extends Control {

	/**
	 * @var
	 * @persistent
	 */
	public $name;

	/**
	 * @var ProjectModel
	 */
	private $projectModel;
	private $user;
	private $formFactory;
	private $httpRequest;

	public function __construct(ProjectModel $projectModel, User $user, IFormFactory $formFactory, Request $request){
		$this->projectModel = $projectModel;
		$this->user = $user;
		$this->formFactory = $formFactory;
		$this->httpRequest = $request;
	}

	public function render(){
		$this->template->setFile(__DIR__.'/ProjectListControl.latte');
		$this->template->projects = $this->projectModel->getProjects($this->user->identity->data['account_id']);
		$this->template->render();
	}

	/**
	* @return Nette\Application\UI\Control
	*/
	protected function createComponentSearchForm(){
	    $control = $this->formFactory->create();
	    $control->addText('name', 'Filter by name')->setAttribute('placeholder', 'Write what you looking for...');
	    $control->onSuccess[] =  function($form){
			$this->name = $form->values->name;
			if(!$this->httpRequest->isAjax())
				$this->redirect('this');
		};
	    return $control;
	}

	/**
	* @return Nette\Application\UI\Control
	*/
	protected function createComponentAddProject(){
	    $control = $this->formFactory->create();
		$control->getElementPrototype()->class = 'ajax';
		$control->addtext('name', 'New project name');
		$control->addSubmit('sobmit', 'Add');
	    $control->onSuccess[] = function ($form){
	    	$this->projectModel->addProject($form->values->name, $this->user->identity->data['account_id']);
	    	$this->redrawControl('projectList');
		};
	    return $control;
	}

}