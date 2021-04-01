<?php
    require 'common.php';

    if(empty($_GET['source'])) {
        returnError('Missing Source');
    } else {
        if(!doesEntryExist($_GET['source'])) {
            returnError('Can\'t delete that since it doesn\'t seem to exist!');
        }

        removeEntry($_GET['source']);
        returnSuccess('Removed that for you!');
    }
?>