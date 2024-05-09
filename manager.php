<?php

include("manNav.php");
include("db.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <title></title>
</head>

<body style="margin-top: 50px;">

<div class="row about">
    <div class="col-lg-4 col-md-4 col-sm-12 ">
        <form method="post" action="" enctype='multipart/form-data' class='form-group' style="left: 15%;top:40%;width: 1wh;" >
        <h4> Новая запись</h4>
            <label> Название категории:</label>
            <input type="text" name="inputCategoryName" placeholder="Название категории" class="form-control">
            <input type="text" name="inputCategoryTitle" placeholder="Название категории на сайте" class="form-control">
            <input type="text" name="inputCategoryDescription" placeholder="Описание категории на сайте" class="form-control">
            <input type='file' name='photo' placeholder='Фотография категории на сайте' class='form-control' value=''><br>
            <button type="submit" name='submit1' class='btn btn-primary' style='background-color: black; color: white;'>Добавить</button>
        </form>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 desc"> 
    

<?php
    $sql="SELECT * FROM Categories";
    $result = mysqli_query($db, $sql);
    echo"<h4> Категории</h4>";

    echo"<table class='table table-bordered table-sm';>
    <tr class='table-primary'><th>Номер</th><th>Название</th><th>Название на сайте</th><th>Описание</th><th>Фото</th><th></th><th></th>";

    while($myrow=mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<form method='post' action='' enctype='multipart/form-data' class='form-group' style='left: 15%;top:40%;width: 1wh;' >";
        echo "<td>";
        echo "<input type='text' name='ID_Category' placeholder='Номер категории' value='$myrow[ID_Category]' class='form-control'> ";
        echo "</td>";
        echo "<td>";
        echo "<input type='text' name='inputNewName' placeholder='Название категории' value='$myrow[Name_of_Category]' class='form-control'> ";
        echo "</td>";
        echo "<td>";
        echo "<input type='text' name='inputNewTitle' placeholder='Название на сайте' value='$myrow[Title]' class='form-control'> ";
        echo "</td>";
        echo "<td>";
        echo "<input type='text' name='inputNewDesc' placeholder='Описание на сайте' value='$myrow[Description]' class='form-control'> ";
        echo "</td>";
        echo "<td>";
        
        echo "<input type='file' name='inputNewPhoto' placeholder='Новое фото на сайте' value='' class='form-control'> ";
        echo "<img src='$myrow[Photo_path]' alt='$myrow[Photo_name]' width='20%'>";
        echo "</td>";

        echo "<td> 
        <button type='submit' name='submit' class='btn btn-primary' style='background-color: black; color: white;' formaction='submitUpd.php'>Изменить</button>
        </td>";
        echo "</form>";
        echo "$inputNewName=$_POST[inputNewName]";
        echo "$ID_Category=$_POST[ID_Category]";
        echo "$inputNewTitle=$_POST[inputNewTitle]";
        echo "$inputNewDesc=$_POST[inputNewDesc]";        

        echo"<input type='hidden' name='ID_Category' value='$ID_Category'></form>";
        echo"<input type='hidden' name='inputNewName' value='$inputNewName'></form>";
        echo"<input type='hidden' name='inputNewTitle' value='$inputNewTitle'></form>";
        echo"<input type='hidden' name='inputNewDesc' value='$inputNewDesc'></form>";
        echo"<input type='hidden' name='inputNewPhotoName' value='$inputNewPhoto'></form>";
        echo"</tr>";
    }

    echo "</table>";
    ?>

    <?php
if(isset($_POST['submit1']))
{
    $photo_name = $_FILES['photo']['name'];
    $photo_tmp_name = $_FILES['photo']['tmp_name'];
    $target_dir = "img/uploaded/";
    $target_file = $target_dir . basename($photo_name);
    move_uploaded_file($photo_tmp_name, $target_file);

    // Retrieve other form data
    $descriptionCat = mysqli_real_escape_string($db, $_POST['inputCategoryDescription']);
    $titleCat = mysqli_real_escape_string($db, $_POST['inputCategoryTitle']);
    $nameCat = mysqli_real_escape_string($db, $_POST['inputCategoryName']);

    if($nameCat!=null)
    {$sql="INSERT INTO Categories(Name_of_Category, Title, Description, Photo_name, Photo_path)
        VALUES ('$nameCat', '$titleCat', '$descriptionCat', '$photo_name', '$target_file')";
        $result=mysqli_query($db, $sql);
    
        if($result==TRUE)
        {
            echo "Данные успешно сохранены!";
            echo "<script> document.location.href = 'manager.php'</script>";
        }
        else{
            echo "Ошибка";
        }
    }
    
    
}

if(isset($_POST['showPhoto']))
{
    $photo_name = $_FILES['photo']['name'];
    $photo_tmp_name = $_FILES['photo']['tmp_name'];
    $target_dir = "img/uploaded/";
    $target_file = $target_dir . basename($photo_name);
    move_uploaded_file($photo_tmp_name, $target_file);

    // Retrieve other form data
    $descriptionCat = mysqli_real_escape_string($db, $_POST['inputCategoryDescription']);
    $titleCat = mysqli_real_escape_string($db, $_POST['inputCategoryTitle']);
    $nameCat = mysqli_real_escape_string($db, $_POST['inputCategoryName']);

    if($nameCat!=null)
    {$sql="INSERT INTO Categories(Name_of_Category, Title, Description, Photo_name, Photo_path)
        VALUES ('$nameCat', '$titleCat', '$descriptionCat', '$photo_name', '$target_file')";
        $result=mysqli_query($db, $sql);
    
        if($result==TRUE)
        {
            echo "Данные успешно сохранены!";
            echo "<script> document.location.href = 'manager.php'</script>";
        }
        else{
            echo "Ошибка";
        }
    }
    
    
}

?>
</div>
</div>
</body>
</html>
