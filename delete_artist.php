<?php
require_once __DIR__.'/ServiceArtists.php';

$id = $_GET['id'];
$service = new ArtistService;
if ($service->DeleteArtist($id)) {
    header("Location: indexForArtist.php");
}
?>