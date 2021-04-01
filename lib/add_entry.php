<?php
    require 'common.php';

    // if the source/dest are missing we obviously can't create a ting
    if(empty($_GET['source'])) { returnError('Missing Source'); }
    else if(empty($_GET['dest'])) { returnError('Missing Destination'); }

    $source = $_GET['source'];
    $dest = $_GET['dest'];

    if(substr($source,0,1) !== '/') {
        $source = "/$source";
    }

    $pathRegex = "/([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)/";
    $urlRegex = "/[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/=]*)/";

    // if they don't match the dodgy regex we'll just reject them outright
    if(!preg_match($pathRegex, $source)) {
        returnError('Bad Source (does not match regex)');
    }

    if(strpos($dest, $seperator) || strpos($source, $seperator)) {
        returnError('Cannot contain seperator!');
    }

    if(preg_match($urlRegex, $dest) || preg_match($pathRegex, $dest)) {
        // it's ok
    } else {
        returnError('Bad Destination (does not match regex)');
    }

    if(doesEntryExist($source)) {
        returnError('That source already exists!');
    } else {
        addEntry($source, $dest);
        returnSuccess('I think we added that fine!');
    }
?>