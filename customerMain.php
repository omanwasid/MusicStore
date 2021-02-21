<?php require 'header.php' ?>
<div id="search" style='float:left;width:100%; text-align:center;'>
<form action=''>
  <p><h3>Please Select Any Search Option</h3></p>
  
    <div style='float:left;width:100%;text-align:center;'>
    <span style='float:left;width:20%;'>
    Track
    <input align="center"type="radio" id="track" name="trackSearch" value="track" style='width:auto;'>
</span>
   
    <span id="searchTrack" style='float:left;'>
        <input type="text" id="searchTrack" name="searchTrack" style='width:auto;'>
        <input type="submit" id="btnSearchtrack" name="btnSearchTrack" value="Search" style='width:auto;'>
</span>
    </div>
  <br>
  
  <div style='float:left;width:100%;text-align:center;'>
  <span style='float:left;width:20%;'>
  Album
    <input type="radio" id="album" name="trackSearch" value="album" style='width:auto;'>
    
</span>
    <span id="searchAlbum" style='float:left;'>
        <input type="text" id="searchAlbum" name="searchAlbum" style='width:auto;'>
        <input type="submit" id="btnSearchAlbum" name="btnSearchAlbum" value="Search" style='width:auto;'>
</span>
</div>    
  <br>
  
  <div style='float:left;width:100%;text-align:center;'>
  <span style='float:left;width:20%;'>
  Artist
    <input type="radio" id="artist" name="trackSearch" value="artist" style='width:auto;'>
</span>
<span id="searchArtist" style='float:left;'>
    
        <input type="text" id="searchArtist" name="searchArtist" style='width:auto;'>
        <input type="submit" id="btnSearchArtist" name="btnSearchArtist" value="Search" style='width:auto;'>
     
</span>
</div>  
  <br>
  
  <div style='float:left;width:100%;text-align:center;'>
  <span style='float:left;width:20%;'>
  Choose A Genre
    <input type="radio" id="genre" name="trackSearch" value="genre" style='width:auto;'>
</span><br>
    <span id="searchGenre" style='float:left;'>
        <select name="searchGenre" style='width:auto;'>
          <?php
            require_once __DIR__.'/services/ServiceGenre.php';
            $service = new GenreService;
            $genres=$service->GetGenres();
            foreach($genres as $genre) {
          ?>
          <option value="<?= $genre->Name; ?>"><?= $genre->Name; ?></option>
            <?php } ?>
        </select>
        <input type="submit" id="btnSearchGenre" name="btnSearchGenre" value="Search" style='width:auto;'>
            </span>
    
            </div>  

</form>
            </div>
<div id="cart"  style='float:left;width:100%;text-align:center;'>

</div>
<div  style='float:left;width:100%;'>
<?php
if(isset($_GET['btnSearchTrack'])){
  require 'ShowSearchResult.php';
}else if(isset($_GET['btnSearchAlbum'])){
    require 'ShowSearchResult.php';
}else if(isset($_GET['btnSearchArtist'])){
    require 'ShowSearchResult.php';
}else if(isset($_GET['btnSearchGenre'])){
    require 'ShowSearchResult.php';
}
?>
</div>

<?php require_once 'footer.php'?>
