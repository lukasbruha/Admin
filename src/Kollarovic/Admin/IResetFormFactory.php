<?php

namespace Kollarovic\Admin;

use Nette\Application\UI\Form;


interface IResetFormFactory
{

	/**
	 * @return Form
	 */
	function create();

}