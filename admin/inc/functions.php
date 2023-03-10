<?php

    function uploadImage($post_name){
        
        $name         = $_FILES["$post_name"]['name'];
        $size         = $_FILES["$post_name"]['size'];
        $type         = $_FILES["$post_name"]['type'];

        $image_extension   = strtolower(end(explode('.', $name)));
        $allowe_extension  = array("jpg", "jpeg", "png");

        // move the image into the server temporary folder 
        $image_tmp = $_FILES[$post_name]['tmp_name'];

        if (in_array($image_extension, $allowe_extension) === false) {
            $error = "Your uploaded file is not an image";
        }

        if ($size > 1048574) {
            $error = "Your uploaded file is too large. Max size 1 MB";
        }

        $updatedImg = '';

        if (empty($error)) {
          
            $updatedImg = rand().'-'. date('Y-m-d') . '-' . $name;
          
        }
    

    return array('img'=> $updatedImg, 'tmp'=> $image_tmp, 'err' => $error);
  


    }


// ***************** delete category function 

function deleteCatgory($id, $name, $is_parent, $db){
 
  ?>
<div class="modal fade" id="deleteModal<?php  echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="" method="POST">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
        <?php  
          
          //  print_r($post_ids);;
        ?>
         <h4> 
            Are you sure you want to delete <span class="text-danger"><?php  echo $name; ?></span>
         </h4>
         <?php  
            if($is_parent == 0){
        ?>
            <div class="alert alert-warning"> <p class="text-danger m-0 p-0"> You are about to delete primary category. If you delete primary category it will delete it's subcategory under it. </p> </div>
        <?php 
            }
         ?>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <input type="hidden" name="delete_cat_id" value="<?php echo $id; ?>">
         <input name="delete_cat" class="btn btn-danger" type="submit" value="Confirm delete" >
        
       </div>
     </div>
   </div>
   </form>
 </div>

<?php 

    if(isset($_POST['delete_cat'])){
        $cat_id = $_POST['delete_cat_id'];
       // $dsql = "DELETE FROM `category` WHERE cat_id = '$cat_id'";
          
      
          
            

        // in case you want to delete both category and it's sub category together 
        $dsql = "DELETE FROM category WHERE cat_id = '$cat_id'  OR is_parent = '$cat_id'";
        
       $deleteQuery = mysqli_query($db,$dsql );
    if($deleteQuery){

        $postSql = "SELECT `id` FROM post WHERE category_id = '$id'";
            $postQuery = mysqli_query($db, $postSql);
            $post_ids = [];
            while ($row = mysqli_fetch_assoc( $postQuery)) {
              $postCatId = $row['id'];
            //  var_dump($postCatId);
              array_push($post_ids,$postCatId );
            //  $updateSql = "UPDATE `post` SET `category_id`= '17' WHERE id = '$postCatId'";
            //  $updateQuery = mysqli_query($updateSql);
            }
            $post_ids_string = implode(',', $post_ids);
            $updateSql = "UPDATE `post` SET `category_id`= '17' WHERE id IN ($post_ids_string)";


            header("Location:category.php");
    }
    }

    

}


/******* 
 * add posts
 * 
*/

function addPosts($db, $author_id){
 // echo $author_id;
 $date = date("Y-m-d");

?>
  <div class="">
    <form enctype="multipart/form-data"  action="posts.php?do=store" method="POST">
      <input type="hidden" name="post_author_id" value="<?php echo $author_id; ?>" >
      <input type="hidden" name="post_date" value="<?php echo $date; ?>" >
      <div class="row"> 
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label for="post_title">Post Title</label>
            <input type="text" name="post_title" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="post_descripttion">Description</label>
            <textarea class="form-control" name="post_descripttion" id="postDescription" ></textarea>
          </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="">Category</label>
              <select name="post_category_id" class="form-control">
              <?php  
                $query = "SELECT * FROM category WHERE is_parent = 0 AND status = 1 ORDER BY cat_name ASC";
                $parent_cat = mysqli_query($db, $query);

                while ($row = mysqli_fetch_assoc($parent_cat)) {
                  $parent_cat_id = $row['cat_id'];
                  $parent_cat_name = $row['cat_name'];
                ?>               
                <option value="<?php echo $parent_cat_id;  ?>">
                   <?php echo $parent_cat_name; ?>
                 </option>
              <?php   
              $child_cat_sql = "SELECT * FROM category WHERE is_parent = '$parent_cat_id' AND status = 1 ORDER BY cat_name ASC";
              $child_cat_query = mysqli_query($db,$child_cat_sql);

              while ($row = mysqli_fetch_assoc($child_cat_query) ) {
                $child_cat_id = $row['cat_id'];
                $child_cat_name = $row['cat_name'];
              ?>
               <option value="<?php echo $child_cat_id; ?>">--<?php echo $child_cat_name; ?></option>
             <?php 
              }             
              }

              ?>            
               
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="">Status</label>
              <select name="post_status" id="" class="form-control">
                <option value="1">Publish</option>
                <option value="0">Save as draft</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="">Tags</label>
              <input 
              class="form-control" 
              placeholder="Put comma after each tags" 
              type="text"
              name="post_tags" 
             >
            </div>
            <div class="form-group mb-3">
              <label for="">Post image</label>
              <input name="post_image" type="file" class="form-control">
            </div>
            <div class="form-group text-right">
              <input type="submit" value="Add Post" name="add_post" class="btn btn-primary" />
            </div>
        </div>

      </div>
      
    </form>
  </div>




<?php 
}

/******************************************add post ends */
/******************************************edit post ends */


function editPosts($db, $id, $title, $description, $cat_id, $posted_by, $status, $tags, $image){
 // echo $author_id;
 $date = date("Y-m-d");

?>
  <div class="">
    <form enctype="multipart/form-data"  action="posts.php?do=edit" method="POST">      
     <input type="hidden" value="<?php echo $id; ?>" name="post_id" />
      <div class="row"> 
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label for="post_title">Post Title</label>
            <input value="<?php echo $title; ?>" type="text" name="edit_post_title" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="post_descripttion">Description</label>
            <textarea  class="form-control" name="edit_post_descripttion" id="postDescription" >
              <?php  echo $description; ?>
            </textarea>
          </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="">Change Category</label>
              <?php   echo $cat_id; ?>
              <select name="edit_post_category_id" class="form-control">
              <?php  
                $query = "SELECT * FROM category WHERE is_parent = 0 AND status = 1 ORDER BY cat_name ASC";
                $parent_cat = mysqli_query($db, $query);

                while ($row = mysqli_fetch_assoc($parent_cat)) {
                  $parent_cat_id = $row['cat_id'];
                  $parent_cat_name = $row['cat_name'];
                 
                ?>        
                  <?php  // $cat_id == $parent_cat_id ? echo 'selected':  null; ?>
                <option
               <?php   echo $cat_id == $parent_cat_id ? 'selected' : null; ?>
                 value="<?php echo $parent_cat_id;  ?>">
                   <?php echo $parent_cat_name; ?>
                 </option>
              <?php   
              $child_cat_sql = "SELECT * FROM category WHERE is_parent = '$parent_cat_id' AND status = 1 ORDER BY cat_name ASC";
              $child_cat_query = mysqli_query($db,$child_cat_sql);

              while ($row = mysqli_fetch_assoc($child_cat_query) ) {
                $child_cat_id = $row['cat_id'];
                $child_cat_name = $row['cat_name'];
              ?>
               <option 
                 <?php   echo $cat_id == $child_cat_id ? 'selected' : null; ?>
               value="<?php echo $child_cat_id; ?>">--<?php echo $child_cat_name; ?></option>
             <?php 
              }             
              }

              ?>            
               
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="">Status</label>
              <select name="edit_post_status" id="" class="form-control">
                <option value="1">Publish</option>
                <option value="0">Save as draft</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="">Tags</label>
              <input 
              class="form-control" 
              placeholder="Put comma after each tags" 
              type="text"
              name="edit_post_tags" 
             >
            </div>
            <div class="form-group mb-3">
              <div>
                <!-- old image -->
                <input type="hidden" value="<?php echo $image; ?>" name="old_image_name" />
                  <img
                   style="width:150px;"
                    src="assets/images/posts/<?php echo $image; ?>"
                     alt="<?php echo $title; ?>">
              </div>
              <div>
                  <label for="">Change image</label>
                  <input name="update_post_image" type="file" class="form-control">
              </div>
            
            </div>
            <div class="form-group text-right">
              <input type="submit" value="Update Post" name="edit_post" class="btn btn-primary" />
            </div>
        </div>

      </div>
      
    </form>
  </div>




<?php 
}


function deletePostModal($deltePostId, $title, $iamge){

?>
  <div
    class="modal fade"
    id="deleteModal<?Php echo $deltePostId;  ?>"
    tabindex="-1" 
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-8">
            <h6>
              You are about to delete: <span class="text-danger"><?php  echo $title; ?></span>
            </h6>
          </div>
          <div class="col-4">
            <img class="img-fluid" src="assets/images/posts/<?php echo $image; ?>" alt="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
      
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="posts.php?do=delete&deletePostId=<?php echo $deltePostId; ?>" type="button" class="btn btn-danger" >Confirm Delete</a>
    
      </div>
      </div>
  </div>
  </div>

<?php 

}



?>

<!-- 




 -->