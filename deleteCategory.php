<?php

session_start();

include("manNav.php");
include("db.php");

$ID_Category = mysqli_real_escape_string($db, $_POST["ID_Category"]);

    $query = " DELETE FROM Categories WHERE Categories.ID_Category = $ID_Category";

$result=mysqli_query($db,$query);

        if($result==TRUE)
        {
            echo"Удалено";
            echo "<script> document.location.href = 'manager.php'</script>";
            
        }
        else
        {
            echo "Ошибка!";
        }
?>