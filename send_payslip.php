<?php
    if(!empty($_POST['data'])){
        $data = $_POST['data'];
        $fname = "test.pdf";
        $file = fopen("test/pdf/" .$fname, 'r');
        fwrite($file, $data);
        fclose($file);
    } else {
        echo "No Data Sent";
    }