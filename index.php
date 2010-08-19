<?php
# Alexander Weigl <alexweigl@gmail.com>
# Date: 2010-08-03
#
# Licence under Creative Commons 3.0 - by-sa
#
# Small controller for well-formed urls 
#

###############################################################################
## Include and Bootstrap Section

include("include/config.inc.php");
include("callbacks.inc.php");
include("helper.inc.php");


set_include_path(implode(PATH_SEPARATOR, 
    array(
        realpath(APP_DIR),
        get_include_path()
    ))
);
###############################################################################

###############################################################################
## Functions 
function handle($chunks = false)
{
    $page = ! $chunks ? "default" 
                      : array_shift( $chunks );

    if($chunks)                  
        $func = array_shift($chunks);
    else 
    {
        $func = "index";
        $chunks = array();    
    }
    dispatch($page, $func, $chunks);
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
    
    if( !$chunks || !$chunks[0] )
        handle();
    else
        handle($chunks);
}
else
{
    handle();
}

##############################################################################
?>
