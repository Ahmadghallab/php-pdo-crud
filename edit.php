<?php
require __DIR__ . '/vendor/autoload.php';
include "inc/functions.php";
if(isset($_GET['id'])) {
  list($id,$item_name,$description) = getItemById(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  $item_name = trim(filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING));

  $purifier = new HTMLPurifier();
  $description = $purifier->purify(filter_input(INPUT_POST, 'description'));

  if(empty($item_name) || empty($description)) {
    $error_message = "Please fill in the required fields: <strong>Title, Description";
  } else {
    if(update_item($item_name,$description,$id)) {
      header('Location: index.php');
      exit;
    } else {
      $error_message = "Could not update item";
    }
  }
}
?>
<?php include "inc/header.php"; ?>
<script src="vendor/ckeditor/ckeditor/ckeditor.js"></script>
<!-- jumbotron -->
<div class="jumbotron">
  <div class="container">
    <h1 class="display-3 text-center">Edit: <?php echo $item_name; ?></h1>
  </div>
</div> <!-- /. jumbotron -->
<!-- Container -->
<div class="container mt-5">

  <?php if(isset($error_message)) {
    echo "
    <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
    $error_message
    </div>
    ";
  } ?>

<form class="" action="" method="post">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control form-control-lg" name="item_name" id="title" value="<?php echo $item_name; ?>">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" class="form-control form-control-lg" name="description" rows="10"><?php echo $description; ?></textarea>
    <script>
    CKEDITOR.replace('description');
    </script>
  </div>
  <?php if(!empty($id)) {
    echo "<input type='hidden' name='id' value='$id'>";
  } ?>
  <input type="submit" class="btn btn-primary btn-lg" value="Update">
</form>
<?php include "inc/footer.php"; ?>
