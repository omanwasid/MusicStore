<?php

class Connect
{
  private static $dns ='mysql:host=localhost;dbname=chinook_abridged';
  private static $username = 'root';
  private static $password = '';
  private static $options= [];

  public static function GetConnection()
   {
        return new PDO(self::$dns,self::$username,self::$password, self::$options);
  }
}
?>
<?php
?>