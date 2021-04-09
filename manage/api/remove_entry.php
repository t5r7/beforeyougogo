<?php
    require 'common.php';

    if(empty($_GET['source'])) {
        returnError('Missing Source');
    } else {
        $toDel = addLeadingSlash(rawurldecode($_GET['source']));
    
        if(!doesEntryExist($toDel)) { // check if it exists before deleting
            returnError('Can\'t delete that since it doesn\'t seem to exist!');
        }

        removeEntry($toDel); // TODO: Error Checking
        returnSuccess("I think we removed $toDel!");
    }
?>