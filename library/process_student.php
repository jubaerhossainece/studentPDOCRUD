<?php
include('Database.php');
include('Session.php');
Session::init();
$db = new Database();
$table = "tbl_student";
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'add'){
        $studentData = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone']
        );
        
        $insert = $db->insert($table, $studentData); 
        if($insert) {
            $type = "message-success";
            $title = "Insertion successful";
            $msg = "Your data has been successfully inserted!";
        }else {
            $type = "message-danger";
            $title = "Insertion failed";
            $msg = "Your data has not been added to the database!";
        }
        Session::set('type', $type);
        Session::set('title', $title);
        Session::set('msg', $msg);
        $home_url = '../index.php';
        header('Location: '.$home_url);
        } elseif($_REQUEST['action'] == 'edit'){
            $id = $_POST['id'];
            if(!empty($id)){
                $studentData = array(
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone']
                );
                $table = 'tbl_student';
                $condition = array('id' => $id);
                $update = $db->update($table, $studentData, $condition);
                if($update){
                    $type = "message-success";
                    $title = "Update successful";
                    $msg = "Your data has been successfully Updated!";
                } else{
                    $type = "message-danger";
                    $title = "Update failed";
                    $msg = "Your data has not been updated!";
                }
                Session::set('type', $type);
                Session::set('title', $title);
                Session::set('msg', $msg);
                $home_url = '../index.php';
                header('Location: '.$home_url);
            }
        
        }elseif($_REQUEST['action'] == 'delete'){
            $id = $_GET['id'];
            $table = 'tbl_student';
            if(!empty($id)){
                $condition = array('id' => $id);
                $delete = $db->delete($table, $condition);
                if($delete){
                    $type = "message-success";
                    $title = "Deletion successful";
                    $msg = "Your data has been Deleted from the database!";
                }else{
                    $type = "message-danger";
                    $title = "Error Deletion";
                    $msg = "Your data has not been deleted from the database!";
                }
                Session::set('type', $type);
                Session::set('title', $title);
                Session::set('msg', $msg);
                $home_url = '../index.php';
                header('Location: '.$home_url);
            
            }
        }
 }
?>










