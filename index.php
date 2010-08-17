<?php
# Alexander Weigl <alexweigl@gmail.com>
# Date: 2010-08-03
#
# Licence under Creative Commons 3.0 - by-sa
#
# Small controller for well-formed urls 
#

###############################################################################
## Include Section

include("config.php");

###############################################################################

###############################################################################
## Functions 
function handle($chunks = false)
{
    $page = ! $chunks ? "default" 
                      : $page = array_shift( $chunks );

    $path = str_replace( ".", "/", $page );
    $page = array_pop(explode('.',$page) );

    $ary      = explode("/", $path);
    array_pop($ary);
    $bootfile = ROOT_DIR .'/application/' . implode("/",$ary) . "/__init__.php";

    if(file_exists($bootfile))
        include($bootfile);
       
    include(ROOT_DIR . '/application/'.$path.'.php');
    $cntrlname = ucfirst($page)."Controller";
    $ctrl = new $cntrlname;

    if( count( $chunks ) > 0 )
    {
        $method = array_pop($chunks);
        $template = call_user_func_array(array($ctrl,$method),$chunks);
    }
    else
    {
        $template = $ctrl->index();
    }
    view($template);
}


##############################################################################
## main - section

//complete url
$request_url = $_SERVER['PHP_SELF'];

//script name
$scrp_nam    = basename( $_SERVER['SCRIPT_NAME'] );

if( $pos = strpos( $request_url, $scrp_nam ) )
{
    $request = substr($request_url , 1 + strlen($scrp_nam) + $pos );
    $chunks = explode('/', $request);
    handle($chunks);
}
else
{
    handle();
}

##############################################################################
?>
