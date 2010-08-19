<?

###############################################################################
### {{{ Callbacks 
/**
 * initialize a controller
 *
 */
function initctrl( $ctrlinstance )
{
    $ctrlinstance->smarty = createSmarty();
    $ctrlinstance->database = createDatabase();    
}

/**
 * rewrites an incoming request path
 *
 *
 */ 
function reqrewrite($path)
{
    return $path;
}

### }}}

?>
