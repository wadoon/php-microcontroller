<?php

function smarty_function_alt($params, &$smarty)
{
    if( !! $params['a'])
        echo $params['a'];
    else
        echo $params['b'];
}

/* vim: set expandtab: */

?>
