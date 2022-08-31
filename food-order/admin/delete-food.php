<?php
    //Include Constants Page
    include('../config/constants.php');

    //echo "Delete Food";

    if(isset($_GET['id']) && isset($_GET['image_name'])) //Using '&&' or 'AND' works  
    {
        //Process to delete
        //echo "Process to Delete";

        //1. Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the Image if Available
        //Check whether the image is available or not and delete only if available
        if($image_name != "")
        {
            //It has image name and need to remove from folder
            //Get the img path
            $path = "../images/food/".$image_name;

            //Remove Image file from folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to Remove image
                $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
                //Redirect to Manage Food
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the Process of deleting food
                die();
            }

        }

        //3. Delete Food from Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Check whether the Query executed or not and set session message
        //4. Redirect to Manage Food with session message
        if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Failed to Delete food
            $_SESSION['delete'] = "<div class='error'>Failed To Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        

    }
    else
    {
        //Redirect to Manage Food Page
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>