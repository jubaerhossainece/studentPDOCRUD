<?php 
    ob_start();
 ?>
<?php 
include('library/Session.php');
include('library/Database.php');
include('includes/header.php'); 
Session::init();
?>


<div class="panel panel-default">
<div class="panel heading">
 <h2>Student data<a class="btn btn-green pull-right" href="addstudent.php">Add Student</a></h2>
</div>  
<div class="panel-body">
<table class="table table-stripped">
<tr>
    <th>Serial</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Action</th>
</tr>
<?php 
  $db = new Database();
  $table = "tbl_student";
  $order_by = array('order_by' => 'id DESC'); 
  /*
    $selectcond = array('select' => 'name');
    $wherecond = array(
    'where' =>array('id'=>'2','email'=>'jubaer@example.com'),
    'return_type' => 'single');
    $limit = array('start'=>'2','limit'=>'4')
    */
  $studentData = $db->select($table, $order_by);
 
    if(!empty($studentData)){
        $i = 0;
        foreach($studentData as $data){ 
    $i++;
    ?>
            
                        
<tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $data['name']; ?></td>
    <td><?php echo $data['email']; ?></td>
    <td><?php echo $data['phone']; ?></td>
    <td><a class="btn btn-edit" href="editstudent.php?id=<?php echo $data['id']; ?>">Edit</a>
    <a class="btn btn-danger" href="library/process_student.php?action=delete&id=<?php echo $data['id']; ?>" onclick="return confirm('Are you sure to delete?')">Delete</a></td>
</tr>
<?php
            }
    } else{
        echo "<tr><td colspan = '5'><h2>No Student Data Found!</h2></td></tr>";
        
    }
    ?>                                   
</table>
</div>
</div>

<?php include('includes/footer.php'); ?>
<?php
// Session::init();
// $type = Session::get('type');
// $title = Session::get('title');
// $msg = Session::get('msg');
$type = 'message-danger';
$title = 'message title';
$msg = 'message description is for successful message';
if(!empty($msg)){

 ?> 

 <div>
   
 </div>
<script>
  alertJS({
    type: "<?php echo $type ?>", 
    title: "<?php echo $title ?>",
    desc: "<?php echo $msg ?>"
  });
</script>
<?php    
     Session::set('type', NULL);
     Session::set('title', NULL);
     Session::set('msg', NULL);
}
?>
<script src="alert/alertAction.js"></script>
<?php 
    ob_end_flush();
 ?>