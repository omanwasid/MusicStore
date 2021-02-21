<?php
require_once __DIR__.'../services/ServiceAlbum.php';

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$limit = 20;
$service = new AlbumService;
$total_pages = $service->GetTotatlAlbumCount($limit);
$album = $service->GetAlbums($page);
?>

<?php 
    require 'header.php';
?>

<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Album</h2>
        </div>
        <div class="card-header">
            <a href='create_album.php'><h5>Add New Album</h5><a>
        </div>  
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr class="tablehead">
                        <th>Album ID</th>
                        <th>Album Title</th>
                        <th>Artist ID</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($album as $al) {?>
                        
                        <tr class="tablehead">
                            <td><?= $al->AlbumId; ?></td>
                            <td><?= $al->Title; ?></td>
                            <td><?= $al->ArtistId; ?></td>                            
                            <td>
                                <a href="edit_album.php?id=<?= $al->AlbumId?>" class="nav-link">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete this entry???')" href="delete_album.php?id=<?= $al->AlbumId?>" class="nav-link-delete">Delete</a>
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

    