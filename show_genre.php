<?php
require_once __DIR__.'../services/ServiceGenre.php';

$service = new GenreService;
$genre = $service->GetGenres();
?>

<?php require 'header.php';?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Genre</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Genre ID</th>
                    <th>Name</th>                    
                </tr>
                <?php foreach($genre as $gen): ?>
                <tr>
                    <td><?= $gen->GenreId; ?></td>
                    <td><?= $gen->Name; ?></td>                    
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
 
<?php require 'footer.php';?>

    