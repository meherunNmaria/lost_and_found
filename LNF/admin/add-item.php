
<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Post Item</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <?php 
if(isset($_POST['submit']))
{

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $location = $_POST['location'];


    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];
    }
    else
    {
        $featured = "No"; 
    }

    if(isset($_POST['active']))
    {
        $active = $_POST['active'];
    }
    else
    {
        $active = "No"; 
    }

    
    if(isset($_FILES['image']['name']))
    {
      
        $image_name = $_FILES['image']['name'];

       
        if($image_name!="")
        {
         
            $ext = end(explode('.', $image_name));

          
            $image_name = "Item-Name-".rand(0000,9999).".".$ext; //New Image Name May Be "Food-Name-657.jpg"

            $src = $_FILES['image']['tmp_name'];

            $dst = "../images/Item/".$image_name;


            $upload = move_uploaded_file($src, $dst);

            
            if($upload==false)
            {
              
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                header('location:'.SITEURL.'admin/add-food.php');
                
                die();
            }

        }

    }
    else
    {
        $image_name = ""; 
    }
    $sql2 = "INSERT INTO tbl_item SET 
        title = '$title',
        description = '$description',
        location_id = '$location',
        image_name = '$image_name',
        category_id = '$category',
        featured = '$featured',
        active = '$active',
        date= '$date'
    ";

    $res2 = mysqli_query($conn, $sql2);

    if($res2 == true)
    {
       
        $_SESSION['add'] = "<div class='success'>Item Added Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-item.php');
    }
    else
    {

        $_SESSION['add'] = "<div class='error'>Failed to Add Item.</div>";
        header('location:'.SITEURL.'admin/manage-item.php');
    }


}

?>

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Item">
                    </td>
                </tr>
                

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Item"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Date: </td>
                    <td>
                        <input type="date" name="date">   
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                               
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                               
                                $res = mysqli_query($conn, $sql);

                               
                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                       
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                   
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Location: </td>
                    <td>
                        <select name="location">

                            <?php 
                            
                            
                                $sql = "SELECT * FROM tbl_location WHERE active='Yes'";
                               
                                $res = mysqli_query($conn, $sql);

                               
                                $count = mysqli_num_rows($res);

                            
                                if($count>0)
                                {
                                   
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                      
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                   
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            

                               
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Post Item" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
     

    </div>
</div>
