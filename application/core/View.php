<?php
namespace Core;

class View
{
	protected static $viewPath = "/application/veiws/";
	
	public static function render ($view, $args = [])
	{
		extract($args,EXTR_SKIP);
		$head=ROOT_FOLDER .static::$viewPath . "head.php";
		$nav=ROOT_FOLDER .static::$viewPath . "nav.php";
		$file=ROOT_FOLDER .static::$viewPath . $view;
		$footer=ROOT_FOLDER .static::$viewPath . "footer.php";
		if (file_exists($file)){
			require $head;
			require $nav;
			require $file;
			require $footer;
		}else{
			throw new \Exception("$file not found");
		}
	}
}