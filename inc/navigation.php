<header id="header" class="header-effect-shrink"
    data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
    <div class="header-body border-top-0">
        <div class="header-container container-fluid px-lg-4">
            <div class="header-row">
                <div class="header-column header-column-border-right flex-grow-0">
                    <div class="header-row pr-4">
                        <div class="header-logo">
                            <a href="index.php">
                                <img alt="Porto" width="100" height="48" data-sticky-width="82" data-sticky-height="40"
                                    src="assets/img/logo.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-nav header-nav-links justify-content-center">
                            <div
                                class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                <nav class="collapse header-mobile-border-top">
                                    <ul class="nav nav-pills" id="mainNav">
                                        <?php  
                                        // is_parent = 0 = parent
                                        // is_parent = 1 = child
                                        $sql = "SELECT cat_id AS 'pCatId', cat_name AS 'pCatName' FROM category WHERE is_parent = 0 AND status = 1 ORDER BY cat_name ASC";

                                        $parentCatData = mysqli_query($db, $sql); 

                                      //  $countData = mysqli_num_rows($parentCatData);

                                       while($row = mysqli_fetch_assoc($parentCatData)){
                                            extract($row);
                                                                            
                                    ?>
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle"
                                             href="category.php?cat_id=<?php echo $pCatId; ?>">
                                                <?php  echo $pCatName; ?>
                                            </a>
                                            <!-- home item dropdown was here -->
                                            <?php  
                                            $childSql = "SELECT cat_id AS 'childCatId', cat_name AS 'childCatName' FROM category WHERE is_parent = '$pCatId' AND status = 1 ORDER BY cat_name ASC";
                                             $childCatData = mysqli_query($db, $childSql); 

                                             if($childCatData){                                                
                                            ?>
                                            <ul class="dropdown-menu">
                                                <?php  
                                                while ($row = mysqli_fetch_assoc($childCatData)) {
                                                    extract($row);
                                            ?>
                                                <li>
                                                    <a class="dropdown-item" 
                                                     href="category.php?cat_id=<?php echo $childCatId; ?>"
                                                    >
                                                        <?php  echo $childCatName; ?>
                                                    </a>
                                                </li>
                                                
                                                <?php 
                                                }
                                            ?>


                                            </ul>
                                            <?php 
                                             }
                                             ?>
                                        </li>

                                        <!-- nav_commented was here -->
                                        <?php } ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-column header-column-border-left flex-grow-0 justify-content-center">
                    <div class="header-row pl-4 justify-content-end">
                        <ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean m-0">
                            <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank"
                                    title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank"
                                    title="Twitter"><i class="fab fa-twitter"></i></a></li>
                            <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank"
                                    title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                        <button class="btn header-btn-collapse-nav ml-0 ml-sm-3" data-toggle="collapse"
                            data-target=".header-nav-main nav">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>