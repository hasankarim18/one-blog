<?php include './inc/header.php'; ?>
<?php include './inc/functions.php'; ?>
<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Manage all users</h4>
        <p class="mg-b-0">Here you can see all the users in our platform and we can take any action with a user.</p>
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
                if($_SESSION['role'] == '1'){
                    include './inc/userManage.php';
                }else {
                    echo '<div class="alert alert-warning" > <h1 class="text-center text-danger"> You don\'t have access!!! </h1></div>';
                }
             
              
              ?>
                <!-- end-role -->


            </div><!-- d-flex -->
        </div>
    </div>
</div>

</div>
<?php include './inc/footer.php'; ?>