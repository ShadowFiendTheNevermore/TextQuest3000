<?php 
namespace TextQuest\HtmlOuter;

use TextQuest\Patterns\Singleton;
/**
* 
*/
class HtmlOuter extends Singleton
{

	protected $pages = [];

	protected $routes = [];

	protected $pathToPages;

	public function setPathToPages($path)
	{
		$this->pathToPages = $path;

		if (is_dir($this->pathToPages)) {
			$this->putPagesFromFolder($this->pathToPages);
		}else{
			return new \Exception('Throw back to read readme.md');
		}
	}

	private function putPagesFromFolder($path)
	{
		$this->pages = getFileList($path);
	}

	private function escapeRouteUrl($url)
	{
		if ($url[0] == '/' && strlen($url) > 1) {
			$url = substr($url, 1);
		}elseif($url[0] == '/' && strlen($url) == 1){
			$url = '';
		}
		return $url;
	}

	public function route($url, $page)
	{

		$clearUrl = $this->escapeRouteUrl($url);

		if (key_exists($url, $this->routes)) {
			throw new \Exception($url . ' already exists in routes ');
		}

		$this->routes[$clearUrl] = realpath($this->pathToPages . '/' . $page);
	}

	public function getAllRoutes()
	{
		return $this->routes;
	}

	public function run()
	{

		$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$clearUrl = trim($urlPath, '/');
		$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

		if (array_key_exists($clearUrl, $this->routes)) {
			require $this->routes[$clearUrl];
		}else{
			throw new \Exception("Route does not exists", 1);
		}

	}


}