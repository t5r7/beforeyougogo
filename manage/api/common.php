<?php
    $dataFile = '../data/gogo.txt';
    $logFile = '../data/logs.txt';
    $separator = '||||';

    header('Content-Type: application/json');
    
    // create the data/log files if they don't exist
    if(!file_exists($dataFile)) { file_put_contents($dataFile,''); }
    if(!file_exists($logFile)) { file_put_contents($logFile,''); }


    function logEntry($txt) {
        global $logFile;
        $dateTime = date(DATE_ISO8601);
        file_put_contents($logFile, "[$dateTime]: $txt\n", FILE_APPEND);
    }

    function returnError($error) {
        die("{\"error\":\"$error\"}");
    }

    function returnSuccess($message) {
        die("{\"success\":\"$message\"}");
    }

    function removeTrailingSlash($input) {
        if(substr($input, strlen($input)-1, 1) == '/') {
            return substr($input, 0, -1);
        } else {
            return $input;
        }
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
        logEntry("Adding redirect from ($source) to ($dest)");
        file_put_contents($dataFile, "$source$separator$dest\n", FILE_APPEND);
    }

    function removeEntry($source) {
        global $dataFile, $separator;
        $source = removeTrailingSlash(strtolower($source));
        logEntry("Removing redirect from ($source)");
        $data = explode("\n", file_get_contents($dataFile));
        $i = 0;
        foreach($data as $line) {
            $entry = @explode($separator, $line);
            if(strtolower($entry[0]) == $source) {
                unset($data[$i]); // remove the entry at index (line) i
                file_put_contents($dataFile, implode($data,"\n")); // rewrite them to the file without the removed
            }
            $i++;
        }
    }
?>