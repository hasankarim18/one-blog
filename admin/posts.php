<?php include './inc/header.php'; ?>
<?php  include 'inc/functions.php'; ?>



<!-- ########## START: MAIN PANEL ########## -->



<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Blank page template</h4>
        <p class="mg-b-0">Blank page template</p>
    </div>
</div>

<div class="br-pagebody">

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card bd-0 shadow-base p-4">
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">
                    Manage all posts
                </h6>
                <!-- page content start  -->
                <?php  
                 $do = isset( $_GET['do']) ? $_GET['do']: $do = 'manage';
                 ?>
                <?php 
                    
                if($do == 'manage'){
                    echo 'We will manage all the users from here'; echo '<br />';
                    echo "Show all posts here";
                        echo 'user-id: '. $_SESSION['id']; echo '<br />';
                echo 'role: '. $_SESSION['role']; echo '<br />'; 
                //  echo 'status'. $_SESSION['status']; echo '<br />';
                $sql = '';
                $autor = $_SESSION['id'];

                if($_SESSION['role'] == 1){
                    $sql =  "SELECT * FROM `post` ";
                }else {
                    $sql =  "SELECT * FROM `post` WHERE posted_by = '$autor'";
                }             
                echo 'super admin should see and manage  all the posts';
                $allPostSql = "SELECT * FROM `post` ";
                $allPostQuery = mysqli_query($db, $sql);

                while ($row = mysqli_fetch_assoc($allPostQuery)) {
                    $title = $row['title'];
                    $description = $row['description'];
                    $posted_by = $row['posted_by'];
                    $postImageSrc = $row['image'];
                ?>
                <div class="card p-2 m-2">
                    <div class="d-flex justify-content-between"">
                        <h6><i>Post Title: </i><?php echo $title; ?></h6>
                        <div class="btn-group">
                            <a class="btn btn-warning">Edit Posts</a>
                            <a class="btn btn-danger text-white">Delete Posts</a>
                        </div>
                    </div>
                    <div>
                        <h6>Author Id: <?php  echo $posted_by; ?> </h6>
                    </div>
                    <div class="row align-items-center rounded-2">
                        <div class="col-12 col-md-8">
                             <p> <i>Description: </i> <?php echo $description;  ?></p>
                        </div>
                        <div class="col-12 col-md-4">
                            <img width="150px" src="<?php echo "assets/images/posts/". $postImageSrc; ?>" alt="<?php echo $title; ?>">
                        </div>                       
                    </div>
                </div>

        <?php 
                } // end while              
                }
                else if($do == 'add'){
                        $userEmail = $_SESSION['email'];
                        $posted_by_sql = "SELECT * FROM `users` WHERE email = '$userEmail'";
                        $posted_by_query = mysqli_query($db, $posted_by_sql);
                    $posted_by = mysqli_fetch_assoc($posted_by_query);
                    $author_id = $posted_by['id'];                           
                    
                    addPosts($db, $author_id);
                }
                else if($do == 'store'){
                    
                    $post_title          = $_POST['post_title'];
                    $post_description    = $_POST['post_descripttion'];
                    $post_category_id    = $_POST['post_category_id'];
                    $posted_by           = $_POST['post_author_id'];
                    $post_status         = $_POST['post_status'];
                    $post_tags           = $_POST['post_tags'];
                   //  $imageName         = $_FILES["user_image"]['name'];
                    $post_image_name     = $_FILES['post_image']['name'];
                    $post_image_size     = $_FILES['post_image']['size'];
                    $post_image_type     = $_FILES['post_image']['type'];
                    $post_date           = $_POST['post_date'];

                 $postImage = uploadImage('post_image');
                // $image_img = $imgD ->img;
                // $image_tmp = $imgD ->tmp;
                $img = $postImage['img'];
                $image_tmp = $postImage['tmp'];
              //  print_r($postImage['img']);

                   // print_r(uploadImage());

                    $post_insert_sql = "INSERT INTO `post`( `title`, `description`, `category_id`, `posted_by`, `status`, `tags`, `image`, `post_date`) VALUES ('$post_title','$post_description','$post_category_id','$posted_by','$post_status','$post_tags','$img','$post_date')";

                    $insert_post = mysqli_query($db, $post_insert_sql);

                    if($insert_post){
                        move_uploaded_file($image_tmp, "assets/images/posts/" . $img);
                        header("Location:posts.php");
                    }else {
                        die("Mysqli Error");
                    }
                    
                }
                else if($do == 'update'){
                    echo 'After get the new data we will update inside the database';
                }
                else if($do == 'delete'){
                    echo 'We will delete the user and all the information of the user from database';
                }

                ?>
                <!-- page content end -->
            </div><!-- d-flex -->
        </div>
    </div>
</div>

</div>

<!-- br-pagebody -->



<?php include './inc/footer.php'; ?>