<?php include './inc/header.php'; ?>
<?php  include 'inc/functions.php'; ?>



<!-- ########## START: MAIN PANEL ########## -->



<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
       
      
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
                 // jodi do set kora theke tahole do get koro na thakle do = manage set koro
                 ?>
                <?php 
               

                if($do == 'manage'){
                       
                        //  echo 'status'. $_SESSION['status']; echo '<br />';
                        $sql = '';
                        $autor = $_SESSION['id'];

                        if($_SESSION['role'] == 1){
                            echo "You are <span class='text-danger'>Super Admin </span> you are eleigible to see all posts and manage all posts.";
                            $sql =  "SELECT * FROM `post` ";
                        }else {
                              echo "You are <span class='text-danger'>Editor </span> you can only see your posts and manage your posts.";
                            $sql =  "SELECT * FROM `post` WHERE posted_by = '$autor'";
                        }             
                        echo 'super admin should see and manage  all the posts';
                        $allPostSql = "SELECT * FROM `post` ";
                        $allPostQuery = mysqli_query($db, $sql);

                        while ($row = mysqli_fetch_assoc($allPostQuery)) {
                        
                            $post_id = $row['id'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $posted_by = $row['posted_by'];
                            $postImageSrc = $row['image'];
                        ?>
                    <div class="card p-2 m-2">
                        <div class="d-flex justify-content-between"">
                            <h6><i>Post Title: </i><?php echo $title; ?></h6>
                            <div class="btn-group">
                                <a href="posts.php?do=update&id=<?php echo $post_id;  ?>" class="btn btn-warning">Edit Posts</a>
                                <a href=""
                                 data-toggle="modal" 
                                 data-target="#deleteModal<?Php echo $post_id;  ?>"
                                 class="btn btn-danger text-white">Delete Posts</a>
                                
                            </div>
                             <?php  deletePostModal($post_id, $title, $postImageSrc) ?>
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
                } // end if
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
                // update post 
                else if($do == 'update'){
                    if(isset($_GET['id'])){
                        $edit_post_id = $_GET['id'];
                       $sql = "SELECT * FROM `post` WHERE id = '$edit_post_id'";
                        $get_edit_post = mysqli_query($db, $sql);

                      if($row = mysqli_fetch_assoc($get_edit_post)){
                        $id             = $row['id'];
                        $title          = $row['title'];
                        $description    = $row['description'];
                        $cat_id         = $row['category_id'];
                        $posted_by      = $row['posted_by'];
                        $status         = $row['status'];
                        $tags           = $row['tags'];
                        $view_count     = $row['view_count'];
                        $image          = $row['image'];


                       editPosts($db, $id, $title, $description, $cat_id, $posted_by, $status, $tags, $image);
                      }

                    }
                  //  echo 'After get the new data we will update inside the database';
                }
                else if($do == 'edit'){
                      if(isset($_POST['edit_post'])){ 
                    $old_image_name = $_POST['old_image_name'];
                    $updatedImageName = $_FILES["update_post_image"]['name'];  
                      
                    $updateImage = uploadImage('update_post_image');
                   // $image_img = $imgD ->img;
                   // $image_tmp = $imgD ->tmp;//
                    $updateImg = $updateImage['img'];
                    $updateImage_tmp = $updateImage['tmp'];

                    $post_id                  = $_POST['post_id']; 
                    $edit_post_title          = $_POST['edit_post_title'];
                    $edit_post_descripttion   = $_POST['edit_post_descripttion'];
                    $edit_post_category_id    = $_POST['edit_post_category_id'];
                    $edit_post_status         = $_POST['edit_post_status'];
                    $edit_post_tags           = $_POST['edit_post_tags'];

                  //  $update_post_sql = null;

                    if(!empty($updatedImageName)){
                       $update_post_sql = "UPDATE `post` SET `title`='$edit_post_title',`description`='$edit_post_descripttion',`category_id`='$edit_post_category_id',`status`='$edit_post_status',`tags`='$edit_post_tags',`image`='$updateImg' WHERE id = '$post_id'";
                       $update_with_image_query = mysqli_query($db, $update_post_sql);
                       if($update_with_image_query){
                        move_uploaded_file($updateImage_tmp, "assets/images/posts/" . $updateImg);
                        $update_post_sql = "";
                        header("Location:posts.php");
                       }
                    }else {
                         $update_post_sql = "UPDATE `post` SET `title`='$edit_post_title',`description`='$edit_post_descripttion',`category_id`='$edit_post_category_id',`status`='$edit_post_status',`tags`='$edit_post_tags' WHERE id = '$post_id'";
                       $update_without_image_query = mysqli_query($db, $update_post_sql);
                       if($update_without_image_query){
                       $update_post_sql =  "";
                        header("Location:posts.php");
                       }
                    }



                    // $insert_post = mysqli_query($db, $post_update_sql);

                    // if($insert_post){
                    //     move_uploaded_file($image_tmp, "assets/images/posts/" . $img);
                    //     header("Location:posts.php");
                    // }else {
                    //     die("Mysqli Error");
                    // }

                 }  // isset($_POST['edit_post'])
                }
                else if($do == 'delete'){
                 
                    if(isset($_GET['deletePostId'])){
                        $deltePostId = $_GET['deletePostId'];
                        echo "delteting post id:  ";
                        echo $deltePostId;
                        $post_delte_sql = "DELETE FROM `post` WHERE id = '$deltePostId'";
                        $delete_post_query = mysqli_query($db,$post_delte_sql );

                        if($delete_post_query){
                            header("Location: posts.php");
                        }else {
                            die('Error');
                        }

                    ?>


                <!-- Modal -->
              



                    <?php 
                    
                    }

                ?>

                <!-- Button trigger modal -->
              
              <?php 
                   
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