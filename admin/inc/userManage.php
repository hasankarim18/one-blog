  <div class="manage_users">
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
                                $imageLink = "assets/images/";

                                if ($row['image'] == '') {
                                    $image = "$imageLink/blank.png";
                                } else if ($row['image'] != '') {
                                    $userIamgeName = $row['image'];
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
                                                  <a href="users.php?do=edit&id=<?php echo $id; ?>"> <i class="fa-regular fa-pen-to-square"></i> </a>
                                              </li>
                                              <!-- delete user -->
                                              <li>
                                                  <a href="" data-toggle="modal" data-target="#deleteModal<?php echo $id; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                              </li>
                                          </ul>
                                      </div>
                                  </td>

                                  <div class="modal fade" id="deleteModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <ul type="none" class="d-flex" style="gap: 50px;">
                                                      <li>
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                      </li>
                                                      <li>
                                                          <a href="users.php?do=delete&deltedUserId=<?Php echo $id; ?>&image=<?php echo $userIamgeName; ?>" class="btn btn-primary">Are you sure!</a>
                                                      </li>
                                                  </ul>
                                              </div>
                                              <div class="modal-footer">
                                              </div>
                                          </div>
                                      </div>
                                  </div>


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
            // user check for CRUD
        } else if ($do == "add") {
            if (isset($error)) {
                foreach ($error as $err) {
                    echo $error;
                }
            }
        ?>
          <!-- add new user -->
          <div class="col-12 ">
              <form class="needs-validation" novalidate action="users.php?do=store" method="POST" enctype="multipart/form-data">
                  <div class="row">
                      <div class="col-12 col-md-4">
                          <div class="form-group mb-2">
                              <label for="">Full Name</label>
                              <input placeholder="User name" type="text" name="name" class="form-control">
                              <div class="invalid-feedback">
                                  Name can't be empty!
                              </div>
                          </div>
                          <div class="form-group mb-2">
                              <label for="">Email</label>
                              <input type="email" name="email" class="form-control" required>
                              <div class="invalid-feedback">
                                  Email can't be empty!
                              </div>
                          </div>
                          <div class="form-group mb-2">
                              <label for="">Password</label>
                              <input type="password" name="password" class="form-control" required>
                              <div class="invalid-feedback">
                                  Password can't be empty!
                              </div>
                          </div>
                          <div class="form-group mb-2">
                              <label for="">Confirm Password</label>
                              <input type="password" name="confirm_password" class="form-control" required>
                              <div class="invalid-feedback">
                                  Confirm password can't be empty!
                              </div>
                          </div>
                          <div class="form-group mb-2">
                              <label for="">Address</label>
                              <input type="text" name="address" class="form-control">
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
                              <select name="status" class="form-control" id="">
                                  <option value="0">Please select the account status</option>
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                              </select>
                          </div>
                          <div style="margin-top: 12px;" class=" mb-4">
                              <input name="image" type="file" id="file" class="">

                          </div>
                          <div style="text-align: right; margin-top:12px;" class="form-group text-end">
                              <input style="width: 70%;" type="submit" value="Add User" name="add_user" class="btn btn-teal">
                          </div>
                      </div>
                  </div>
              </form>
          </div>

          <?php
            // sotre in the database
        } else if ($do == "store") {
            if (isset($_POST['add_user'])) {
                $name              = mysqli_real_escape_string($db, $_POST['name']);
                $email             = mysqli_real_escape_string($db, $_POST['email']);
                $password          = mysqli_real_escape_string($db, $_POST['password']);
                $confirmPassword   = mysqli_real_escape_string($db, $_POST['confirm_password']);
                $address           = mysqli_real_escape_string($db, $_POST['address']);
                $phone             = mysqli_real_escape_string($db, $_POST['phone']);
                $role              = mysqli_real_escape_string($db, $_POST['role']);
                $status            = mysqli_real_escape_string($db, $_POST['status']);


                $imageName         = $_FILES['image']['name'];
                // check there is image or not
                if ($imageName) {

                    $imageSize         = $_FILES['image']['size'];
                    $imageType         = $_FILES['image']['type'];

                    $image_extension   = strtolower(end(explode('.', $imageName)));
                    $allowe_extension  = array("jpg", "jpeg", "png");

                    // move the image into the server temporary folder 
                    $image_tmp = $_FILES['image']['tmp_name'];

                    if (in_array($image_extension, $allowe_extension) === false) {
                        $error[] = "Your uploaded file is not an image";
                    }

                    if ($imageSize > 1048574) {
                        $error[] = "Your uploaded file is too large. Max size 1 MB";
                    }


                    if (!empty($error)) {
                        foreach ($error as $err) {
                            echo '<div class="alert alert-danger"> ' . $err . '</div>';
                        }
                    } else {
                        $img =  date('Y-m-d') . '-' . $imageName;
                        move_uploaded_file($image_tmp, "assets/images/" . $img);
                    }
                }



                if ($password == $confirmPassword) {
                    $hassedPass = sha1($password);
                    $sql = "INSERT INTO `users`( `name`, `email`, `password`, `phone`, `address`, `role`, `status`, `join_date`,`image`) VALUES ('$name','$email','$hassedPass','$phone','$address','$role','$status',now(), '$img')";
                    // adduser                  
                    $addUser = mysqli_query($db, $sql);
                    // check user if added
                    if ($addUser) {
                        header("Location: users.php?do=manage");
                    };
                } else {
                    echo  "password doesn't match";
                }
            }
        } else if ($do == "edit") {
            if (isset($_GET['id'])) {
                $editId = $_GET['id'];
                $sql = "SELECT * FROM users WHERE id = $editId";
                $user = mysqli_query($db, $sql);

                while ($row = mysqli_fetch_assoc($user)) {
                    $id        =  $row['id'];
                    $name      =  $row['name'];
                    $email     =  $row['email'];
                    $phone     = $row['phone'];
                    $address   =  $row['address'];
                    $role      =  $row['role'];
                    $status    = $row['status'];
                    $join_date =  $row['join_date'];
                    $image     = $row['image'];

            ?>
                  <!-- edit form -->
                  <form class="needs-validation" novalidate action="users.php?do=update" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="eidtUserId" value="<?php echo $editId;  ?>">
                      <div class="row">
                          <div class="col-12 col-md-4">
                              <div class="form-group mb-2">
                                  <label for="">Full Name</label>
                                  <input value="<?php echo $name; ?>" placeholder="User name" type="text" name="name" class="form-control">
                                  <div class="invalid-feedback">
                                      Name can't be empty!
                                  </div>
                              </div>
                              <div class="form-group mb-2">
                                  <label for="">Email</label>
                                  <input value="<?php echo $email; ?>" type="email" name="email" class="form-control">
                                  <div class="invalid-feedback">
                                      Email can't be empty!
                                  </div>
                              </div>
                              <div class="form-group mb-2">
                                  <label for="">Password</label>
                                  <input placeholder="********" type="password" name="password" class="form-control">
                                  <div class="invalid-feedback">
                                      Password can't be empty!
                                  </div>
                              </div>
                              <div class="form-group mb-2">
                                  <label for="">Confirm Password</label>
                                  <input placeholder="********" type="password" name="confirm_password" class="form-control">
                                  <div class="invalid-feedback">
                                      Confirm password can't be empty!
                                  </div>
                              </div>
                              <div class="form-group mb-2">
                                  <label for="">Address</label>
                                  <input value="<?php echo $address; ?>" type="text" name="address" class="form-control">
                              </div>
                          </div>
                          <div class="col-12 col-md-4">
                              <div class="form-group mb-2">
                                  <label for="">Phone</label>
                                  <input value="<?php echo $phone; ?>" type="text" name="phone" class="form-control mb-2">
                              </div>
                              <div class="form-group mb-2">
                                  <label for="">User Role</label>
                                  <select name="role" class="form-control" id="">
                                      <option value="0">Please Select the user role</option>
                                      <option <?php if ($role == 1) {
                                                    echo "selected";
                                                } ?> value="1">Super Admin</option>
                                      <option <?php if ($role == 2) {
                                                    echo "selected";
                                                } ?> value="2">Editor</option>
                                      <option <?php if ($role == 3) {
                                                    echo "selected";
                                                } ?> value="3">Subscriber</option>
                                  </select>
                              </div>
                              <div class="form-group mb-4">
                                  <label for="">Account Status</label>
                                  <select name="status" class="form-control" id="">
                                      <option value="0">Please select the account status</option>
                                      <option <?php if ($status == 1) {
                                                    echo "selected";
                                                } ?> value="1">Active</option>
                                      <option <?php if ($status == 0) {
                                                    echo "selected";
                                                } ?> value="0">Inactive</option>
                                  </select>
                              </div>
                              <!-- show image -->
                              <?php
                                if (!empty($image)) {
                                ?>
                                  <!-- user image -->
                                  <div class="form-group">
                                      <img style="width: 150px;" src="<?php echo "assets/images/$image"; ?>" alt="">
                                  </div>
                                  <input name="old_image" type="hidden" value="<?php echo $image; ?>">
                              <?php
                                }
                                ?>
                              <div style="margin-top: 12px;" class=" mb-4">
                                  <input name="image" type="file" id="file" class="files">
                                  <!-- <label class="custom-file-label">Update Image</label> -->
                              </div>
                              <div style="text-align: right; margin-top:12px;" class="form-group text-end">
                                  <input style="width: 70%;" type="submit" value="Save Changes" name="update_user" class="btn btn-teal">
                              </div>
                          </div>
                      </div>
                  </form>
      <?php  }
            } // if(isset($_GET['id'])) end here                   
            // Edit 
        } else if ($do == "update") {
            /** All update login will go here */
            if (isset($_POST['update_user'])) {
                $editId            = mysqli_real_escape_string($db, $_POST['eidtUserId']);
                $name              = mysqli_real_escape_string($db, $_POST['name']);
                $email             = mysqli_real_escape_string($db, $_POST['email']);
                $password          = mysqli_real_escape_string($db, $_POST['password']);
                $confirmPassword   = mysqli_real_escape_string($db, $_POST['confirm_password']);
                $address           = mysqli_real_escape_string($db, $_POST['address']);
                $phone             = mysqli_real_escape_string($db, $_POST['phone']);
                $role              = mysqli_real_escape_string($db, $_POST['role']);
                $status            = mysqli_real_escape_string($db, $_POST['status']);
                $image             = $_FILES['image'];
                $oldImage          = $_POST['old_image'];
                //   echo $image;

                $imageName         = $_FILES['image']['name'];


                if (!empty($password) && !empty($imageName)) {
                    // condition one -- both password and image change with other contet
                    // Encript the password 
                    if ($password == $confirmPassword) {
                        $hassedPass = sha1($password);
                        if (!empty($imageName)) {

                            $updatedName = $_FILES['image']['name'];
                            $updatedSize = $_FILES['image']['size'];
                            $updatedType = $_FILES['image']['type'];

                            $imgFunc = uploadImage($updatedName, $updatedSize, $updatedType);

                            // delete old image 



                            $updatedImg = $imgFunc['img'];
                            $image_tmp  = $imgFunc['tmp'];

                            // echo $updatedImg;
                        }

                        $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`password`='$password',`phone`='$phone',`address`='$address',`role`='$role',`status`='$status',`image`='$updatedImg' WHERE id = '$editId'";

                        $update = mysqli_query($db, $sql);

                        if ($update) {
                            move_uploaded_file($image_tmp, "assets/images/" . $updatedImg);
                            unlink("assets/images/" . $oldImage);
                            header("Location:users.php");
                            echo "condition one";
                        } else {
                            echo "something went wrong";
                        }
                    }
                    // 
                } else if (!empty($password) && empty($imageName)) {
                    // conditin two -- only password change  not image with other content
                    if ($password == $confirmPassword) {

                        $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`password`='$password',`phone`='$phone',`address`='$address',`role`='$role',`status`='$status' WHERE id = '$editId'";

                        $update = mysqli_query($db, $sql);

                        if ($update) {
                            header("Location:users.php");
                        } else {
                            echo "something went wrong";
                        }
                    }
                } else if (empty($password) && !empty($imageName)) {
                    // condition three -- only image change not password with other content 
                    $updatedName = $_FILES['image']['name'];
                    $updatedSize = $_FILES['image']['size'];
                    $updatedType = $_FILES['image']['type'];

                    $imgFunc = uploadImage($updatedName, $updatedSize, $updatedType);

                    $updatedImg = $imgFunc['img'];
                    $image_tmp  = $imgFunc['tmp'];
                    // echo $updatedImg;                                

                    $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone',`address`='$address',`role`='$role',`status`='$status',`image`='$updatedImg' WHERE id = '$editId'";

                    $update = mysqli_query($db, $sql);

                    if ($update) {
                        move_uploaded_file($image_tmp, "assets/images/" . $updatedImg);
                        unlink("assets/images/" . $oldImage);
                        header("Location:users.php");
                        echo "condition 3";
                    } else {
                        echo "something went wrong";
                    }
                } else if (empty($password) && empty($imageName)) {
                    // password and image is not changed only content changed
                    $sql = "UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone',`address`='$address',`role`='$role',`status`='$status' WHERE id = '$editId'";

                    $update = mysqli_query($db, $sql);

                    if ($update) {
                        header("Location:users.php");
                    } else {
                        echo "something went wrong";
                    }
                }
            }
        } else if ($do == "delete") {
            if (isset($_GET['deltedUserId'])) {
                $deleteId = $_GET['deltedUserId'];
                $deleteImage = $_GET['image'];

                $deleteSql = "DELETE FROM `users` WHERE id = $deleteId";

                $deleteQuery = mysqli_query($db, $deleteSql);

                $deleteQuery = mysqli_query($db, $deleteSql);
                if ($deleteQuery) {
                    unlink("assets/images/" . $deleteImage);
                    header('Location:users.php');
                } else {
                    die("Mysqli error");
                }
            }
        } else {
            echo '<div class="alert alert-danger"> Sorry!!! Operation failed.  </div>';
        }
        ?>
      <!-- page content end -->
  </div>