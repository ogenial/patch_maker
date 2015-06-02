<?php
/*
Developed by: Lucas Schirm
E-mail: lucas@ogenial.com.br
Site: http://www.ogenial.com.br
*/  
$dir = dirname(__FILE__) . "/";
$patch = dirname(__FILE__) . "/patch/";


cp($dir, "", $patch);

function cp($dir, $file, $patch) {

    if ($file == "patch" || $file == "index.php")
        return;

    if (is_dir($dir . $file)) {
        $patch = $patch . $file . "/";
        $dir = $dir . $file . "/";
        $files = scandir($dir);
        
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                cp($dir, $file, $patch);
            }
        }
    } else {
        $t = mktime(0, 0, 0, date("m"), date("d"), date("Y"));


        if (filemtime($dir . $file) > $t) {
            if (!file_exists($patch))
                mkdir($patch, 0777, true);
            
            copy($dir . $file, $patch . $file);
        }
    }
}
