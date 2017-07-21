<?php
require_once "database.php";

// Get All Items
function getAllItems() {
  global $db;
  try {
    $sql = $db->query("SELECT * FROM items_tb");
  } catch(Exception $e) {
    echo $e->getMessage();
    return false;
  }
  return  $sql->fetchAll(PDO::FETCH_ASSOC);
}

// Get Item By ID
function getItemById($id) {
  global $db;
  try {
    $sql = $db->prepare('SELECT * FROM items_tb WHERE id = ?');
    $sql->bindParam(1, $id, PDO::PARAM_INT);
    $sql->execute();
  } catch (Exception $e) {
    echo $e->getMessage();
    return false;
  }
  return $sql->fetch();
}

// Update Item
function update_item($item_name,$description,$id) {
  global $db;
  try {
    $sql = $db->prepare('UPDATE items_tb SET item_name = ?, description = ? WHERE id = ?');
    $sql->bindParam(1, $item_name, PDO::PARAM_STR);
    $sql->bindParam(2, $description, PDO::PARAM_STR);
    $sql->bindParam(3, $id, PDO::PARAM_INT);
    $sql->execute();
  } catch (Exception $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

// Add New Item
function add_item($item_name,$description) {
  global $db;
  try {
    $sql = $db->prepare('INSERT INTO items_tb(item_name,description) VALUES(?,?)');
    $sql->bindParam(1, $item_name, PDO::PARAM_STR);
    $sql->bindParam(2,$description, PDO::PARAM_STR);
    $sql->execute();
  } catch (Exception $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

// Delete Item
function delete_item($id) {
  global $db;
  try {
    $sql = $db->prepare('DELETE FROM items_tb WHERE id = ?');
    $sql->bindParam(1, $id, PDO::PARAM_INT);
    $sql->execute();
  } catch (Exception $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}
?>
