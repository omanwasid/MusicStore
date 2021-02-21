<?php
require_once __DIR__.'/ServiceAlbum.php';
$id = $_GET['id'];
$service = new AlbumService;
if ($service->DeleteAlbum($id)) {
    header("Location: indexForAlbum.php");
}
?>