<?php
require_once __DIR__.'../services/ServiceAlbum.php';

$service = new AlbumService;
if ($service->isDataValid()) 
{
    $title = $_POST['title'];
    $albumId = $_POST['albumId'];
    
    $service->InsertAlbum($title,$albumId);
    
} else {
    echo 'Not insertaed';
}

?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Create An Album</h2>
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
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="albumId">Album ID</label>
                    <input type="text" name="albumId" id="albumId" class="form-control">
                </div>                   
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Insert An Album</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
