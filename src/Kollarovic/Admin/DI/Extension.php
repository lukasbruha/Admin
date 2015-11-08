<?php

namespace Kollarovic\Admin\DI;

use Nette;

class Extension extends Nette\DI\CompilerExtension {

	private function getDefaultConfig() {

		return [
			'wwwDir' => '%wwwDir%',
			'name' => 'Admin',
			'skin' => 'red',
			'footer' => '',
			'profile' => 'Profile',
			'signout' => 'Sign Out',
			'search' => 'Search',
			'ajax' => FALSE,
			'layout' => 'AdminLTE',
			'files' => [],
			'navigation' => 'admin',
			'login' => [
				'pageTitle' => 'Login - Admin',
				'pageName' => 'Admin',
				'pageMsg' => 'Authentication',
				'usernameIcon' => 'envelope',
				'passwordIcon' => 'lock',
				'forgotPass' => 'Forgot Password?',
				'logo' => '',
				'bg' => '',
				'resetPassMsg' => 'On your email was send another instruction.',
			],
		];
	}

	public function loadConfiguration() {
		$config = $this->getConfig($this->getDefaultConfig());
		$builder = $this->getContainerBuilder();

		$loaderFactory = $builder->addDefinition($this->prefix('loaderFactory'))
				->setClass('Kollarovic\Admin\LoaderFactory', ['wwwDir' => $config['wwwDir']]);

		foreach (array_merge($this->getLayout($config['layout'])['files'], $config['files']) as $file) {
			$loaderFactory->addSetup('addFile', [$file]);
		}

		$builder->addDefinition($this->prefix('formRender'))
				->setClass('Tomaj\Form\Renderer\BootstrapRenderer')
				->setAutowired(FALSE);
		
		$builder->addDefinition($this->prefix('baseFormFactory'))
				->setClass('Kollarovic\Admin\Form\BaseFormFactory', [
					'formRender' => $this->prefix('@formRender')
		]);

		$builder->addDefinition($this->prefix('loginFormFactory'))
				->setClass('Kollarovic\Admin\LoginFormFactory');
		
		$builder->addDefinition($this->prefix('resetFormFactory'))
				->setClass('Kollarovic\Admin\ResetFormFactory');

		$builder->addDefinition($this->prefix('loginControlFactory'))
				->setImplement('Kollarovic\Admin\ILoginControlFactory')
				->addSetup('setPageTitle', [$config['login']['pageTitle']])
				->addSetup('setPageName', [$config['login']['pageName']])
				->addSetup('setPageMsg', [$config['login']['pageMsg']])
				->addSetup('setUsernameIcon', [$config['login']['usernameIcon']])
				->addSetup('setLayout', [$this->getLayout($config['layout'])])
				->addSetup('setForgotPass', [$config['login']['forgotPass']])
				->addSetup('setResetPassMsg', [$config['login']['resetPassMsg']])
				->addSetup('setLogo', [$config['login']['logo']])
				->addSetup('setBg', [$config['login']['bg']])
				->addSetup('setPasswordIcon', [$config['login']['passwordIcon']]);

		$builder->addDefinition($this->prefix('adminControlFactory'))
				->setImplement('Kollarovic\Admin\IAdminControlFactory')
				->addSetup('setSkin', [$config['skin']])
				->addSetup('setAdminName', [$config['name']])
				->addSetup('setNavigationName', [$config['navigation']])
				->addSetup('setFooter', [$config['footer']])
				->addSetup('setProfile', [$config['profile']])
				->addSetup('setSignOut', [$config['signout']])
				->addSetup('setSearch', [$config['search']])
				->addSetup('setLayout', [$this->getLayout($config['layout'])])
				->addSetup('setAjaxRequest', [$config['ajax']]);
	}

	
	/**
	 * 
	 * @param string $layout
	 * @return array
	 */
	private function getLayout($layout) {

		$dirA = dirname(__DIR__) . '/assets';
		$dirT = dirname(__DIR__) . '/templates';

		$layouts = [
			'AdminLTE' => [
				'templates' => [
					'admin' => "$dirT/AdminLTE/AdminControl.latte",
					'login' => "$dirT/AdminLTE/LoginControl.latte",
					'navigationDir' => 'AdminLTE',
				],
				'files' => [
					'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
					'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
					"$dirA/AdminLTE/AdminLTE.min.css",
					"$dirA/AdminLTE/_all-skins.min.css",
					"$dirA/AdminLTE/admin.css",
					'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js',
					'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js',
					"$dirA/AdminLTE/app.min.js",
					"$dirA/netteForms.js",
					"https://code.jquery.com/jquery-1.11.3.min.js",
					"https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css",
					"https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css",
					"https://code.jquery.com/ui/1.11.4/jquery-ui.min.js",
					"https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js",
					"$dirA/nette.ajax.js",
					"$dirA/confirm.ajax.js",
					"$dirA/jasny-fileinput.ajax.js",
					"$dirA/nette.init.js",
					"$dirA/grido.css",
					"$dirA/grido.js",
					"$dirA/grido.ext.js",
					"$dirA/grido.ajax.js",
					"$dirA/typeahead.min.js",
					"$dirA/jquery.hashchange.min.js",
					"$dirA/jasny-fileinput.auto.min.js",
					"$dirA/jasny-fileinput.min.js",
					"$dirA/jasny-fileinput.auto.min.js",
					"$dirA/jasny-fileinput.min.css",
					"$dirA/typeahead.css",
					"$dirA/admin.js",
				],
			],
			'Metronic5Material' => [
				'templates' => [
					'admin' => "$dirT/Metronic5Material/AdminControl.latte",
					'login' => "$dirT/Metronic5Material/LoginControl.latte",
					'navigationDir' => 'Metronic5Material',
				],
				'files' => [
					"https://code.jquery.com/jquery-1.11.3.min.js",
					"https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css",
					"https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css",
					"https://code.jquery.com/ui/1.11.4/jquery-ui.min.js",
					"https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js",
					"$dirA/nette.ajax.js",
					"$dirA/confirm.ajax.js",
					"$dirA/dateinput.ajax.js",
					"$dirA/jasny-fileinput.ajax.js",
					"$dirA/nette.init.js",
					"$dirA/grido.css",
					"$dirA/grido.js",
					"$dirA/grido.ext.js",
					"$dirA/grido.ajax.js",
					"$dirA/typeahead.min.js",
					"$dirA/jquery.hashchange.min.js",
					"$dirA/jasny-fileinput.auto.min.js",
					"$dirA/jasny-fileinput.min.js",
					"$dirA/jasny-fileinput.auto.min.js",
					"$dirA/jasny-fileinput.min.css",
					"$dirA/typeahead.css",
					"$dirA/admin.js",
					"$dirA/Metronic5Material/admin.css",
					"$dirA/Metronic5Material/admin.js",
					"$dirA/netteForms.js",
				],
			],
		];

		if(!key_exists($layout, $layouts)){			
			$pos = '';
			foreach ($layouts as $key => $l){
				$pos .= $key . ', ';
			}
			$pos = rtrim($pos, ', ');
			throw new Nette\InvalidArgumentException('Layout "' . $layout . '" does not exist. Possible choices are: ' . $pos);
		}
		
		return $layouts[$layout];
	}

}
