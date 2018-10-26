<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace App\ProjectModule;

/**
 * IProjectListControlFactory
 * @author Jan Pospisil
 */

interface IProjectListControlFactory
{

	/**
	 * @return ProjectListControl
	 */
	public function create();

}
