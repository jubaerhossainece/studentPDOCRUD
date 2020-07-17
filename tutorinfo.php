<?php include('includes/header.php'); ?>
  <div class="panel panel-default">
   <div class = "panel-heading">
    <h2>Add Student<a class="btn btn-success pull-right" href="index.php">Back</a></h2>
</div>
<div class="panel-body">
    <div style="max-width:600px; margin:0 auto">
    <form action="library/process_student.php" method="post">
        <div class="form-group">
            <label for="name">Student Name</label>
            <input class="form-control" type="text" id="name" name="name" placeholder="Your Nmae" required=""/>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input class="form-control" type="text" id="email" name="email" placeholder="Ex. email@example.com" required=""/>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input class="form-control" type="phone" id="phone" name="phone" placeholder="Ex. 01xxxxxxxxxxx" required/>
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input class="form-control" type="password" id="pass" name="password" placeholder="Enter Password" required/>
        </div>
        
        <div class="form-group">
        <input type="hidden" name="action" value="add"/>
        <input class="btn btn-primary" type="submit" name="tutorinfo" value="Save & Continue"/>
        </div>
    </form>
        <p>By Signing up, you agree to our Terms  and conditions</p>
</div>
</div>
</div>
<?php include('includes/footer.php'); ?>