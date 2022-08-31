<?php

    //Include constants.php file here
    include('../config/constants.php');
    //1. Get the ID of admin to be deleted
    $id = $_GET['id'];
    //2. create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    //Execute the query
    $res = mysqli_query($conn, $sql);
    //Check whether the query executed successfully or not
    if($res==true)
    {
        //Query Executed Successfully and admin deleted
        //echo "Admin Deleted";
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //Redirect to manage admin page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to delete admin
        //echo "Failed to delete admin";
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again.</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
        
    }
    //3. redirect to manage admin page with message (success/error)

?>