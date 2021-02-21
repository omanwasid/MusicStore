<?php
require_once __DIR__.'/ServiceTrack.php';

$id = $_GET['id'];
$service = new TrackService;
$track = $service->GetTrackById($id)
;
if (isset($_POST['name']) && isset($_POST['unitPrice']))  {
    $name = $_POST['name'];
    $albumId = $_POST['albumId'];
    $mediaTypeId = $_POST['mediaTypeId'];
    $genreId = $_POST['genreId'];
    $composer = $_POST['composer'];
    $milliseconds = $_POST['milliseconds'];
    $bytes = $_POST['bytes'];
    $unitPrice = $_POST['unitPrice'];    
    
    if ($service->UpdateTrack($name, $albumId, $mediaTypeId, $genreId,  $composer,  $milliseconds,  $bytes, $unitPrice,  $id)) {
      header("Location: indexForTrack.php");
    }
}

?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Edit A Track</h2>
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
                    <input value="<?= $track->Name; ?>" type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="albumId">Album ID</label>
                    <input value="<?= $track->AlbumId ?>" type="text" name="albumId" id="albumId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mediaTypeId">MediaType ID</label>
                    <input value="<?= $track->MediaTypeId ?>" type="text" name="mediaTypeId" id="mediaTypeId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="genreId">Genre ID</label>
                    <input value="<?= $track->GenreId; ?>" type="text" name="genreId" id="genreId" class="form-control">
                </div>
                <div class="form-group">
                    <label for="composer">Composer Name</label>
                    <input value="<?= $track->Composer; ?>" type="text" name="composer" id="composer" class="form-control">
                </div>
                <div class="form-group">
                    <label for="milliseconds">Milliseconds</label>
                    <input value="<?= $track->Milliseconds; ?>" type="text" name="milliseconds" id="milliseconds" class="form-control">
                </div>
                <div class="form-group">
                    <label for="bytes">Bytes</label>
                    <input value="<?= $track->Bytes; ?>" type="text" name="bytes" id="bytes" class="form-control">
                </div>
                <div class="form-group">
                    <label for="unitPrice">Unit Price</label>
                    <input value="<?= $track->UnitPrice; ?>" type="text" name="unitPrice" id="unitPrice" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Update Track</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
