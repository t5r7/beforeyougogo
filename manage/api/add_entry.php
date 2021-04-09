<?php
    require 'common.php';

    $pathRegex = "/([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)/";
    $urlRegex = "/[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/=]*)/";

    // if the source/dest are missing we obviously can't create a ting
    if(empty($_GET['source'])) { returnError('Missing Source'); }
    else if(empty($_GET['dest'])) { returnError('Missing Destination'); }
    $source = base64_decode($_GET['source']);
    $dest = base64_decode($_GET['dest']);

    // add leading slash if it doesn't exist
    $source = addLeadingSlash($source);
    // remove trailing slash
    $source = removeTrailingSlash($source);

    // if they don't match the dodgy regex we'll just reject them outright
    if(!preg_match($pathRegex, $source)) { returnError('Bad Source (does not match regex)'); }

    // reject if it includes the separator
    if(strpos($dest, $separator) || strpos($source, $separator)) { returnError('Cannot contain separator!'); }

    if(preg_match($urlRegex, $dest) || preg_match($pathRegex, $dest)) {
        // it's ok
    } else {
        // if they don't match the dodgy regex we'll just reject them outright
        returnError('Bad Destination (does not match regex)');
    }

    $whatWeDid = "added";
    if($_GET['edit']) {
        $whatWeDid = "edited";
        removeEntry($source);
    }

    if(doesEntryExist($source)) {
        returnError('That source already exists!');
    } else {
        addEntry($source, $dest); // TODO: Error Checking
        returnSuccess("I think we $whatWeDid $source just fine!");
    }
?>