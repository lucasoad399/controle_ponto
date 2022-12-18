<?php

function sisLoad(string $path, string $file, array $vars = []){

    if(count($vars)>0){
        foreach ($vars as $key => $value) {
            if(strlen($key>0)){
                ${$key} = $value;
            }
        }
    }
    // require realpath(MODEL_PATH . '/Model.php');
    $path = constant(strtoupper($path. '_PATH'));
    
    
    require_once $path . "/$file.php";
    
}

function renderTitle($title, $subtitle, $icon = ''){
    require_once VIEW_PATH . "/templates/title.php";

}

