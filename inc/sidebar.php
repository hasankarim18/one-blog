<div class="col-lg-3 order-lg-2">
			<aside class="sidebar">
				<!-- search for start -->
				<!-- page-search-results.html -->
				<form action="search.php" method="POST">
					<div class="input-group mb-3 pb-1">
						<input
							name="searchText"
							 class="form-control text-1"
							 placeholder="Search..."
							 name="s"
							 id="s"
							 type="text">
						<span class="input-group-append">
							<button name="search" type="submit" value="" class="btn btn-dark text-1 p-2">
								<i class="fas fa-search m-2"></i>
							</button>
						</span>
					</div>
				</form>
				<!-- search form end -->
				<h5 class="font-weight-bold pt-4">Categories</h5>
				<!-- category and subcategory side bar start -->
				
				<ul class="nav nav-list flex-column mb-5">
					  <?php  
                                        // is_parent = 0 = parent
						// is_parent = 1 = child
						$sql = "SELECT cat_id AS 'pCatId', cat_name AS 'pCatName' FROM category WHERE is_parent = 0 AND status = 1 ORDER BY cat_name ASC";

						$parentCatData = mysqli_query($db, $sql); 

						//  $countData = mysqli_num_rows($parentCatData);

					while($row = mysqli_fetch_assoc($parentCatData)){
							extract($row);
                    ?>
					<li class="nav-item">
						<a class="nav-link " 
						href="category.php?cat_id=<?php echo $pCatId; ?>">
							<?php  echo $pCatName; ?>
						</a>
						<?php  
							 $childSql = "SELECT cat_id AS 'childCatId', cat_name AS 'childCatName' FROM category WHERE is_parent = '$pCatId' AND status = 1 ORDER BY cat_name ASC";
                                             $childCatData = mysqli_query($db, $childSql); 

					//	if(mysqli_num_rows($childCatData)>0){                                                
						?>
						<ul>
							<?php  
							while ($row = mysqli_fetch_assoc($childCatData)) {
							extract($row);
								
							?>     

							<li class="nav-item">
								<a class="nav-link " href="category.php?cat_id=<?php echo $childCatId; ?>">
									 <?php  echo $childCatName; ?>
								</a>
							</li>
							
							<?php  } ?>
						</ul>	

						<?php 
						// }
						?>
				
					</li>
					
					<?php  } ?>
				</ul>
				<div class="tabs tabs-dark mb-4 pb-2">
					<ul class="nav nav-tabs">
						<!-- <li class="nav-item active"><a
								class="nav-link show active text-1 font-weight-bold text-uppercase"
								href="#popularPosts" data-toggle="tab">Popular</a></li> -->
						<li class="nav-item active"><a class="nav-link text-1 font-weight-bold text-uppercase"
								href="#recentPosts" data-toggle="tab">Recent</a></li>
					</ul>
					<div class="tab-content">
						<!-- polular post start -->
						<!-- <div class="tab-pane active" id="popularPosts">
						
							<ul class="simple-post-list">
								<li>
									<div class="post-image">
										<div class="img-thumbnail img-thumbnail-no-borders d-block">
											<a href="blog-post.html">
												<img src="img/blog/square/blog-11.jpg" width="50" height="50"
													alt="">
											</a>
										</div>
									</div>
									<div class="post-info">
										<a href="blog-post.html">Nullam Vitae Nibh Un Odiosters</a>
										<div class="post-meta">
											Nov 10, 2020
										</div>
									</div>
								</li>
								<li>
									<div class="post-image">
										<div class="img-thumbnail img-thumbnail-no-borders d-block">
											<a href="blog-post.html">
												<img src="img/blog/square/blog-24.jpg" width="50" height="50"
													alt="">
											</a>
										</div>
									</div>
									<div class="post-info">
										<a href="blog-post.html">Vitae Nibh Un Odiosters</a>
										<div class="post-meta">
											Nov 10, 2020
										</div>
									</div>
								</li>
								<li>
									<div class="post-image">
										<div class="img-thumbnail img-thumbnail-no-borders d-block">
											<a href="blog-post.html">
												<img src="img/blog/square/blog-42.jpg" width="50" height="50"
													alt="">
											</a>
										</div>
									</div>
									<div class="post-info">
										<a href="blog-post.html">Odiosters Nullam Vitae</a>
										<div class="post-meta">
											Nov 10, 2020
										</div>
									</div>
								</li>
							</ul>
						</div> -->
						<!-- popular post end -->
						<!-- recent post start -->
						<div class="tab-pane active" id="recentPosts">

							<ul class="simple-post-list">
								<?php  
									// recent posts 
									 $recentsql = "SELECT `id`, `title`, `description`, `category_id`, `posted_by`, `status`, `tags`, `view_count`, `image`, `post_date` FROM `post` ORDER BY post_date DESC LIMIT 3";
								     $recentquery = mysqli_query($db, $recentsql);
									while ($row = mysqli_fetch_assoc($recentquery)) {
										extract($row);
										//$recentTitle = $row['title'];
									
								?>
								<li>
									<div class="post-image">
										<div class="img-thumbnail img-thumbnail-no-borders d-block">
											<a href="<?php echo $singlePostBaseLink.$id; ?>">
												<img src="admin/assets/images/posts/<?php  echo $image; ?>" width="50" height="50"
													alt="">
											</a>
										</div>
									</div>
									<div class="post-info">
										<a href="<?php echo $singlePostBaseLink.$id; ?>"><?php  echo $title; ?></a>
										<div class="post-meta">
											<?php  
												$date = date("M,d Y", strtotime($post_date));
												echo $date;
											?>
											
										</div>
									</div>
								</li>								
								<?php } ?>
							</ul>
						</div>
						<!-- recent post end -->
					</div>
				</div>
				<h5 class="font-weight-bold pt-4">About Us</h5>
				<p>Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales
					in, auctor fringilla libero. Nulla nunc dui, tristique in semper vel. Nam dolor ligula, faucibus
					id sodales in, auctor fringilla libero. </p>
				<h5 class="font-weight-bold pt-4">Latest from Facebook</h5>
				<div id="tweet" class="twitter mb-4" data-plugin-tweets
					data-plugin-options="{'username': 'oklerthemes', 'count': 2}">
					<div class="fb-page" data-href="https://web.facebook.com/profile.php?id=100071793499138" data-tabs="timeline" data-width="255" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://web.facebook.com/profile.php?id=100071793499138" class="fb-xfbml-parse-ignore"><a href="https://web.facebook.com/profile.php?id=100071793499138">Web Design and Development</a></blockquote></div>
				</div>
				
				<div id="instafeedNoMargins" class="mb-4 pb-1"></div>
				 <h5 class="font-weight-bold pt-4 mb-2">Tags</h5>
				<div class="mb-3 pb-1">
					<?php  
						$post_id = $_GET['post_id'];
						// echo $post_id;
						$tagSql   = "SELECT  `tags` FROM `post` WHERE id = '$post_id'";
						$tagQuery = mysqli_query($db, $tagSql);
						$tagCount = mysqli_num_rows($tagQuery);
					    if($tagCount == 0){
							echo "No tag found";
						}else {
							$row = mysqli_fetch_assoc($tagQuery);
							$tagString = $tags;
							$tagArr = explode(",", $tagString);
							
							foreach ($tagArr as $value) {
							?>
							<a href="#"><span
							class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">
								<?php  echo $value; ?>
							</span></a>
							<?php 
							}
						}

						
					?>
						<!-- <a href="#"><span
							class="badge badge-dark badge-sm badge-pill text-uppercase px-2 py-1 mr-1">design</span></a> -->
					
					<?php 
					
					?>
					
				</div> 
				
			</aside>
		</div>