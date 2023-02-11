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

                        if($do == 'manage'){
                            echo 'We will manage all the users from here';
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
                           
                            $post_title = $_POST['post_title'];
                            $post_description = $_POST['post_descripttion'];
                            $post_category_id = $_POST['post_category_id'];
                            $posted_by = $_POST['post_author_id'];
                            $post_status = $_POST['post_status'];
                            $post_tags = $_POST['post_tags'];
                            $post_image = $_FILES['post_image'];
                            $post_date = $_POST['post_date'];

                            $post_insert_sql = "INSERT INTO `post`( `title`, `description`, `category_id`, `posted_by`, `status`, `tags`, `image`, `post_date`) VALUES ('$post_title','$post_description','$post_category_id','$posted_by','$post_status','$post_tags','image-link','$post_date')";

                            $insert_post = mysqli_query($db, $post_insert_sql);

                            if($insert_post){
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