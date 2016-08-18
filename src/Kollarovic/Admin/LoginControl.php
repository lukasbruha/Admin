<?php

namespace Kollarovic\Admin;

use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;


class LoginControl extends Control
{

	/** @var array */
	public $onLoggedIn;

	/** @var array */
	public $onResetPassword;

	/** @var ILoginFormFactory */
	private $loginFormFactory;

	/** @var IResetFormFactory */
	private $resetFormFactory;

	/** @var ILoaderFactory */
	private $loaderFactory;

	/** @var string */
	private $pageTitle;

	/** @var string */
	private $pageName;

	/** @var string */
	private $pageMsg;

	/** @var string */
	private $usernameIcon;

	/** @var string */
	private $passwordIcon;

	/** @var string */
	private $forgotPass;

	/** @var string */
	private $logo;

	/** @var string */
	private $bg;

	/** @var string */
	private $resetPassMsg;

	/** @var array */
	private $layout;

	/** @var ITranslator */
	private $translator;


	function __construct(ILoginFormFactory $loginFormFactory, IResetFormFactory $resetFormFactory, ILoaderFactory $loaderFactory, ITranslator $translator = NULL)
	{
		parent::__construct();
		$this->loginFormFactory = $loginFormFactory;
		$this->resetFormFactory = $resetFormFactory;
		$this->loaderFactory = $loaderFactory;
		$this->translator = $translator;
	}


	public function render(array $options = [])
	{
		$this->template->setFile($this->layout['templates']['login']);
		$this->template->pageTitle = $this->pageTitle;
		$this->template->pageName = $this->pageName;
		$this->template->pageMsg = $this->pageMsg;
		$this->template->usernameIcon = $this->usernameIcon;
		$this->template->passwordIcon = $this->passwordIcon;
		$this->template->forgotPass = $this->forgotPass;
		$this->template->logo = $this->logo;
		$this->template->bg = $this->bg;
		foreach ($options as $key => $value) {
			$this->template->$key = $value;
		}
		$this->template->render();
	}


	protected function createTemplate($class = NULL)
	{
		$template = parent::createTemplate($class);
		if (!array_key_exists('translate', $template->getLatte()->getFilters())) {
			$template->addFilter('translate', function($str){return $str;});
		}
		return $template;
	}


	protected function createComponentForm()
	{
		$form = $this->loginFormFactory->create();
		$form->onSuccess[] = function($form) {
			$this->onLoggedIn($form);
		};
		return $form;
	}


	protected function createComponentFormReset()
	{
		$form = $this->resetFormFactory->create();
		$form->onSuccess[] = function($form) {
			$this->onResetPassword($form);
		};
		return $form;
	}


	protected function createComponentCss()
	{
		return $this->loaderFactory->createCssLoader();
	}


	protected function createComponentJs()
	{
		return $this->loaderFactory->createJavaScriptLoader();
	}

	/**
	 * @return array
	 */
	public function getOnLoggedIn()
	{
		return $this->onLoggedIn;
	}

	/**
	 * @param array $onLoggedIn
	 */
	public function setOnLoggedIn($onLoggedIn)
	{
		$this->onLoggedIn = $onLoggedIn;
	}

	/**
	 * @return array
	 */
	public function getOnResetPassword()
	{
		return $this->onResetPassword;
	}

	/**
	 * @param array $onResetPassword
	 */
	public function setOnResetPassword($onResetPassword)
	{
		$this->onResetPassword = $onResetPassword;
	}

	/**
	 * @return ILoginFormFactory
	 */
	public function getLoginFormFactory()
	{
		return $this->loginFormFactory;
	}

	/**
	 * @param ILoginFormFactory $loginFormFactory
	 */
	public function setLoginFormFactory($loginFormFactory)
	{
		$this->loginFormFactory = $loginFormFactory;
	}

	/**
	 * @return IResetFormFactory
	 */
	public function getResetFormFactory()
	{
		return $this->resetFormFactory;
	}

	/**
	 * @param IResetFormFactory $resetFormFactory
	 */
	public function setResetFormFactory($resetFormFactory)
	{
		$this->resetFormFactory = $resetFormFactory;
	}

	/**
	 * @return ILoaderFactory
	 */
	public function getLoaderFactory()
	{
		return $this->loaderFactory;
	}

	/**
	 * @param ILoaderFactory $loaderFactory
	 */
	public function setLoaderFactory($loaderFactory)
	{
		$this->loaderFactory = $loaderFactory;
	}

	/**
	 * @return string
	 */
	public function getPageTitle()
	{
		return $this->pageTitle;
	}

	/**
	 * @param string $pageTitle
	 */
	public function setPageTitle($pageTitle)
	{
		$this->pageTitle = $pageTitle;
	}

	/**
	 * @return string
	 */
	public function getPageName()
	{
		return $this->pageName;
	}

	/**
	 * @param string $pageName
	 */
	public function setPageName($pageName)
	{
		$this->pageName = $pageName;
	}

	/**
	 * @return string
	 */
	public function getPageMsg()
	{
		return $this->pageMsg;
	}

	/**
	 * @param string $pageMsg
	 */
	public function setPageMsg($pageMsg)
	{
		$this->pageMsg = $pageMsg;
	}

	/**
	 * @return string
	 */
	public function getUsernameIcon()
	{
		return $this->usernameIcon;
	}

	/**
	 * @param string $usernameIcon
	 */
	public function setUsernameIcon($usernameIcon)
	{
		$this->usernameIcon = $usernameIcon;
	}

	/**
	 * @return string
	 */
	public function getPasswordIcon()
	{
		return $this->passwordIcon;
	}

	/**
	 * @param string $passwordIcon
	 */
	public function setPasswordIcon($passwordIcon)
	{
		$this->passwordIcon = $passwordIcon;
	}

	/**
	 * @return string
	 */
	public function getForgotPass()
	{
		return $this->forgotPass;
	}

	/**
	 * @param string $forgotPass
	 */
	public function setForgotPass($forgotPass)
	{
		$this->forgotPass = $forgotPass;
	}

	/**
	 * @return string
	 */
	public function getLogo()
	{
		return $this->logo;
	}

	/**
	 * @param string $logo
	 */
	public function setLogo($logo)
	{
		$this->logo = $logo;
	}

	/**
	 * @return string
	 */
	public function getBg()
	{
		return $this->bg;
	}

	/**
	 * @param string $bg
	 */
	public function setBg($bg)
	{
		$this->bg = $bg;
	}

	/**
	 * @return string
	 */
	public function getResetPassMsg()
	{
		return $this->resetPassMsg;
	}

	/**
	 * @param string $resetPassMsg
	 */
	public function setResetPassMsg($resetPassMsg)
	{
		$this->resetPassMsg = $resetPassMsg;
	}

	/**
	 * @return array
	 */
	public function getLayout()
	{
		return $this->layout;
	}

	/**
	 * @param array $layout
	 */
	public function setLayout($layout)
	{
		$this->layout = $layout;
	}

	/**
	 * @return ITranslator
	 */
	public function getTranslator()
	{
		return $this->translator;
	}

	/**
	 * @param ITranslator $translator
	 */
	public function setTranslator($translator)
	{
		$this->translator = $translator;
	}

}