<?php
    require_once realpath(__dir__ . '/../src/config/config.php');
        

    $uri = urldecode(
        parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)
    );
    if($uri == '/' || $uri == '/login' || $uri == '/home'  ){
        $uri = '/day_records.php';
    }
    
    require_once CONTROLLER_PATH . "{$uri}";

    // sisLoad('controller', 'data_generator');


?>
    
</body>
</html>
