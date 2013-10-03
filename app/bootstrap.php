<?php

    require BASE_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'Application'.DIRECTORY_SEPARATOR.'Autoload.php';
    
    /**
     * Init autoloader
     */
    Autoloader::register();
    $modulesAutoloade = new Autoloader(APPLICATION_PATH.DIRECTORY_SEPARATOR.'modules');
    Autoloader::registerModuleAutoloader($modulesAutoloade);
    
    use Application\Application;
    
    $application = new Application();