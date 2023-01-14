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
                        <table class="table table-bordered table-striped user_info_table">
                            <thead>
                                <tr>
                                    <th scope="col">SL.</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">User Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `users` ORDER BY id ASC";
                                $allUsers = mysqli_query($db, $sql);

                                // get the total number of record
                                $numOfUsers = mysqli_num_rows($allUsers);
                                //  echo $numOfUsers;
                                $message = '';
                                if ($numOfUsers == 0) {
                                    $message = '<div class="alert alert-warning text-dark" >
                                    <h1> No user found! </h1>
                                    </div>';
                                } else {
                                    // SELECT `id`, `name`, `email`, `password`, `phone`, `address`, `role`, `status`, `join_date`, `image` FROM `users` WHERE 1
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($allUsers)) {
                                        $id        =  $row['id'];
                                        $name      =  $row['name'];
                                        $email     =  $row['email'];
                                        $phone     = $row['phone'];
                                        $address   =  $row['address'];
                                        $role      =  $row['role'];
                                        $status    = $row['status'];
                                        $join_date =  $row['join_date'];
                                        // $image     =  $row['image'];

                                        if ($row['image'] == '') {
                                            $image = 'assets/images/blank.png';
                                        } else if ($row['image'] != '') {
                                            $image = 'assets/images/' . $row['image'];
                                        }

                                ?>
                                        <tr>
                                            <th scope="row"> <?php echo $i; ?></th>
                                            <td>
                                                <img src="<?php echo $image ?>" width="50px" height="50px" alt="<?php echo $name; ?>">
                                            </td>
                                            <td>
                                                <h6> <?php echo $name; ?> </h6>
                                            </td>
                                            <td>
                                                <span> <?php echo $email; ?> </span>
                                            </td>
                                            <td>
                                                <span> <?php echo $address; ?> </span>
                                            </td>
                                            <td>
                                                <span> <?php echo $phone; ?> </span>
                                            </td>
                                            <td>
                                                <span>
                                                    <?php
                                                    if ($role == 1) {
                                                        echo '<span class="badge-primary p-1 rounded"> Super Admin </span>';
                                                    } else if ($role == 2) {
                                                        echo '<span class="badge-info p-1 rounded"> Editor </span>';
                                                    } elseif ($role == 3) {
                                                        echo '<span class="badge-warning text-white p-1 rounded"> Subscriber </span>';
                                                    }
                                                    ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php
                                                if ($status == 1) {
                                                    echo '<span class="badge-success p-1 rounded" > Active </span>';
                                                } else if ($status == 0) {
                                                    echo '<span class="badge-danger p-1 rounded" > Inactive </span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="table_action">
                                                    <ul class="ul admin_user_action" type="none">

                                                        <!-- edit details -->
                                                        <li>
                                                            <a href=""> <i class="fa-regular fa-pen-to-square"></i> </a>
                                                        </li>
                                                        <!-- delete user -->
                                                        <li>
                                                            <a href=""><i class="fa-solid fa-trash-can"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                        $i++;
                                    } // while loop ending
                                } // else section ended
                                ?>

                                <?php
                                // shoing message
                                if ($message != '') {
                                    echo '<tr>' . $message . '</tr>';
                                } else {
                                    echo null;
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                <?php
                } else if ($do == "add") {
                ?>
                    <!-- add new user -->
                    <div class="col-12 ">
                        <form action="users.php?do=store" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Full Name</label>
                                        <input placeholder="User name" type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" class="form-control mb-2">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">User Role</label>
                                        <select name="role" class="form-control" id="">
                                            <option value="0">Please Select the user role</option>
                                            <option value="1">Super Admin</option>
                                            <option value="2">Editor</option>
                                            <option value="3">Subscriber</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="">Account Status</label>
                                        <select name="role" class="form-control" id="">
                                            <option value="0">Please select the account status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div style="margin-top: 12px;" class="custom-file mb-4">
                                        <input name="image" type="file" id="file" class="custom-file-input">
                                        <label class="custom-file-label">User Image</label>
                                    </div>
                                    <div style="text-align: right; margin-top:12px;" class="form-group text-end">
                                        <input style="width: 70%;" type="submit" value="Add User" name="add_user" class="btn btn-teal">
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>

                <?php
                } else if ($do == "store") {
                   if(isset($_POST['add_user'])){
                    echo 'user added';
                   }
                } else if ($do == "edit") {
                    echo "We will edit the user information here / HTML Page";
                } else if ($do == "update") {
                    echo "After get the new data we will update inside the database";
                } else if ($do == "delete") {
                    echo "We will delete the user and all the information of the user from the database";
                } else {
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