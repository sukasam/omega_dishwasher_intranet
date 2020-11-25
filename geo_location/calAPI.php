<?php

date_default_timezone_set("Asia/Bangkok");

if ($_POST['action'] == 'saveGPS') {

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $resultfile = fopen("gpsData.txt", "a") or die("Unable to open file!");
    $txt = date("Y-m-d H:i:s") . " => latitude:" . $latitude . " => longitude:" . $longitude . "\r\n";

    fwrite($resultfile, $txt);

    fclose($resultfile);
    echo 'success';
}
