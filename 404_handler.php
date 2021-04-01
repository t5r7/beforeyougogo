<?php
    require 'manage/api/common.php';
    $dataFile = 'manage/data/gogo.txt';
    
    $path = strtolower(rawurldecode($_SERVER['REQUEST_URI']));

    if(!doesEntryExist($path)) {
        returnError('No redirect setup here!');
    } else {
        $data = explode("\n", file_get_contents($dataFile));
        foreach($data as $line) {
            $entry = explode($separator, $line);
            if(strtolower($entry[0]) == $path) {
                header("Location: $entry[1]");
                returnSuccess("Redirecting to $entry[1]");
            }
        }
        returnError('Error handling redirect');
    }
?>