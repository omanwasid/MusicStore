<?php
require_once __DIR__.'../services/ServiceArtists.php';

$service = new ArtistService;

if ($service->isDataValid()) 
{
    $name = $_POST['name'];
    
    $service->InsertArtist($name);
} else {
    echo 'Not insertaed';
}
?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Create An Artist</h2>
        </div>
        <div class="card-boby">
            <?php if(!empty($message)): ?>
                <div class="alert alert-sucess">
                    <?=$message; ?>
                </div>
            <?php endif; ?>  
            <form method="POST">
                <div class="form-group">
                    <label for="name">Artist Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>                
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Insert An Artist</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
