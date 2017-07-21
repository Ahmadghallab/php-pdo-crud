<?php
try {
  // data source name
  $dsn = 'mysql:host=localhost;dbname=blog_db';
  $username = 'root';
  $password = 'root';
  // setting the character set to utf-8
  $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  );
  $db = new PDO($dsn, $username, $password, $options);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo $e->getMessage();
  die();
}

?>
