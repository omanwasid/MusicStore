<?php 
require_once __DIR__.'/db.php';

class GenreService 
{
    function GetGenres() 
    {
        $connection = Connect::GetConnection();
        $sql = 'SELECT * FROM genre';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $genre = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $genre;
    }
}
?>