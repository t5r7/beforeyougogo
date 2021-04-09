<?php
    require 'common.php';

    if(empty($_GET['source'])) {
        returnError('Missing Source');
    } else {
        $toDel = addLeadingSlash(rawurldecode($_GET['source']));
    
        logEntry("Removing redirect from ($source)");

        if(!doesEntryExist($toDel)) { // check if it exists before deleting
            returnError('Can\'t delete that since it doesn\'t seem to exist!');
        }

        removeEntry($toDel); // TODO: Error Checking
        returnSuccess("Removed $toDel!");
    }
?>