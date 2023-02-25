<?php   include 'inc/header.php'; ?>
<?php  include 'inc/navigation.php'; ?>

<div role="main" class="main">

    <?php  
            if(isset($_GET['cat_id'])){
             $cat_id = $_GET['cat_id'];
             $sql = "SELECT `cat_name`,`is_parent`,`status` FROM category WHERE cat_id = '$cat_id'";
			 $cat_query = mysqli_query($db, $sql);

			 $row = mysqli_fetch_assoc($cat_query);
			 extract($row);
			 $parentCatName = null;
			 $parentCatId = null;

			 if($is_parent != 0){
				$getParentSql = "SELECT `cat_name`, `cat_id` FROM category WHERE cat_id = '$is_parent'";
				$getParentQuery = mysqli_query($db, $getParentSql);
				$row = mysqli_fetch_assoc($getParentQuery);
				$parentCatName = $row['cat_name'];
				$parentCatId = $row['cat_id'];
			 }
			             
        ?>
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
        <div class="container">
            <div class="row">

                <div class="col-md-12 align-self-center p-static order-2 text-center">

                    <h1 class="text-dark font-weight-bold text-8"><?php  echo $cat_name; ?></h1>
                    <!-- <span class="sub-title text-dark">Check out our Latest News!</span> -->
                </div>

                <div class="col-md-12 align-self-center order-1">

                    <ul class="breadcrumb d-block text-center">
                        <?php  
								if($is_parent == 0){
								?>
                        <li class="active"><?php  echo $cat_name; ?></li>
                        <?php 
								}else {
								?>
                        <li><a href="#"><?php echo  $parentCatName ? $parentCatName : null;  ?></a></li>
                        <li class="active"><?php  echo $cat_name; ?></li>
                        <?php 
								}
							?>
                        <!-- <li><a href="#">Home</a></li>
							<li class="active">Blog</li> -->
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-4">
        <div class="row">
            <div class="col">
                <div class="blog-posts">
                    <div class="row">
                        <?php  
						//echo $is_parent; echo '<br />';
					
						$catPostSql= null;
						if($is_parent == 0){
							
							$parentId = $cat_id;
							
							$allChildCat = "SELECT `cat_id` FROM category WHERE is_parent = '$cat_id'";
							$allChildCatQuery = mysqli_query($db,$allChildCat);
							$ids = [$cat_id];
							while ($row = mysqli_fetch_assoc($allChildCatQuery)) {
								$childCatId = $row['cat_id'];
							 //	echo $childCatId; echo '<br />';
							  array_push($ids, $childCatId);
							}
							//print_r($arr);
							// $ids = array(26, 27, 28);
							$ids_str = implode(',', $ids);							
							$catPostSql = "SELECT *
									FROM post
									WHERE category_id = 26
									OR category_id IN ($ids_str)";

							// $catPostSql = "SELECT *
							// 			FROM post
							// 			WHERE id = 26
							// 			AND id IN (27, 28)"
							
						}else {
							$catPostSql = "SELECT * FROM post WHERE category_id = '$cat_id'";
						}					
							
							$catPostQuery = mysqli_query($db, $catPostSql);
							while ($row = mysqli_fetch_assoc($catPostQuery)) {
							extract($row);
						?>
                        <div class="col-4">
                            <article class="post post-medium border-0 pb-0 mb-5">
                                <div class="post-image">
                                    <a href="single.php?post=detail&post_id=<?php echo $id; ?>">
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
    <?php 
            }
        ?>


</div>

<?php  include 'inc/footer.php'; ?>