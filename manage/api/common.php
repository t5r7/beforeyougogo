<?php
    $dataFile = '../data/gogo.txt';
    $logFile = '../data/logs.txt';
    $logAccess = true;
    $separator = '||||';

    // create the data/log files if they don't exist
    if(!file_exists($dataFile)) { file_put_contents($dataFile,''); }
    if(!file_exists($logFile)) { file_put_contents($logFile,''); }

    function logEntry($txt) {
        global $logFile;
        $dateTime = date(DATE_ISO8601);
        file_put_contents($logFile, "[$dateTime]: $txt\n", FILE_APPEND);
    }

    function getAccessIP() {
        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    function returnError($error) {
        header('Content-Type: application/json');
        die("{\"error\":\"$error\"}");
    }

    function returnSuccess($message) {
        header('Content-Type: application/json');
        die("{\"success\":\"$message\"}");
    }

    function removeTrailingSlash($input) {
        if(substr($input, strlen($input)-1, 1) == '/') {
            return substr($input, 0, -1);
        } else {
            return $input;
        }
    }

    function addLeadingSlash($input) {
        if(substr($input, 0, 1) !== '/') { $input = "/$input"; }
        return $input;
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

    function abcEntries() {
        global $dataFile;
        $userIP = getAccessIP();
        logEntry("($userIP) alphabetized entries");
        $data = explode("\n", file_get_contents($dataFile));
        $data = array_filter($data); 
        natsort($data); // i love how both of these are php array functions yet one returns a bool and one returns the array
        file_put_contents($dataFile, implode($data,"\n")); // rewrite them to the file
    }

    function addEntry($source, $dest) {
        global $dataFile, $separator;
        $source = strtolower($source);
        $userIP = getAccessIP();
        logEntry("($userIP) added redirect from ($source) to ($dest)");
        file_put_contents($dataFile, "\n$source$separator$dest", FILE_APPEND);
    }

    function removeEntry($source) {
        global $dataFile, $separator;
        $source = removeTrailingSlash(strtolower($source));
        $source = addLeadingSlash($source);
        $userIP = getAccessIP();
        logEntry("($userIP) removed redirect from ($source)");
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