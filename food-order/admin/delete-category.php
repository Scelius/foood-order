<?php 
    //Include Constant Files
    include('../config/constants.php');
    // echo "Delete Page";
    // Check whether the ID and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and delete
        //echo "Get Value And Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file if available
        if($image_name !="")
        {
            //image is available. brišii
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed to remove img then add an error message and stop the process

            if($remove==false)
            {
                //Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                //Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the process
                die();
            }
        }
        //obrisatiii data from DB
            //sql query to delete data from db
            $sql = "DELETE FROM tbl_category WHERE id=$id";
            //execute the qquery
            $res = mysqli_query($conn, $sql);
            //Check whether the data is deleted from database or not
            if($res==true)
            {
                //Set Success Message and redirect
                $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
                //Redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php'); 
            }
            else
            {
                //set Fail message and redirect
                $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
                //Redirect
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        //Redirect to manage category page with message
    }
    else
    {
        //Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>