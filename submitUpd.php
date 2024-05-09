<?php

session_start();

include("manNav.php");
include("db.php");

$ID_Category = mysqli_real_escape_string($db, $_POST["ID_Category"]);
$nameCategory = mysqli_real_escape_string($db, $_POST["inputNewName"]);
$inputNewTitle = mysqli_real_escape_string($db, $_POST["inputNewTitle"]);
$inputNewDesc = mysqli_real_escape_string($db, $_POST["inputNewDesc"]);
$inputNewPhoto = $_POST["inputNewPhoto"];
        $photo_name = $_FILES['inputNewPhoto']['name'];
        $photo_tmp_name = $_FILES['inputNewPhoto']['tmp_name'];
        $target_dir = "img/uploaded/";
        $target_file = $target_dir . basename($photo_name);
        move_uploaded_file($photo_tmp_name, $target_file);


echo("<script>console.log(' '$ID_Category' " . $data . "');</script>");
echo("<script>console.log(' '$nameCategory' " . $data . "');</script>");
echo("<script>console.log(' '$inputNewTitle' " . $data . "');</script>");
echo("<script>console.log(' '$inputNewDesc' " . $data . "');</script>");
echo("<script>console.log(' '$photo_name' " . $data . "');</script>");
echo("<script>console.log(' '$target_file' " . $data . "');</script>");
    $query = "UPDATE Categories SET Name_of_Category = '$nameCategory', Title = '$inputNewTitle', Description = '$inputNewDesc', 
    Photo_name = '$photo_name', Photo_path = '$target_file' WHERE ID_Category = '$ID_Category'";

$result=mysqli_query($db,$query);

        if($result==TRUE)
        {
            echo"Добавлено";
            echo "<script> document.location.href = 'manager.php'</script>";
            
        }
        else
        {
            echo "Ошибка!";
        }
?>