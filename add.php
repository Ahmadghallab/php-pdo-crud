<?php
require __DIR__ . '/vendor/autoload.php';
include "inc/functions.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $item_name = trim(filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING));

  $purifier = new HTMLPurifier();
  $description = $purifier->purify(filter_input(INPUT_POST, 'description'));

  if(empty($item_name) || empty($description)) {
    $error_message = "Please fill in required fields: <strong>Title, Description</strong>";
  } else {
    if(add_item($item_name,$description)) {
      header("Location: index.php");
    } else {
      $error_message = "Could not add item";
    }
  }
}
?>
<?php include "inc/header.php"; ?>
<script src="vendor/ckeditor/ckeditor/ckeditor.js"></script>
<!-- jumbotron -->
<div class="jumbotron">
  <div class="container">
    <h1 class="display-3 text-center">Add Topic</h1>
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
    <input type="text" class="form-control form-control-lg" name="item_name" id="title">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" class="form-control form-control-lg" name="description" rows="10"></textarea>
    <script>
      CKEDITOR.replace('description');
    </script>
  </div>
  <input type="submit" class="btn btn-primary btn-lg" value="Save">
</form>
<?php include "inc/footer.php"; ?>
