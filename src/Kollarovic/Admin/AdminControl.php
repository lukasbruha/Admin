<?php

namespace Kollarovic\Admin;

use Kollarovic\Navigation\ItemsFactory;
use Kollarovic\Navigation\NavigationControl;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Security\User;



class AdminControl extends Control
{
	
	/** @var array */
	public $onLoggedOut;

	/** @var array */
	public $onSearch;

	/** @var ItemsFactory */
	private $itemsFactory;

	/** @var ILoaderFactory */
	private $loaderFactory;

	/** @var User */
	private $user;

	/** @var string */
	private $pageTitle;

	/** @var string */
	private $skin;
	
	/** @var string */
	private $logo;

	/** @var string */
	private $adminName;

	/** @var string */
	private $userName;

	/** @var string */
	private $userImage;

	/** @var string */
	private $pageName;

	/** @var string */
	private $content;

	/** @var string */
	private $header;

	/** @var string */
	private $footer;
	
	/** @var string */
	private $profile;
	
	/** @var string */
	private $signOut;
	
	/** @var string */
	private $search;

	/** @var string */
	private $navbar;

	/** @var string */
	private $navigationName;

	/** @var string */
	private $profileUrl;

	/** @var boolean */
	private $ajaxRequest = FALSE;
	
	/** @var boolean */
	private $showSearch;
	
	/** @var array */
	private $layout;
	
	


	function __construct(ItemsFactory $itemsFactory, ILoaderFactory $loaderFactory, User $user)
	{
		parent::__construct();
		$this->itemsFactory = $itemsFactory;
		$this->loaderFactory = $loaderFactory;
		$this->user = $user;
	}


	public function render(array $options = [])
	{
		$this->template->setFile($this->getLayout()['templates']['admin']);
		$this->template->pageTitle = $this->pageTitle;
		$this->template->skin = $this->skin;
		$this->template->profileUrl = $this->profileUrl;
		$this->template->userName = $this->userName;
		$this->template->userImage = $this->userImage;
		$this->template->adminName = $this->adminName;
		$this->template->pageName = $this->pageName;
		$this->template->content = $this->content;
		$this->template->header = $this->header;
		$this->template->footer = $this->footer;
		$this->template->profile = $this->profile;
		$this->template->signOut = $this->signOut;
		$this->template->search = $this->search;
		$this->template->navbar = $this->navbar;
		$this->template->ajax = $this->ajaxRequest;
		$this->template->showSearch = $this->showSearch;
		$this->template->logo = $this->logo;
		$this->template->rootItem = $this->getRootItem();
		foreach ($options as $key => $value) {
			$this->template->$key = $value;
		}
		$this->template->render();
	}


	public function renderPanel(array $options = [])
	{
		$this['navigation']->renderPanel($options);
	}


	public function handleSignOut()
	{
		$this->user->logout();
		$this->onLoggedOut();
	}


	protected function createTemplate($class = NULL)
	{
		$template = parent::createTemplate($class);
		if (!array_key_exists('translate', $template->getLatte()->getFilters())) {
			$template->addFilter('translate', function($str){return $str;});
		}
		return $template;
	}


	protected function createComponentSearchForm()
	{
		$form = new Form();
		$form->addText('key');
		$form->onSuccess[] = function($form) {
			$this->onSearch($form->values->key);
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


	protected function createComponentNavigation()
	{
		return new NavigationControl($this->getRootItem(), $this->layout);
	}


	private function getRootItem()
	{
		return $this->itemsFactory->create($this->navigationName);
	}

	/**
	 * @return array
	 */
	public function getOnLoggedOut()
	{
		return $this->onLoggedOut;
	}

	/**
	 * @param array $onLoggedOut
	 */
	public function setOnLoggedOut($onLoggedOut)
	{
		$this->onLoggedOut = $onLoggedOut;
	}

	/**
	 * @return array
	 */
	public function getOnSearch()
	{
		return $this->onSearch;
	}

	/**
	 * @param array $onSearch
	 */
	public function setOnSearch($onSearch)
	{
		$this->onSearch = $onSearch;
	}

	/**
	 * @return IItemsFactory
	 */
	public function getItemsFactory()
	{
		return $this->itemsFactory;
	}

	/**
	 * @param IItemsFactory $itemsFactory
	 */
	public function setItemsFactory($itemsFactory)
	{
		$this->itemsFactory = $itemsFactory;
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
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @param User $user
	 */
	public function setUser($user)
	{
		$this->user = $user;
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
	public function getSkin()
	{
		return $this->skin;
	}

	/**
	 * @param string $skin
	 */
	public function setSkin($skin)
	{
		$this->skin = $skin;
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
	public function getAdminName()
	{
		return $this->adminName;
	}

	/**
	 * @param string $adminName
	 */
	public function setAdminName($adminName)
	{
		$this->adminName = $adminName;
	}

	/**
	 * @return string
	 */
	public function getUserName()
	{
		return $this->userName;
	}

	/**
	 * @param string $userName
	 */
	public function setUserName($userName)
	{
		$this->userName = $userName;
	}

	/**
	 * @return string
	 */
	public function getUserImage()
	{
		return $this->userImage;
	}

	/**
	 * @param string $userImage
	 */
	public function setUserImage($userImage)
	{
		$this->userImage = $userImage;
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
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * @param string $content
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}

	/**
	 * @return string
	 */
	public function getHeader()
	{
		return $this->header;
	}

	/**
	 * @param string $header
	 */
	public function setHeader($header)
	{
		$this->header = $header;
	}

	/**
	 * @return string
	 */
	public function getFooter()
	{
		return $this->footer;
	}

	/**
	 * @param string $footer
	 */
	public function setFooter($footer)
	{
		$this->footer = $footer;
	}

	/**
	 * @return string
	 */
	public function getProfile()
	{
		return $this->profile;
	}

	/**
	 * @param string $profile
	 */
	public function setProfile($profile)
	{
		$this->profile = $profile;
	}

	/**
	 * @return string
	 */
	public function getSignOut()
	{
		return $this->signOut;
	}

	/**
	 * @param string $signOut
	 */
	public function setSignOut($signOut)
	{
		$this->signOut = $signOut;
	}

	/**
	 * @return string
	 */
	public function getSearch()
	{
		return $this->search;
	}

	/**
	 * @param string $search
	 */
	public function setSearch($search)
	{
		$this->search = $search;
	}

	/**
	 * @return string
	 */
	public function getNavbar()
	{
		return $this->navbar;
	}

	/**
	 * @param string $navbar
	 */
	public function setNavbar($navbar)
	{
		$this->navbar = $navbar;
	}

	/**
	 * @return string
	 */
	public function getNavigationName()
	{
		return $this->navigationName;
	}

	/**
	 * @param string $navigationName
	 */
	public function setNavigationName($navigationName)
	{
		$this->navigationName = $navigationName;
	}

	/**
	 * @return string
	 */
	public function getProfileUrl()
	{
		return $this->profileUrl;
	}

	/**
	 * @param string $profileUrl
	 */
	public function setProfileUrl($profileUrl)
	{
		$this->profileUrl = $profileUrl;
	}

	/**
	 * @return boolean
	 */
	public function isAjaxRequest()
	{
		return $this->ajaxRequest;
	}

	/**
	 * @param boolean $ajaxRequest
	 */
	public function setAjaxRequest($ajaxRequest)
	{
		$this->ajaxRequest = $ajaxRequest;
	}

	/**
	 * @return boolean
	 */
	public function isShowSearch()
	{
		return $this->showSearch;
	}

	/**
	 * @param boolean $showSearch
	 */
	public function setShowSearch($showSearch)
	{
		$this->showSearch = $showSearch;
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





}
