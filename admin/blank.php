<?php include './inc/header.php'; ?>



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
                    How Engaged Our Users Daily
                </h6>
                <!-- page content start  -->
                    <?php  
                        $do = isset($_GET['do']? $_GET['do']: 'Manage');

                        if($do == 'Manage'){
                            echo 'We will manage all the users from here';
                        }
                        else if($do == 'Add'){
                            echo 'We will add new user from here and we are going to create the html in this templae'
                        }
                        else if($do = 'Store'){
                            echo 'After get data from ADD we will store the data in the Database';
                        }
                        else if($do == 'Update'){
                            echo 'After get the new data we will update inside the database';
                        }
                        else if($do = 'Delete'){
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