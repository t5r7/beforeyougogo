<?php
    require 'common.php';

    if(empty($_GET['source'])) {
        returnError('Missing Source');
    } else {
        if(!doesEntryExist($_GET['source'])) { // check if it exists before deleting
            returnError('Can\'t delete that since it doesn\'t seem to exist!');
        }

        removeEntry($_GET['source']); // TODO: Error Checking
        returnSuccess('Removed that for you!');
    }
?>