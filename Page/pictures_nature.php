<?php
	require("../functions.php");

	require("../Class/Helper.Class.php");
	$Helper = new Helper();
	
	require("../Class/User.class.php");
	$User = new User($mysqli);

?>

<?php require("../header.php"); ?>
<?php
if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"])){
    $target_dir = "Upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to Upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            
            // save file name to DB here
            
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}else{
    echo "<p align=center>Please select the file that you want to upload! </p> ";
}
?>

<!DOCTYPE html>
<html>
<body>
<div class="container-fluid">
<div class="row">
<div align="center">
<form action="../Upload/upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
	<br><br>
	  </div>
</div>
</form>

</body>
</html>

<div class="container-fluid">
<div class="row">
<div align="center">
	<img src="sipelgad.jpg">
  </div>
</div>
<?php require("../footer.php"); ?>