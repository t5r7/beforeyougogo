<?php
    require 'common.php';
    
    $entries = Array();
    $data = explode("\n", file_get_contents($dataFile));
    foreach($data as $line) {
        $entry = @explode($seperator, $line);

        if(!empty($entry[0]) && !empty($entry[1])) {
            $thisEntry = new stdClass;
            $thisEntry->source = $entry[0];
            $thisEntry->dest = $entry[1];
            
           array_push($entries, $thisEntry);
        }
    }

    echo json_encode($entries);
    die();
?>