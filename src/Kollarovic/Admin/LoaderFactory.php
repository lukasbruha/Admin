<?php

namespace Kollarovic\Admin;

use Nette\Object;
use Nette\Http\IRequest;
use Nette\SmartObject;
use WebLoader\Compiler;
use WebLoader\FileCollection;
use WebLoader\Nette\CssLoader;
use WebLoader\Nette\JavaScriptLoader;



class LoaderFactory implements ILoaderFactory
{
	use SmartObject;

	/** @var string **/
	private $wwwDir;

	/** @var IRequest **/
	private $httpRequest;

	/** @var array */
	private $cssFiles = [];

	/** @var string **/
	private $outputDir = 'webtemp';

	/** @var string **/
	private $root;

	/** @var array */
	private $files = [];

	function __construct($wwwDir, IRequest $httpRequest)
	{
		$this->wwwDir = $wwwDir;
		$this->httpRequest = $httpRequest;
		$this->root = __DIR__ . '/assets';
	}


	public function addFile($file)
	{
		$this->files[$file] = $file;
		return $this;
	}


	public function removeFile($file)
	{
		unset($this->cssFiles[$file]);
		return $this;
	}


	public function createCssLoader()
	{
		$fileCollection = $this->createFileCollection(array_filter($this->files, [$this, 'isCss']));
		$compiler = Compiler::createCssCompiler($fileCollection, $this->wwwDir . '/' . $this->outputDir);
		$compiler->addFilter(new \Joseki\Webloader\CssMinFilter());
		$compiler->addFileFilter(new \WebLoader\Nette\CssUrlFilter($this->wwwDir . '/', $this->httpRequest));
		return new CssLoader($compiler, $this->httpRequest->url->basePath . $this->outputDir);
	}


	public function createJavaScriptLoader()
	{
		$fileCollection = $this->createFileCollection(array_filter($this->files, [$this, 'isJs']));
		$compiler = Compiler::createJsCompiler($fileCollection, $this->wwwDir . '/' . $this->outputDir);
		$compiler->addFilter(new \Joseki\Webloader\JsMinFilter());
		return new JavaScriptLoader($compiler, $this->httpRequest->url->basePath . $this->outputDir);
	}


	private function createFileCollection(array $files)
	{
		$fileCollection = new FileCollection($this->root);
		foreach($files as $file) {
			if ($this->isRemoteFile($file)) {
				$fileCollection->addRemoteFile($file);
			} else {
				$fileCollection->addFile($file);
			}
		}
		return $fileCollection;
	}


	private function isRemoteFile($file)
	{
		return (filter_var($file, FILTER_VALIDATE_URL) or strpos($file, '//') === 0);
	}


	private function isCss($file)
	{
		return preg_match('~\.css$~', $file);
	}


	private function isJs($file)
	{
		return preg_match('~(\.js$|\/js)~', $file);
	}

	/**
	 * @return string
	 */
	public function getOutputDir()
	{
		return $this->outputDir;
	}

	/**
	 * @param string $outputDir
	 */
	public function setOutputDir($outputDir)
	{
		$this->outputDir = $outputDir;
	}

	/**
	 * @return string
	 */
	public function getRoot()
	{
		return $this->root;
	}

	/**
	 * @param string $root
	 */
	public function setRoot($root)
	{
		$this->root = $root;
	}

	/**
	 * @return array
	 */
	public function getFiles()
	{
		return $this->files;
	}

	/**
	 * @param array $files
	 */
	public function setFiles($files)
	{
		$this->files = $files;
	}
}