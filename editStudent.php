<?php 
    ob_start();
 ?>
<?php 
include('library/Database.php');
include('includes/header.php');
?>
  <div class="panel panel-default">
   <div class = "panel-heading">
    <h2>Update Student<a class="btn btn-success pull-right" href="index.php">Back</a></h2>
</div>

<?php 
      $id = $_GET['id'];
      $db = new Database();
      $table = "tbl_student";
      $wherecond = array(
      'where' => array('id' => $id),
      'return_type' => 'single');
      
      $getData = $db->select($table, $wherecond);
      if(!empty($getData)){
      ?>


<div class="panel-body">
    <div style="max-width:600px; margin:0 auto">
    <form action="library/process_student.php" method="post">
        <div class="form-group">
            <label for="name">Student Name</label>
            <input class="form-control" type="text" id="name" name="name" required="" value = "<?php echo $getData['name']; ?>"/>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input class="form-control" type="text" id="email" name="email" required="" value="<?php echo $getData['email']; ?>" />
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input class="form-control" type="phone" id="phone" name="phone" required value="<?php echo $getData['phone']; ?>" />
        </div>
        <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="action" value="edit">
        <input class="btn btn-edit" type="submit" name="update" value="Update Student">
        </div>
    </form>
</div>
</div>

<?php
      }
      ?>


</div>
<?php include('includes/footer.php'); ?>
<?php 
    ob_end_flush();
 ?>