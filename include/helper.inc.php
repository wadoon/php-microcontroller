<?
/*
 *
 *
 */


function createSmarty()
{
    require_once("smarty/Smarty.class.php");
    $smarty = new Smarty();
    $smarty->template_dir = "view";
    return $smarty;
}  

function createDatabase()
{


}

function dispatch($controller, $function, $args)
{
    $chunks = explode(".", $controller);

    $page   = array_pop( $chunks );

    if($chunks)
        $path   = implode( "/", $chunks ).'/';
    else
        $path = "";
        
    $bootfile = "$path/__init__.php";

    @include_once($bootfile);   
    require_once("$path$page.php");
    $cntrlname = ucfirst($page)."Controller";

    $ctrl = new $cntrlname();
    initctrl($ctrl); 

    $template = call_user_func_array(array($ctrl,$function),$args);

    if($template)
        $ctrl->smarty->display($template);
}
?>
