<?php
// Autoload for classes

include("./src/config.php");
include("./src/class/general.php");

spl_autoload_register(
    function ($className) {
		$class_name = strtolower($className);
		$path       = "./src/class/{$class_name}.php";
		if (file_exists($path)) {
		   require_once($path);
		} else {
		   die("The file {$class_name}.php could not be found!");
		}
    }
);

?>