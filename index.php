<?php   include 'inc/header.php'; ?>
<?php  include 'inc/navigation.php'; ?>

<div role="main" class="main">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">

                <div class="col-md-12 align-self-center p-static order-2 text-center">

                    <h1 class="text-dark font-weight-bold text-8">All Posts</h1>
                    <!-- <span class="sub-title text-dark">Check out our Latest News!</span> -->
                </div>

                <div class="col-md-12 align-self-center order-1">

                    <!-- <ul class="breadcrumb d-block text-center">
                        <li><a href="#">Home</a></li>
                        <li class="active">Blog</li>
                    </ul> -->
                </div>
            </div>
        </div>
    </section>



    <div class="container py-4">
        <div class="row">
            <?php 
					$sql = "SELECT * FROM post WHERE status = 1 ORDER BY id DESC";
					// last post will be first;
				
				?>
            <div class="col-12">
                <div class="blog-posts">
                    <div class="row">
                        <?php  
							$allPostQuery = mysqli_query($db, $sql);
							while ($row = mysqli_fetch_assoc($allPostQuery)) {
							extract($row);
						?>
                        <div class="col-4">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                <div class="post-image">
                                    <a href="single.php?postDetail&post_id=<?php echo $id; ?>">
                                        <img style="height:280px;" src="admin/assets/images/posts/<?php echo $image; ?>"
                                            class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0"
                                            alt="<?php echo $title; ?>" />
                                    </a>
                                </div>
                                <div class="post-content">
                                    <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a
                                            href="blog-post.html"><?php  echo $title; ?></a></h2>
                                    <p>
                                        <?php 
										 $words = explode(" ", $description);
										 $word_20 =  array_slice($words, 0, 20);
										 $descShort = $result = implode(" ", $word_20);
										 echo $descShort;
										 ?>
                                        ...
                                    </p>
                                    <!-- post meta -->
									<div class="post-meta">
											<span>
												<?php  
													$getAuthorSql = "SELECT `id`,`name` FROM users WHERE id = '$posted_by'";
													$getAuthorQuery = mysqli_query($db,$getAuthorSql);
													if($row = mysqli_fetch_assoc($getAuthorQuery)){
														$autorName = $row['name'];
														$authorId = $row['id'];
												?>
												<i class="far fa-user"></i>
												 By <a href="user.php?userId=<?php echo $authorId; ?>"><?php  echo $autorName; ?></a> 
												<?php 
													}
												?>												
											</span>
											<span>
												<?php  
													$getCatSql = "SELECT `cat_name` FROM category WHERE cat_id = '$category_id'";
													$getCatQuery = mysqli_query($db, $getCatSql);
													if($row = mysqli_fetch_assoc($getCatQuery)){
														$cat_name = $row['cat_name'];
														
													?>
														<i class="far fa-folder"></i> 
														<!-- <a href="#">News</a>, -->
														 <a href="#"><?php  echo $cat_name ?></a> 
													<?php 
													}
												 ?>
												
											</span>
											<span>
												<i class="far fa-comments"></i> <a href="#">12 Comments</a>
											</span>
											<div class="d-block mt-2"><a href="blog-post.html" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></div>
										</div>
                                    <!-- post meta -->
                                </div>
                            </article>
                        </div>
                        <?php 
				 			 }

							?>
                    </div>
                    <!-- pagination section -->
                    <div class="row">
                        <div class="col">
                            <ul class="pagination float-right">
                                <li class="page-item"><a class="page-link" href="#"><i
                                            class="fas fa-angle-left"></i></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<?php  include 'inc/footer.php'; ?>