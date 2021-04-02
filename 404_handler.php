<?php
    require 'manage/api/common.php';
    $dataFile = 'manage/data/gogo.txt';

    // this is a lot of nested shit should probably change it up
    $path = removeTrailingSlash(strtolower(rawurldecode($_SERVER['REQUEST_URI'])));

     // this adds redundant I/O since if no redirect exists it'll just not redirect anyway
    //
    // if(!doesEntryExist($path)) {
    //     returnError('No redirect setup here!');
    // } else {

        $data = explode("\n", file_get_contents($dataFile));
        foreach($data as $line) {
            $entry = explode($separator, $line);
            if(strtolower($entry[0]) == $path) {
                header("Location: $entry[1]");
                returnSuccess("Redirecting to $entry[1]");
            }
        }
        returnError('No redirect setup here!');

    // }
?>