<?php  include 'inc/header.php'; ?>
<?php  include 'inc/navigation.php'; ?>



<div role="main" class="main">

    <?php  
    if(isset($_GET['postDetail'])){
        $post_id = $_GET['post_id'];
     //   echo $post_id;

        $singlePostSql = "SELECT * FROM post WHERE id = '$post_id'";
        $singlePostQuery = mysqli_query($db,$singlePostSql);

        $row = mysqli_fetch_assoc($singlePostQuery);
        extract($row);

        


    ?>
    <!-- <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">

                <div class="col-md-12 align-self-center p-static order-2 text-center">
                    <h1 class="text-dark font-weight-bold text-8"><?php //  echo $title; ?></h1>                  
                </div> 

                <div class="col-md-12 align-self-center order-1">

                    <ul class="breadcrumb d-block text-center">
                        <li><a href="#">Home</a></li>
                        <li class="active">Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </section> -->

    <div class="container py-4">

        <div class="row">
            <!-- side bar -->
            <?php  include 'inc/sidebar.php'; ?>
            <!-- side bar -->

            <div class="col-lg-9 order-lg-1">
                <div class="blog-posts single-post">

                    <article class="post post-large blog-single-post border-0 m-0 p-0">
                        <div class="post-image ml-0">
                            <a href="blog-post.html">
                                <img src="img/blog/wide/blog-11.jpg"
                                    class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
                            </a>
                        </div>
                        <?php  
                            $month = date("M", strtotime($post_date));
                            $day = date("d", strtotime($post_date));                           
                        ?>
                        <div class="post-date ml-0">

                            <span class="day"><?php  echo $day; ?></span>
                            <span class="month"><?php  echo $month; ?></span>
                        </div>

                        <div class="post-content ml-0">

                            <h2 class="<?php $singlePostBaseLink.$post_id; ?>"><a href="blog-post.html">
                                <?php  echo $title; ?>
                            </a></h2>

                            <div class="post-meta">
                                <span><i class="far fa-user"></i> By <a href="#">John Doe</a> </span>
                                <span><i class="far fa-folder"></i> <a href="#">Lifestyle</a>, <a href="#">Design</a>
                                </span>
                                <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
                            </div>

                            <div style="min-height:400px;" >
                                <div style="float:right;" class="m-2">
                                    <img style="min-height:300px; max-height:400px; max-width:400px;"
                                     src="admin/assets/images/posts/<?php echo $image; ?>" alt="<?php echo $title; ?>">
                                </div>
                               <div></div>
                                <div style="">
                                     <?php  echo empty($description) ? 'No description found!': $description; ?>
                                </div>
                                 
                            </div>
                            <div></div>


                            <!-- author short description -->
                            <div class="post-block mt-4 pt-2 post-author">
                                <?php  
                                    $authorSql = "SELECT `name` FROM users WHERE id = '$posted_by'";
                                    $authorQuery = mysqli_query($db, $authorSql);

                                    $autorRow = mysqli_fetch_assoc($authorQuery);
                                    $author = $autorRow['name'];

                                ?>
                                <h4 class="mb-3">
                                    Author: 
                                    <a  href="author.php?author&authorId=<?php echo $posted_by; ?>">
                                    <?php  echo $author; ?></a>
                                </h4>
                                <div class="img-thumbnail img-thumbnail-no-borders d-block pb-3">
                                    <a href="blog-post.html">
                                        <img src="img/avatars/avatar.jpg" alt="">
                                    </a>
                                </div>                             
                              
                               
                            </div>
                             <!-- author short description -->

                          <!-- comments -->
                          <?php // include 'inc/comments.php';  ?>
                          <!-- comments -->

                        </div>
                    </article>

                </div>
            </div>
        </div>

    </div>

    <?php 
    }
?>



</div>
<?php  include 'inc/footer.php'; ?>