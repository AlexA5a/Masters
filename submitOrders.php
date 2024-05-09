<?php
    include("clientNav.php");
    include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <title>Личный кабинет пользователя</title>
    </head>
    <body style="margin-top: 50px;">
    <div class="col-lg-8 col-md-8 col-sm-12 desc"> 
        <div class="row about">
            
<?php
$idUser_new = $idUser;

$idCategory=$_POST['idCategory'];
$sql="SELECT Name_of_Category FROM Categories where ID_Category = $idCategory";


$result1 = mysqli_query($db, $sql); // Execute the query

if ($result1) {
    // Fetch data from the result set
    $myrow = mysqli_fetch_array($result1);

    if ($myrow) {
        // Data fetching succeeded, continue processing
        $nameCategory = $myrow["Name_of_Category"];
        // Rest of your code here...
    } else {
        // No rows returned from the query
        echo "No rows found!";
    }
} else {
    // Query execution failed
    echo "Query failed: " . mysqli_error($db);
}


echo "

<div class='row about'>
</div>
<div class='col-lg-8 col-md-8 col-sm-12 desc'>
<div class='col-lg-8 col-md-8 col-sm-12 desc'> 
<div class='col-lg-8 col-md-8 col-sm-12 desc'> 
<form action='' method='POST' enctype='multipart/form-data' class='form-group' style='margin-bottom: 1%; align: center;'>
<h4> Подача заявки</h4>
<label>Категория: </label>
<label>$nameCategory</label><br>
<label> Фотографии</label>
<input type='file' name='photo' placeholder='Фотография' class='form-control' value=''><br>
<label> Камеры</label>
<input type='text' name='cameras' placeholder='Камеры' class='form-control' value=''><br>
<label> Формат</label>
<select name='medium' value='Формат' class='form-control'>
    <option value='Цифровая'>Цифровая</option>
    <option value='Пленочная'>Пленочная</option>
    <option value='Смешанная'>Смешанная</option>
</select><br>
<label> Описание</label>
<input type='text' name='description' placeholder='Описание' class='form-control' value=''><br>

<button type='submit' id='submit' name='submit' class='btn' style='background-color: black; color: white;'>Отправить</button>
<input type='hidden' name='idCategory' value='".$idCategory."'>
<input type='hidden' name='idUser_new' value='".$idUser_new."'>
</form>
</div>";

if (isset($_POST['submit'])) {
    // Handle file upload
    $photo_name = $_FILES['photo']['name'];
    $photo_tmp_name = $_FILES['photo']['tmp_name'];
    $target_dir = "img/uploaded/";
    $target_file = $target_dir . basename($photo_name);
    move_uploaded_file($photo_tmp_name, $target_file);

    // Retrieve other form data
    $cameras = mysqli_real_escape_string($db, $_POST['cameras']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $medium = mysqli_real_escape_string($db, $_POST['medium']);
    $idCategory = mysqli_real_escape_string($db, $_POST['idCategory']);
    $idUser = mysqli_real_escape_string($db, $_POST['idUser_new']);
    $date = date("Y-m-d");
    echo("<script>console.log(' '$date' " . $data . "');</script>");

    // Insert data into the database
    $sql = "INSERT INTO Applications (ID_User, ID_Category, Date_of_Request, Status, Photo_name, Photo_path, Description, Cameras, Medium)
            VALUES ($idUser, $idCategory, '$date',  0, '$photo_name', '$target_file', '$description', '$cameras', '$medium')";
    
    echo "SQL Query: $sql"; // Output the SQL query for debugging
    $result = mysqli_query($db, $sql);
    
    if ($result) {
        echo "Добавлено";
        echo "<script> document.location.href = 'categories.php'</script>";
    } else {
        echo "Ошибка: " . mysqli_error($db); // Output MySQL error for debugging
    }
}

?>


        </div>
    </body>
</html>