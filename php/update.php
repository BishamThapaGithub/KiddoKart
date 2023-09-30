<?php

include_once('connection.php');
$id = $_GET['edit'];

if (isset($_POST['update_product'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_img']['name'];
   $product_image_tmp_name = $_FILES['product_img']['tmp_name'];
   $product_image_folder = 'upload_image/' . $product_image;
   $Description = $_POST['description'];

   if (empty($product_name) || empty($product_price) || empty($product_image)||empty($Description)) {
      $message[] = 'please fill out all!';
   } else {

      $update_data = "UPDATE products SET product_name='$product_name', product_price='$product_price', product_img='$product_image', descriptions = '$Description' WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if ($upload) {
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         echo "<script> alert('Product Has Been Updated'); </script>";
         $_SESSION['success_message'] = "Product Updated Successfully";
         echo '<script>setTimeout(function(){ window.location.href = "addproduct.php"; }, 2000);</script>';
      } else {
         $message[] = 'please fill out all!';
      }

   }
}
;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./product.css">
   <style>
   /* Style for the success message */
   .success-message {
      color: #ffffff; 
      background-color: #4caf50; 
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 20px;
      text-align: center;
   }

   /* Style for the error message */
   .error-message {
      color: #ffffff; 
      background-color: #f44336; 
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 20px;
      text-align: center;
   }
</style>
</head>

<body>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '<span class="message">' . $message . '</span>';
      }
   }
   ?>

   <div class="container">
   <?php
               if (isset($_SESSION['success_message'])) {
                  echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
                  // Clear the success message after displaying it
                  unset($_SESSION['success_message']);
               }
               ?>

      <div class="admin-product-form-container centered">

         <?php

         $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
         while ($row = mysqli_fetch_assoc($select)) {

            ?>

            <form action="" method="post" enctype="multipart/form-data">
               <h3 class="title">update the product</h3>
               Product Name:
               <input type="text" class="box" name="product_name" value="<?php echo $row['product_name']; ?>"
                  placeholder="enter the product name">
               Product Price:
               <input type="number" min="0" class="box" name="product_price" value="<?php echo $row['product_price']; ?>"
                  placeholder="enter the product price">
               Product image:
               <input type="file" class="box" name="product_img" accept="image/png, image/jpeg, image/jpg">
               Description
               <input type="text" name="description" class="box">
               <br>

               <input type="submit" value="update product" name="update_product" class="btn">
               <a href="addproduct.php" class="btn" style="width: fit-content; margin-top:10px;">go back!</a>
            </form>



         <?php }
         ; ?>



      </div>

   </div>

</body>

</html>