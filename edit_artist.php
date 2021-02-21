<?php
require_once __DIR__.'/ServiceArtists.php';

$id = $_GET['id'];

$service = new ArtistService;
$artist = $service->GetArtistById($id);
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    
    if ($service->UpdateArtist($name, $id)) {
            header("Location: indexForArtist.php");
        }
}

?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Edit An Artist</h2>
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
                    <input value="<?= $artist->Name; ?>" type="text" name="name" id="name" class="form-control">
                </div>                
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Update Artist</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
