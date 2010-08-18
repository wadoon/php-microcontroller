<?php
require_once('IDS/Init.php');
try {

    $request = array(
        'REQUEST' => $_REQUEST,
        'GET' => $_GET,
        'POST' => $_POST,
        'COOKIE' => $_COOKIE
    );


    $init = IDS_Init::init(dirname(__FILE__) . '/../library/IDS/Config/Config.ini.php');
    $init->config['General']['base_path'] = dirname(__FILE__) . '/../library/IDS/';
    $init->config['General']['use_base_path'] = true;
    $init->config['Caching']['caching'] = 'none';

    $ids = new IDS_Monitor($request, $init);
    $result = $ids->run();

    if (!$result->isEmpty()) {
        echo $result;

        require_once 'IDS/Log/File.php';
        require_once 'IDS/Log/Composite.php';

        $compositeLog = new IDS_Log_Composite();
        $compositeLog->addLogger(IDS_Log_File::getInstance($init));

        require_once 'IDS/Log/Email.php';
        require_once 'IDS/Log/Database.php';

        $compositeLog->addLogger(
            IDS_Log_Email::getInstance($init),
            IDS_Log_Database::getInstance($init)
        );
        
        $compositeLog->execute($result);
        

    } else {
        //echo '<a href="?test=%22><script>eval(window.name)</script>">No attack detected - click for an example attack</a>';
    }
} catch (Exception $e) {
    printf(
        'An error occured: %s',
        $e->getMessage()
    );
}
?>
