<?php include './inc/header.php' ?>



<!-- ########## START: MAIN PANEL ########## -->



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
                // ternery operator

                isset($_GET['do']) ? $do = $_GET['do'] : $do = 'manage';

                if ($do == "manage") {
                ?>
                    <div class="bd bd-gray-300 rounded table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php
                } else if ($do == "add") {
                ?>
                    <div class="col-12 col-md-8 col-lg-6">
                        <form action="">
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input
                                placeholder="User name"
                                 type="text"
                                 name="name"
                                 class="form-control mb-2">
                                <input
                                 type="submit"
                                 value="Add User"
                                 name="add_user"
                                 class="btn btn-success">
                            </div>
                        </form>
                    </div>

                <?php
                } else if ($do == "store") {
                    echo "After get the data from  ADD we will store the data in the data base";
                } else if ($do == "edit") {
                    echo "We will edit the user information here / HTML Page";
                } else if ($do == "update") {
                    echo "After get the new data we will update inside the database";
                } else if ($do == "delete") {
                    echo "We will delete the user and all the information of the user from the database";
                }
                else {
                    echo '<div class="alert alert-danger"> Sorry!!! Operation failed.  </div>';
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