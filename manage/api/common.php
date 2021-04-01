<?php
    $dataFile = '../data/gogo.txt';
    $separator = '||||';
            
    if(!file_exists($dataFile)) {
        file_put_contents($dataFile,'');
    }

    header('Content-Type: application/json');

    function returnError($error) {
        echo "{\"error\":\"$error\"}";
        die();
    }

    function returnSuccess($message) {
        echo "{\"success\":\"$message\"}";
        die();
    }

    function doesEntryExist($source) {
        global $dataFile, $separator;
        $source = strtolower($source);
        $data = explode("\n", file_get_contents($dataFile));
        foreach($data as $line) {
            $entry = @explode($separator, $line);
            if(strtolower($entry[0]) == $source) {
                return true;
            }
        }
        return false;
    }

    function addEntry($source, $dest) {
        global $dataFile, $separator;
        $source = strtolower($source);
        file_put_contents($dataFile, "$source$separator$dest\n", FILE_APPEND);
    }

    function removeEntry($source) {
        global $dataFile, $separator;
        $source = strtolower($source);

        $data = explode("\n", file_get_contents($dataFile));
        $i = 0;
        foreach($data as $line) {
            $entry = @explode($separator, $line);
            if(strtolower($entry[0]) == $source) {
                unset($data[$i]);
                file_put_contents($dataFile, implode($data,"\n"));
            }
            $i++;
        }
    }
?>