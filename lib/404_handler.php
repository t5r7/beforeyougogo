<?php
    require 'common.php';

    $path = strtolower(rawurldecode($_SERVER['REQUEST_URI']));

    if(!doesEntryExist($path)) {
        returnError('No redirect setup here!');
    } else {
        $data = explode("\n", file_get_contents($dataFile));
        foreach($data as $line) {
            $entry = explode($seperator, $line);
            if($entry[0] == $path) {
                header("Location: $entry[1]");
                returnSuccess("Redirecting to $entry[1]");
            }
        }
        returnError('Error handling redirect');
    }
?>