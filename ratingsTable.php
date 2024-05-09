<?php
    include("expertNav.php");
    include("db.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <title>Личный кабинет эксперта</title>
    </head>
    <body style="margin-top: 50px;">
                <div class="col-lg-8 col-md-8 col-sm-12 desc"> 


<?php

    $sql="SELECT * FROM Users WHERE ID_User=$idUser";
    $result=mysqli_query($db,$sql);
    $myrow=mysqli_fetch_array($result);

    $userNameG=$myrow["Position"];

    $sql = "SELECT Applications.ID_Application, Applications.Winner_in_Category, Categories.Name_of_Category, Applications.Date_of_Request, 
    SUM(Ratings.Rating) AS Sum_Rating, Users.User_name 
    FROM Applications 
    INNER JOIN Users ON Applications.ID_User = Users.ID_User 
    INNER JOIN Categories ON Applications.ID_Category = Categories.ID_Category 
    LEFT JOIN Ratings ON Applications.ID_Application = Ratings.ID_Application 
    WHERE Applications.Status = 1 and Ratings.Rating is not null
    GROUP BY Applications.ID_Application, Applications.Winner_in_Category, Categories.Name_of_Category, Applications.Date_of_Request, Users.User_name 
    ORDER BY Sum_Rating DESC";
    $result=mysqli_query($db,$sql);
    echo"<h4>Таблица</h4>";

    echo"<table class='table table-bordered table-sm';>
    <tr class='table-primary'><th>ID</th><th>Пользователь</th><th>Категория</th><th>Дата заявки</th><th>Рейтинг</th><th></th>";

    while($myrow=mysqli_fetch_array($result))
    {
        if($myrow["Winner_in_Category"] != null)
        {
            echo "<tr>";
            echo "<td>".$myrow["ID_Application"]."</td>";
            echo "<td>".$myrow["User_name"]."</td>";
            echo "<td style='text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; color: gold;'>".$myrow["Name_of_Category"]."</td>";
            echo "<td>".$myrow["Date_of_Request"]."</td>";
            echo "<td>".$myrow["Sum_Rating"]."</td>";
            if($userNameG == 'manager'){
            echo "<td> <form method='post' action=''>";
            
            
            echo "<button type='submit' name='submit' class='btn btn-primary' style='background-color: black; color: white;'>Просмотреть</button>
            <button type='submit' name='submit1' class='btn btn-primary' style='background-color: black; color: white;'>Забрать победу</button>
            </td>";
            }
            $result1 = 'take';
            
    
            echo"<input type='hidden' name='ID_Application' value='".$myrow['ID_Application']."'>";
            echo"<input type='hidden' name='result' value='$result1'>";
            echo"<input type='hidden' name='Name_of_Category' value='".$myrow['Name_of_Category']."'></form>";
            echo"</tr>";
        }
        else{
            echo "<tr>";
            echo "<td>".$myrow["ID_Application"]."</td>";
            echo "<td>".$myrow["User_name"]."</td>";
            echo "<td>".$myrow["Name_of_Category"]."</td>";
            echo "<td>".$myrow["Date_of_Request"]."</td>";
            echo "<td>".$myrow["Sum_Rating"]."</td>";
            if($userNameG == 'manager'){
            echo "<td> <form method='post' action=''>
            <button type='submit' name='submit' class='btn btn-primary' style='background-color: black; color: white;'>Просмотреть</button>
            <button type='submit' name='submit1' class='btn btn-primary' style='background-color: gold; color: black;'>Назначить победителем</button>
            </td>";
            }
            $result1 = 'win';
    
            echo"<input type='hidden' name='ID_Application' value='".$myrow['ID_Application']."'>";
            echo"<input type='hidden' name='result' value='$result1'>";
            echo"<input type='hidden' name='Name_of_Category' value='".$myrow['Name_of_Category']."'></form>";
            echo"</tr>";
        }
        
    }

    echo "</table>";

    if (isset($_POST['submit1']))
{
    $ID_Application=$_POST['ID_Application'];
    $Name_of_Category=$_POST['Name_of_Category'];
    $result1 = $_POST['result'];
    if($result1 != 'win')
    {
        $result1 = null;
    }
    else
    {
        $result1 = $Name_of_Category;
    }
    

    echo("<script>console.log('$ID_Application " . $data . "');</script>");
    echo("<script>console.log('$Name_of_Category " . $data . "');</script>");

    $sql1="UPDATE Applications
        set Winner_in_Category = '$result1' where ID_Application = $ID_Application";
        $result1=mysqli_query($db,$sql1);

        if($result1==TRUE)
        {
            echo"Добавлено";
            echo "<script> document.location.href = 'ratingsTable.php'</script>";
            
        }
        else
        {
            echo"J";
        }
}

if (isset($_POST['submit']))
{
    $ID_Application=$_POST['ID_Application'];
	if (!empty($ID_Application)) {
        $sql="SELECT Applications.Date_of_Request, Applications.Photo_name, Applications.Photo_path, Applications.Issues, Applications.Status, Applications.Description, 
    Applications.Cameras, Applications.Medium, Users.User_name, Categories.Name_of_Category from Applications
    inner join Users on Applications.ID_User = Users.ID_User 
    inner join Categories on Applications.ID_Category= Categories.ID_Category where ID_Application = $ID_Application ";

    $result=mysqli_query($db,$sql);
    if (!$result) {
        die('Error: ' . mysqli_error($db));
    }

    $myrow=mysqli_fetch_array($result);

    $nameCategory=$myrow["Name_of_Category"];
    $userName=$myrow["User_name"];
    $dateOfRequest=$myrow["Date_of_Request"];
    $photoName=$myrow["Photo_name"];
    $photoPath=$myrow["Photo_path"];
    $description=$myrow["Description"];
    $cameras=$myrow["Cameras"];
    $medium=$myrow["Medium"];

    $issues=$myrow["Issues"];
    $statusRN=$myrow["Status"];


    if($statusRN==0)
    {
        $statusRN = "В рассмотрении";
    }
    elseif($statusRN==1){
        $statusRN = "Принято";
    }
    else{
        $statusRN = "Отклонено";
    }
        
    }
    else
    {
        echo "ID_Application is empty or not set";
    }

    echo("<script>console.log('$photoName " . $data . "');</script>");
    echo("<script>console.log('$photoPath " . $data . "');</script>");
    echo "

    <div class='row about'>
    </div>
    <div class='col-lg-8 col-md-8 col-sm-12 desc'>
    <div class='col-lg-8 col-md-8 col-sm-12 desc'> 
    <div class='col-lg-8 col-md-8 col-sm-12 desc'> 
    <form action='' method='POST' class='form-group' style='margin-bottom: 1%; align: center;'>
    <h4>Заявка номер: $ID_Application</h4>
    <label>Дата подачи заявки: </label>
    <label>$dateOfRequest</label><br>
    <label>Категория: </label>
    <label>$nameCategory</label><br>
    <label>Описание: </label>
    <label>$description</label><br>
    <label>Камера: </label>
    <label>$cameras</label><br>
    <label>Формат: </label>
    <label>$medium</label><br>
    <label>Статус: </label>
    <label>$statusRN</label><br>
    <label>Описание проблемы: </label>
    <label style='color: red;'>$issues</label><br>
    <label>Фотография: </label>
    <img src='$photoPath' alt='$photoName' width='100%'>
    </form>
    </div>";
}
?>
            </div>
        </div>
    </body>
</html>