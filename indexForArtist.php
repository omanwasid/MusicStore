<?php
require_once __DIR__.'../services/ServiceArtists.php';

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$limit = 20;
$service = new ArtistService;
$total_pages = $service->GetTotalArtistsCount($limit);

$artist = $service->GetArtists($page);
?>

<?php 
    require 'header.php';
?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Artist</h2>
        </div>
             <div class="card-header">
            <a href='create_artist.php'><h5>Add New Artist</h5><a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Artist ID</th>
                        <th>Artist Name</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($artist as $person) {?>
                        
                        <tr class="tablehead">
                            <td><?= $person->ArtistId; ?></td>
                            <td><?= $person->Name; ?></td>                            
                            <td>
                                <a href="edit_artist.php?id=<?= $person->ArtistId?>" class="nav-link">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete this entry???')" href="delete_artist.php?id=<?= $person->ArtistId?>" class="nav-link-delete">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>                
            </table>
                <ul class="pagination">
                    <li><a href="?page=1">First</a></li>

                    <?php for($p=1; $p < $total_pages; $p++){ ?>
                        
                        <li class="<?= $page == $p ? 'active' : ''; ?>"><a href="<?= '?page='.$p; ?>"><?= $p; ?></a></li>
                    <?php }?>
                    <li><a href="?page=<?= $total_pages; ?>"> Last</a></li>
                            
                        
                </ul>
        </div>
    </div>
</div>
 
<?php require 'footer.php';?>

    