<?php
require_once __DIR__.'/ServiceAlbum.php';

$id = $_GET['id'];

$service = new AlbumService;
$album = $service->GetAlbumById($id);

if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $artistId = $_POST['artistId'];    
    echo $id;
    if ($service->UpdataAlbum($title, $artistId, $id)) {
            header("Location: indexForAlbum.php");
        }
}

?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Edit An Album</h2>
        </div>
        <div class="card-boby">
            <?php if(!empty($message)): ?>
                <div class="alert alert-sucess">
                    <?=$message; ?>
                </div>
            <?php endif; ?>  
            <form method="POST">
                <div class="form-group">
                    <label for="title">Album Title</label>
                    <input value="<?= $album->Title; ?>" type="text" name="title" id="title" class="form-control">
                </div> 
                <div class="form-group">
                    <label for="artistId">Artist ID</label>
                    <input value="<?= $album->ArtistId; ?>" type="text" name="artistId" id="artistId" class="form-control">
                </div>                 
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Update Album</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
