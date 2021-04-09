<?php
    require 'common.php';
    
    $entries = Array(); // arrary of entries that will be outputted as json

    $data = explode("\n", file_get_contents($dataFile));
    foreach($data as $line) {
        $entry = @explode($separator, $line);

        if(!empty($entry[0]) && !empty($entry[1])) { // don't return ones with missing source/dest
            $thisEntry = new stdClass; // needs to be an object to have source/dest
            $thisEntry->source = $entry[0];
            $thisEntry->dest = $entry[1];
            
           array_push($entries, $thisEntry);
        }
    }

    header('Content-Type: application/json');
    die(json_encode($entries));
?>