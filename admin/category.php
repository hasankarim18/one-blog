<?php include './inc/header.php'; ?>
<?php  include './inc/functions.php'; ?>



<!-- ########## START: MAIN PANEL ########## -->



<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Manage all category</h4>
        <p class="mg-b-0">Blank page template</p>
    </div>
</div>

<div class="br-pagebody">

    <div class="row row-sm ">
        <div class="col-md-4 col-sm-6 col-12 md-mb-0 sm-mb-0 mb-4">
            <div class="card bd-0 shadow-base p-4">
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">
                    How Engaged Our Users Daily
                </h6>
                <!-- page content start  -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="cat_name" class="form-control required">
                    </div>
                    <!-- Category Is parent or not -->
                    <div class="form-group">
                        <label for="">Please select </label>
                        <select name="is_parent" id="" class="form-control">
                            <option selected value="0">Please select the parent category</option>
                            <!-- Loop start -->
                            <?php
                            $sql = "SELECT * FROM category  WHERE is_parent = 0 AND status = 1 ORDER BY cat_name ASC";
                            $parent_cat = mysqli_query($db, $sql);
                            while ($row = mysqli_fetch_assoc($parent_cat)) {
                                $cat_id    = $row['cat_id'];
                                $cat_name  = $row['cat_name'];
                            ?>
                                <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                            <?php
                            }
                            ?>
                            <!-- Loop end -->
                        </select>
                    </div>
                    <!-- category status select -->
                    <div class="form-group">
                        <label for="">Category Status</label>
                        <select name="cat_status" class="form-control" id="">
                            <option selected value="1">Please Select the Category Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <!-- Category description -->
                    <div class="form-group">
                        <label for="">Description </label>
                        <!-- ck editor it link in footer -->
                        <textarea id="description" name="cat_description" class="form-control" id="" cols="30" rows="5"></textarea>
                    </div>
                    <!-- category image -->
                    <div class="form-group">
                        <label for="">Category image</label>
                        <input name="cat_img" type="file" class="form-control">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input name="add_cat" type="submit" value="Add Category" class="btn btn-info">
                    </div>
                </form>
                <?php
                if (isset($_POST['add_cat'])) {
                    $cat_name           = mysqli_real_escape_string($db, $_POST['cat_name']);
                    $is_parent          = mysqli_real_escape_string($db, $_POST['is_parent']);
                    $cat_status         = mysqli_real_escape_string($db, $_POST['cat_status']);
                    $cat_description     = mysqli_real_escape_string($db, $_POST['cat_description']);
                    //  $cat_img_name  = $_FILES['cat_img']['name'];

                    $sql = "INSERT INTO `category`(`cat_name`, `cat_description`, `is_parent`, `status`) VALUES ('$cat_name','$cat_description','$is_parent','$cat_status')";

                    $cat_add = mysqli_query($db, $sql);

                    if ($cat_add) {
                        header("Location:category.php");
                    } else {
                        die("Mysqli Error" . mysqli_error($db));
                    }
                }
                ?>

                <!-- page content end -->
            </div><!-- d-flex -->
        </div>
        <div class="col-md-8 col-sm-6 col-12">
            <div class="card bd-0 shadow-base p-4">
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">
                    All category
                </h6>
                <!-- page content start  -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Si</th>
                            <!-- <th scope="col">Image</th> -->
                            <th scope="col">Category Name</th>
                            <th scope="col">Parent / Child</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM category WHERE is_parent = 0 ORDER BY cat_name ASC";
                        // $sql = "SELECT * FROM category ORDER BY cat_name ASC";
                        $cat_query = mysqli_query($db, $sql);
                        $i = 0;

                        // SELECT `cat_id`, `cat_name`, `cat_description`, `is_parent`, `status`, `image` FROM `category` WHERE 1

                        while ($row = mysqli_fetch_assoc($cat_query)) {
                            $cat_id = $row['cat_id'];
                            $name = $row['cat_name'];
                            $is_parent = $row['is_parent'];
                            $status    = $row['status'];
                            $description = $row['cat_description'];
                            $i++;
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <!-- <td><img src="" alt="<?php // echo $name; 
                                                            ?>"></td> -->
                                <td><?php echo $name; ?></td>
                                <td>
                                    <?php
                                    if ($is_parent == '0') {
                                    ?>
                                        <span class="badge badge-primary p-1 display-4" style="font-size:18px;" ;>
                                            Primary
                                        </span>
                                    <?php
                                    } else if ($is_parent == '1') {
                                    ?>
                                        <span class="badge badge-warning p-1 display-4" style="font-size:18px;" ;>
                                            secondary
                                        </span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($status == '1') {
                                    ?>
                                        <span class="badge badge-success p-1 display-4" style="font-size:18px;">
                                            Active
                                        </span>
                                    <?php
                                    } else if ($status == '0') {
                                    ?>
                                        <span class="badge badge-danger p-1 display-4" style="font-size:18px;">
                                            Inactive
                                        </span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="table_action">
                                        <ul class="ul admin_user_action" type="none">
                                            <!-- view parent category -->
                                            <li>
                                                <a href="#">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            </li>
                                            <!-- edit parent category -->
                                            <!-- #editModalTrigger parent -->
                                            <li>
                                                <a href="" data-toggle="modal" data-target="#editCategory<?php echo $cat_id; ?>">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </li>
                                            <!-- delete parent category -->
                                            <li>
                                                <a href="" data-toggle="modal"
                                                 data-target="#deleteModal<?php echo $cat_id; ?>">
                                                 <?php  echo $cat_id; ?>
                                                 <i class="fa-solid fa-trash-can"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                  <?php  
                                 deleteCatgory($cat_id, $name, $is_parent,$db);
                                     ?>
                                <!-- edit #modal for paretn category edit -->
                                <div class="modal fade" id="editCategory<?php echo $cat_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Udpdate Category <?php echo $cat_id; ?>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="">Category Name</label>
                                                        <input value="<?php echo $name; ?>" type="text" name="cat_name" class="form-control required text-capitalize">
                                                    </div>
                                                    <!-- Category Is parent or not -->
                                                    <div class="form-group">
                                                        <label for="">Please select </label>
                                                        <select name="is_parent" id="" class="form-control">
                                                            <!-- <option value="<?php echo $cat_id; ?>">
                                                                Please select the parent category</option> -->
                                                            <!-- Loop start -->
                                                           <?php  
                                                            $query = "SELECT * FROM category WHERE is_parent = 0";
                                                            $pcat = mysqli_query($db, $query);
                                                            while($row = mysqli_fetch_assoc($pcat)){
                                                                $pid = $row['cat_id'];
                                                                $pname = $row['cat_name'];
                                                            ?>
                                                        
                                                    
                                                        <option value="0" > 
                                                            <?php echo $pname; ?>
                                                        </option>
                                                            <?php
                                                            $query2 = "SELECT * FROM category WHERE is_parent = '$pid'" ;
                                                            $chcat = mysqli_query($db, $query2);
                                                           while ($row = mysqli_fetch_assoc($chcat)) {
                                                            $chid = $row['cat_id'];
                                                            $chname = $row['cat_name'];
                                                            ?>
                                                            <option value="<?php echo $chid; ?>" > 
                                                           -- <?php echo $chname; ?>
                                                        </option>
                                                            <?php 
                                                           }
                                                            }
                                                           ?>
                                                            <!-- Loop end -->
                                                        </select>
                                                    </div>
                                                    <!-- category status select -->
                                                    <div class="form-group">
                                                        <label for="">Category Status</label>
                                                        <select name="cat_status" class="form-control" id="">
                                                            <option <?php if ($status == 1) echo 'selected' ?> value="1">Active</option>
                                                            <option <?php if ($status == 0) echo 'selected' ?> value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                    <!-- Category description -->
                                                    <div class="form-group">
                                                        <label for="">Description </label>
                                                        <!-- ck editor it link in footer -->
                                                        <textarea id="updateDescription" name="cat_description" class="form-control" id="" cols="30" rows="5">
                                                    <?php
                                                    echo $description;
                                                    ?>
                                                </textarea>
                                                    </div>
                                                    <!-- category image -->
                                                    <div class="form-group">
                                                        <label for="">Category image</label>
                                                        <input name="cat_img" type="file" class="form-control">
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <input name="add_cat" type="submit" value="Update Category" class="btn btn-info">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #modal end -->
                               
                          
                                <!-- delete modal start for parent -->
                                


                            </tr>
                            <?php

                            $sql2 = "SELECT * FROM category WHERE is_parent = '$cat_id' ORDER BY cat_name ASC";
                            // echo $sql2; echo "<br/>";
                            $allChildCat = mysqli_query($db, $sql2);

                            while ($row = mysqli_fetch_assoc($allChildCat)) {
                                $cat_id = $row['cat_id'];
                                $name = $row['cat_name'];
                                $is_parent = $row['is_parent'];
                                $status    = $row['status'];
                                $description = $row['cat_description'];

                                $i++;
                            ?>
                                <tr>
                                    <th scope="row"><?php echo  $i; ?></th>
                                    <!-- <td><img src="" alt="<?php // echo $name; 
                                                                ?>"></td> -->
                                    <td>-- <?php echo $name; ?></td>
                                    <td>
                                        <?php
                                        if ($is_parent != '0') {
                                        ?>
                                            <span class="badge badge-info p-1 display-4" style="font-size:18px;">
                                                Subcategory
                                            </span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($status == '1') {
                                        ?>
                                            <span class="badge badge-success p-1 display-4" style="font-size:18px;">
                                                Active
                                            </span>
                                        <?php
                                        } else if ($status == '0') {
                                        ?>
                                            <span class="badge badge-danger p-1 display-4" style="font-size:18px;">
                                                Inactive
                                            </span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="table_action">
                                            <ul class="ul admin_user_action" type="none">
                                                <!-- edit category -->
                                                <li>
                                                    <a href="#">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                </li>
                                                <!-- #editModalTrigger child -->
                                                <li>
                                                    <a href="" data-toggle="modal" data-target="#editCategory<?php echo $cat_id; ?>">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                </li>
                                                <!-- delete category -->
                                               <li>
                                                <a href="" data-toggle="modal"
                                                 data-target="#deleteModal<?php echo $cat_id; ?>">
                                                 <?php  echo $cat_id; ?>
                                                 <i class="fa-solid fa-trash-can"></i></a>
                                            </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <?php   deleteCatgory($cat_id, $name, $is_parent, $db); ?>
                                    <!-- #modalChild -->
                                    <div class="modal fade" id="editCategory<?php echo $cat_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Udpdate Category <?php echo $cat_id; ?>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="">Category Name</label>
                                                            <input value="<?php echo $name; ?>" type="text" name="cat_name" class="form-control required text-capitalize">
                                                        </div>
                                                        <!-- Category Is parent or not -->
                                                        <div class="form-group">
                                                            <label for="">Please select </label>
                                                            <select name="is_parent" id="" class="form-control">
                                                                <option value="<?php echo $cat_id; ?>">
                                                                    Please select the parent category</option>
                                                                <!-- Loop start -->
                                                                <?php
                                                                $sql = "SELECT * FROM category  WHERE is_parent = 0 AND status = 1 ORDER BY cat_name ASC";
                                                                $parent_cat = mysqli_query($db, $sql);
                                                                while ($row = mysqli_fetch_assoc($parent_cat)) {
                                                                    $cat_id    = $row['cat_id'];
                                                                    $cat_name  = $row['cat_name'];
                                                                ?>
                                                                    <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                                <!-- Loop end -->
                                                            </select>
                                                        </div>
                                                        <!-- category status select -->
                                                        <div class="form-group">
                                                            <label for="">Category Status</label>
                                                            <select name="cat_status" class="form-control" id="">
                                                                <option <?php if ($status == 1) echo 'selected' ?> value="1">Active</option>
                                                                <option <?php if ($status == 0) echo 'selected' ?> value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                        <!-- Category description -->
                                                        <div class="form-group">
                                                            <label for="">Description </label>
                                                            <!-- ck editor it link in footer -->
                                                            <textarea id="updateDescription2" name="cat_description" class="form-control" id="" cols="30" rows="5">
                                                    <?php
                                                    echo $description;
                                                    ?>
                                                </textarea>
                                                        </div>
                                                        <!-- category image -->
                                                        <div class="form-group">
                                                            <label for="">Category image</label>
                                                            <input name="cat_img" type="file" class="form-control">
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <input name="add_cat" type="submit" value="Update Category" class="btn btn-info">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- #modalChild end -->
                                    
                                    <!--  delete modal for subcategory -->
                               

                                </tr>

                        <?php
                            }
                        }

                        // end of while           


                        ?>


                    </tbody>
                </table>
                <!-- page content end -->
            </div><!-- d-flex -->
        </div>
    </div>
</div>

</div>

<!-- category parent edit modal -->



<!-- br-pagebody -->



<?php include './inc/footer.php'; ?>