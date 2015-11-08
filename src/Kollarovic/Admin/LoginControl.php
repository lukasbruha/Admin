<?php

namespace Kollarovic\Admin;

use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;

/**
 * @method LoginControl setLayout(array $layout)
 * @method LoginControl setPageTitle(string $pageTitle)
 * @method LoginControl setBg(string $bg)
 * @method LoginControl setResetPassMsg(string $resetPassMsg)
 * @method LoginControl setLogo(string $logo)
 * @method LoginControl setForgotPass(string $forgotPass)
 * @method LoginControl setPageName(string $pageName)
 * @method LoginControl setPageMsg(string $pageMsg)
 * @method LoginControl setUsernameIcon(string $usernameIcon)
 * @method LoginControl setPasswordIcon(string $passwordIcon)
 *
 * @method array  getLayout()
 * @method string getBg()
 * @method string getLogo()
 * @method string getPageTitle()
 * @method string getResetPassMsg()
 * @method string getPageName()
 * @method string getForgotPass()
 * @method string getPageMsg()
 * @method string getUsernameIcon()
 * @method string getPasswordIcon()
 */
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

}