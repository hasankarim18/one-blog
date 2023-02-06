<?php

    function uploadImage($name, $size, $type, ){
        
        $size         = $_FILES["$type"]['size'];
        $type         = $_FILES["$type"]['type'];

        $image_extension   = strtolower(end(explode('.', $name)));
        $allowe_extension  = array("jpg", "jpeg", "png");

        // move the image into the server temporary folder 
        $image_tmp = $_FILES['image']['tmp_name'];

        if (in_array($image_extension, $allowe_extension) === false) {
            $error[] = "Your uploaded file is not an image";
        }

        if ($size > 1048574) {
            $error[] = "Your uploaded file is too large. Max size 1 MB";
        }

        if (!empty($error)) {
            foreach ($error as $err) {
                $updatedImg =  '<div class="alert alert-danger"> ' . $err . '</div>';
            }
        } else {
            $updatedImg = rand().'-'. date('Y-m-d') . '-' . $name;
          
        }
    

    return array('img'=> $updatedImg, 'tmp'=> $image_tmp);
  


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
      header("Location:category.php");
    }
    }

    

}



//   


?>

<!-- 




 -->