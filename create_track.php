<?php
require_once __DIR__.'../services/ServiceTrack.php';

$service = new TrackService;

if ($service->isDataValid()) 
{
    $name = $_POST['name'];
    $albumId = $_POST['albumId'];
    $mediaTypeId = $_POST['mediaTypeId'];
    $genreId = $_POST['genreId'];
    $composer = $_POST['composer'];
    $milliseconds = $_POST['milliseconds'];
    $bytes = $_POST['bytes'];
    $unitPrice = $_POST['unitPrice'];

    $service->InsertTrack($name, $albumId,  $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice);

} else {
    echo 'Not insertaed';
}

?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Create A Track</h2>
        </div>
        <div class="card-boby">
            <?php if(!empty($message)): ?>
                <div class="alert alert-sucess">
                    <?=$message; ?>
                </div>
            <?php endif; ?>  
            <form method="POST">
                <div class="form-group">
                    <label for="name">Track Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lname">Album ID</label>
                    <input type="text" name="albumId" id="albumId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mediaTypeId">Media Type ID</label>
                    <input type="text" name="mediaTypeId" id="mediaTypeId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="genreId">Genre ID</label>
                    <input type="text" name="genreId" id="genreId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="composer">Composer Name</label>
                    <input type="text" name="composer" id="composer" class="form-control">
                </div>
                <div class="form-group">
                    <label for="milliseconds">Milliseconds</label>
                    <input type="text" name="milliseconds" id="milliseconds" class="form-control">
                </div>
                <div class="form-group">
                    <label for="bytes">Bytes</label>
                    <input type="text" name="bytes" id="bytes" class="form-control">
                </div>
                <div class="form-group">
                    <label for="unitPrice">Unit Price</label>
                    <input type="text" name="unitPrice" id="unitPrice" class="form-control">
                </div>                
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Create A Track</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
