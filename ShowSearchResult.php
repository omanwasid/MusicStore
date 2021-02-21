<?php
require_once __DIR__.'../services/ServiceQuery.php';

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$limit = 20;
$service = new QueryService;
$total_pages =0;// $service->GetShowAllTrackTotalsCount($limit);
$showTrackAll =null;// $service->ShowAllTracks($page);



$trackSearch='track';
if (isset($_GET['trackSearch']) && !empty($_GET['trackSearch'])) {
  $trackSearch=$_GET['trackSearch'];
}

$queryButtonClick="";
$queryValue="";

//search by  track
if (isset($_GET['searchTrack']) && !empty($_GET['searchTrack'])) {
      $searchtext=$_GET['searchTrack'];
      $queryButtonClick='btnSearchTrack';
      $queryValue="searchTrack";
   $total_pages = $service->GetSearchByTrackNameTotalsCount($limit,$searchtext);
  $showTrackAll =$service->SearchByTrackName($page,$searchtext);
}
else if (isset($_GET['searchAlbum']) && !empty($_GET['searchAlbum'])) { //search by album
      $searchtext=$_GET['searchAlbum'];
      $queryButtonClick='btnSearchAlbum';
      $queryValue="searchAlbum";
   $total_pages = $service->GetSearchByAlbumTitleTotalsCount($limit,$searchtext);
  $showTrackAll =$service->SearchByAlbumTitle($page,$searchtext);
}
else if (isset($_GET['searchArtist']) && !empty($_GET['searchArtist'])) { //search by artist
      $searchtext=$_GET['searchArtist'];
      $queryButtonClick='btnSearchArtist';
      $queryValue="searchArtist";
   $total_pages = $service->GetSearchByArtistNameTotalsCount($limit,$searchtext);
  $showTrackAll =$service->SearchByArtistName($page,$searchtext);
}
else if (isset($_GET['searchGenre']) && !empty($_GET['searchGenre'])) { //search by gerne
      $searchtext=$_GET['searchGenre'];    
      $queryButtonClick='btnSearchGenre';
      $queryValue="searchGenre";
   $total_pages = $service->GetSearchByGenreNameTotalsCount($limit,$searchtext);
  $showTrackAll =$service->SearchByGenreName($page,$searchtext);  
} 
else {
  $total_pages =$service->GetShowAllTrackTotalsCount($limit);
  $showTrackAll =$service->ShowAllTracks($page); 
}

$queryString="&trackSearch={$trackSearch}&{$queryButtonClick}=Search&{$queryValue}=$searchtext";
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
                    <?php foreach($showTrackAll as $show) 
                   // print_r($showTrackAll);
                    {?>
                        
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
                                <a id='<?= $show->TrackID?>' class="nav-link addtrack">Add</a>
                                <a id='<?= $show->TrackID?>' class="nav-link-delete removetrack">Remove</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>                
            </table>
                <ul class="pagination">
                    <li><a href="<?='?page=1'.$queryString; ?>">First</a></li>

                    <?php 
                    $maxPage=$total_pages;
                    $minPage=$page;
                                   
                    for($p=$minPage; $p < $minPage+$maxPage; $p++){ 
                      
                    ?>
                        
                        <li class="<?= $page == $p ? 'active' : ''; ?>">
                            <a href="<?= '?page='.$p.$queryString; ?>"><?= $p; ?></a>
                        </li>
                    <?php }?>
                    <li><a href="?page=<?= $total_pages.$queryString; ?>"> Last</a></li>
                </ul>
        </div>
    </div>
</div>
 