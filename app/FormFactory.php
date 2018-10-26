<?php

namespace App\Base;

use Nette\Localization\ITranslator;

class FormFactory implements \App\Base\IFormFactory {

	private $translator;

	public function __construct(ITranslator $translator){
		$this->translator = $translator;
	}

	public function create(){
		$form = new \Nette\Application\UI\Form();
		$form->setTranslator($this->translator);
		$renderer = $form->getRenderer();
		/**
		 * @var \Nette\Forms\Rendering\DefaultFormRenderer $renderer
		 */
		$renderer->wrappers['controls']['container'] = null;
		$renderer->wrappers['pair']['container'] = 'div class="form-group row"';
		$renderer->wrappers['pair']['.error'] = 'has-danger';
		$renderer->wrappers['control']['container'] = 'div class=col-sm-9';
		$renderer->wrappers['label']['container'] = 'div class="col-sm-3 col-form-label"';
		$renderer->wrappers['control']['description'] = 'span class=form-text';
		$renderer->wrappers['control']['errorcontainer'] = 'span class=form-control-feedback';
		$form->onRender[] = function ($form) {
			foreach ($form->getControls() as $control) {
				$type = $control->getOption('type');
				if ($type === 'button') {
					$control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-secondary');
					$usedPrimary = true;

				} elseif (in_array($type, ['text', 'textarea', 'select'], true)) {
					$control->getControlPrototype()->addClass('form-control');

				} elseif ($type === 'file') {
					$control->getControlPrototype()->addClass('form-control-file');

				} elseif (in_array($type, ['checkbox', 'radio'], true)) {
					if ($control instanceof Nette\Forms\Controls\Checkbox) {
						$control->getLabelPrototype()->addClass('form-check-label');
					} else {
						$control->getItemLabelPrototype()->addClass('form-check-label');
					}
					$control->getControlPrototype()->addClass('form-check-input');
					$control->getSeparatorPrototype()->setName('div')->addClass('form-check');
				}
			}
		};
		return $form;
	}
}