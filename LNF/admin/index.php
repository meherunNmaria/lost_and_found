
<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1> Admin Dashboard</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="items">



                    <?php 
                       
                        $sql = "SELECT * FROM tbl_category";
                     
                        $res = mysqli_query($conn, $sql);
                        
                        $count = mysqli_num_rows($res);
                    ?>

                  
                    
                   <div class="product">
                   <h3>Category</h3>
                   <h1><?php echo $count; ?></h1>
                </div>

                
                <div class="items">
                    <?php 
                    
                        $sql2 = "SELECT * FROM tbl_item";
                        
                        $res2 = mysqli_query($conn, $sql2);
                       
                        $count2 = mysqli_num_rows($res2);
                    ?>

                   
              
                    <div class="product">
                    <h3>Items</h3>
                    <h1><?php echo $count2; ?></h1>
                </div>

                <div class="items">
                    
                    <?php 
                      
                        $sql3 = "SELECT * FROM tbl_location";
                       
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>

                 
                    <div class="product">
                    <h3>Location</h3>
                    <h1><?php echo $count3; ?></h1>
                </div>

              

                <div class="clearfix"></div>

          

