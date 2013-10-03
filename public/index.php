<?php
    define("APPLICATION_PATH", realpath('../app/'));
    define("BASE_DIR", realpath('../'));
    
    require APPLICATION_PATH.DIRECTORY_SEPARATOR.'bootstrap.php';
    
    $application->run();
    
    