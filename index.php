<?php
include "inc/functions.php";
if(isset($_POST['delete'])) {
  $delete_id = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT);
  if(delete_item($delete_id)) {
    header("Location: index.php?msg=Topic+Deleted+Successfully");
  } else {
    header("Location: index.php?msg=Unable+to+delete+topic");
  }
}

if(isset($_GET['msg'])) {
  $error_message = trim(filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING));
}
?>

<?php include "inc/header.php"; ?>
<!-- jumbotron -->
<div class="jumbotron">
  <div class="container">
    <h1 class="display-3 text-center">Stay current</h1>
    <p class="lead text-center mb-4">Sign up for our newsletter, and we'll send you news and tutorials and more!</p>
    <!-- <hr class="my-4"> -->
    <div class="input-group col-lg-6 offset-lg-3">
      <input type="text" class="form-control" placeholder="Enter your email address">
      <span class="input-group-btn">
        <button class="btn btn-primary" type="button">Sign Up</button>
      </span>
    </div>
  </div>
</div> <!-- /. jumbotron -->
<!-- Container -->
<div class="container mt-5">
  <?php if(isset($error_message)) {
    echo "
    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
    $error_message
    </div>
    ";
  } ?>
  <?php foreach(getAllItems() as $item) { ?>
    <div class="row mb-4">
      <div class="col-md-11">
        <h2 class="display-4 mb-4">
          <a href="item.php?id=<?php echo $item['id']; ?>"><?php echo $item['item_name']; ?></a>
        </h2>
        <p class="lead"><?php echo $item['description']; ?></p>
      </div>
      <div class="col-md-1">
        <div class="btn-group" role="group">
          <a id="btnGroupDrop1"  data-toggle="dropdown" >
            <img src="img/down-arrow.svg" id="arrow">
          </a>
          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="edit.php?id=<?php echo $item['id']; ?>">Edit</a>
            <form method='post' action='index.php' onsubmit="return confirm('Are you sure you want to delete?')">
              <input type='hidden' value='<?php echo $item['id']; ?>' name='delete'>
              <input style="cursor:pointer;" type='submit' class='dropdown-item' value='Delete'>
            </form>
          </div>
        </div>
      </div>
    </div>
    <hr class="my-4">
  <?php } ?>
<?php include "inc/footer.php"; ?>
