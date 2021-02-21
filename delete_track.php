<?php
require_once __DIR__.'/ServiceTrack.php';
$id = $_GET['id'];
$service = new TrackService;
if($service->DeleteTrack($id)){
    header("Location: indexForTrack.php");
}
?>