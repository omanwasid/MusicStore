<?php
require_once __DIR__.'../services/ServiceQuery.php';

if (!isset($_POST['page'])) {
    $page = 1;
} else {
    $page = $_POST['page'];
}

$limit = 20;
$service = new QueryService;
$total_pages =0;
$showTrackAll =null;

if (isset($_GET['searchGenre']) && !empty($_GET['searchGenre'])) {
      $searchtext=$_GET['searchGenre'];      
   $total_pages = $service->GetSearchByGenreNameTotalsCount($limit,$searchtext);
  $showTrackAll =$service->SearchByGenreName($page,$searchtext);  
} else {
  $total_pages =$service->GetShowAllTrackTotalsCount($limit);
  $showTrackAll =$service->ShowAllTracks($page); 
}

?>
<?php if(isset($_POST['eh']))
    require 'header.php';
?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>All Tracks</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Track Name</th>
                        <th>Artist Name</th>
                        <th>Album Name</th>                   
                        <th>Genre Name</th>
                        <th>MediaType Name</th>
                        <th>Composer Name</th>
                        <th>Milliseconds</th>
                        <th>Bytes</th>
                        <th>Unit Price</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($showTrackAll as $show) {?>
                        
                        <tr>
                            <td><?= $show->TrackName; ?></td>
                            <td><?= $show->ArtistName; ?></td>
                            <td><?= $show->AlbumName; ?></td>   
                            <td><?= $show->GenreName; ?></td>
                            <td><?= $show->MediaTypeName?></td>
                            <td><?= $show->Composer; ?></td>
                            <td><?= $show->Milliseconds; ?></td>
                            <td><?= $show->Bytes; ?></td>
                            <td><?= $show->UnitPrice; ?></td>                            
                            <td>
                                <a href="add.php?id=<?= $tr->TrackId?>" class="btn btn-info">Add</a>
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
