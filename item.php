<?php
include "inc/functions.php";
if(isset($_GET['id'])) {
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  list($id,$item_name,$description) = getItemById($id);
}
?>

<?php include "inc/header.php"; ?>
<!-- jumbotron -->
<div class="jumbotron">
  <div class="container">
    <h1 class="display-3 text-center"><?php echo $item_name; ?></h1>
  </div>
</div> <!-- /. jumbotron -->
<!-- Container -->
<div class="container mt-5">
<p class="lead"><?php echo $description; ?></p>

<?php include "inc/footer.php"; ?>
