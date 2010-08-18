<? 
// show all errors
error_reporting(E_ALL);

define("ROOT_DIR", dirname(__FILE__).'/..' );
define("APP_DIR" , ROOT_DIR.'/application/');


//start the session
session_start();


set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APP_DIR),
    realpath(ROOT_DIR. '/include'),
    realpath(ROOT_DIR. '/library'),
    get_include_path(),
)));


require_once("AbstractController.class.php");
require_once("ids.inc.php");
require_once("smarty/Smarty.class.php");
?>
