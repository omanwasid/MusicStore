<?php
require_once __DIR__.'../services/ServiceTrack.php';

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$limit = 20;
$service = new TrackService;
$total_pages=$service->GetTotalTracksCount($limit);
$track = $service->GetTracks($page);
?>
<?php require 'header.php';?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Tracks</h2>
        </div>
             <div class="card-header">
             <?php 
        if($_SESSION['isAdmin']==true) {?>
             <a  href='create_track.php'><h5>Add New Track</h5><a>
                 <?php } ?>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr class="tablehead">
                        <th>Track ID</th>
                        <th>Track Name</th>
                        <th>Album ID</th>                   
                        <th>MediaType ID</th>
                        <th>Genre ID</th>
                        <th>Composer Name</th>
                        <th>Milliseconds</th>
                        <th>Bytes</th>
                        <th>Unit Price</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($track as $tr) {?>
                        
                        <tr class="tablehead">
                            <td><?= $tr->TrackId; ?></td>
                            <td><?= $tr->Name; ?></td>
                            <td><?= $tr->AlbumId; ?></td>   
                            <td><?= $tr->MediaTypeId; ?></td>
                            <td><?= $tr->GenreId; ?></td>
                            <td><?= $tr->Composer; ?></td>
                            <td><?= $tr->Milliseconds; ?></td>
                            <td><?= $tr->Bytes; ?></td>
                            <td><?= $tr->UnitPrice; ?></td>                            
                            <?php if($_SESSION['isAdmin']==true){ ?>
                            <td>
                                <a href="edit_track.php?id=<?= $tr->TrackId?>" class="nav-link">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete this entry???')" href="delete_track.php?id=<?= $tr->TrackId?>" class="nav-link-delete">Delete</a>
                            </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>                
            </table>
                <ul class="pagination">
                    <li><a href="?page=1">First</a></li>

                    <?php for($p=1; $p < $total_pages; $p++){ 
                    $showPageNumber=$p+1; ?>
                        
                        <li class="<?= $page == $showPageNumber ? 'active' : ''; ?>"><a href="<?= '?page='.$showPageNumber; ?>"><?= $showPageNumber; ?></a></li>
                    <?php }?>
                    <li><a href="?page=<?= $total_pages; ?>"> Last</a></li>                            
                        
                </ul>
        </div>
    </div>
</div>
 
<?php require 'footer.php';?>

    