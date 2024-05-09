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

    $ID_Application = $_POST['ID_Application'];

    $sql="SELECT Applications.ID_Application, Applications.Photo_name, Applications.Photo_path, Applications.Description, Applications.Cameras, Applications.Medium, 
    Categories.Name_of_Category, Applications.Date_of_Request, Users.User_name, Ratings.Rating FROM Applications 
    inner join Users on Applications.ID_User = Users.ID_User inner join Categories on Applications.ID_Category = Categories.ID_Category 
    LEFT JOIN Ratings ON Applications.ID_Application = Ratings.ID_Application AND Ratings.ID_User = $idUser
    where Applications.ID_Application = $ID_Application";
    $result=mysqli_query($db,$sql);
    echo"<h4>Заявка</h4>";

    echo"<table class='table table-bordered table-sm';>
    <tr class='table-primary'><th>ID</th><th>Пользователь</th><th>Название категории</th><th>Дата заявки</th><th>Оценка</th><th></th>";

    while($myrow=mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>".$myrow["ID_Application"]."</td>";
        echo "<td>".$myrow["User_name"]."</td>";
        echo "<td>".$myrow["Name_of_Category"]."</td>";
        echo "<td>".$myrow["Date_of_Request"]."</td>";
        
        echo "<form method='post' action='' style='left: 15%;top:40%;width: 1wh;' >";
        echo "<td>";
        echo "<input type='text' name='inputRating' placeholder='Введите рейтинг' value='$myrow[Rating]' class='form-control'> ";
        echo "</td>";

        echo "<td> 
        <button type='submit' style='background-color: black; color: white;' name='submit' class='btn btn-primary'>Изменить</button>
        </td>";
        echo "$Rating_before=$myrow[Rating]";
        
        

        echo"<input type='hidden' name='ID_Application' value='$ID_Application'></form>";
        echo"<input type='hidden' name='Rating_before' value='$Rating_before'></form>";
        echo"</tr>";

        echo "

        <div class='row about'>
        </div>
        <div class='col-lg-8 col-md-8 col-sm-12 desc'>
        <div class='col-lg-8 col-md-8 col-sm-12 desc'> 
        <div class='col-lg-8 col-md-8 col-sm-12 desc'> 
        <label>Описание: </label>
        <label>$myrow[Description]</label><br>
        <label>Камера: </label>
        <label>$myrow[Cameras]</label><br>
        <label>Формат: </label>
        <label>$myrow[Medium]</label><br><br>
        <label>Фотография: </label>
        <img src='$myrow[Photo_path]' alt='$myrow[Photo_name]' width='100%'>
        </div>";
    }

    echo "</table>";

    if (isset($_POST['submit']))
{
    
    $ID_Application=$_POST['ID_Application'];
	$Rating = $_POST['inputRating'];

    echo("<script>console.log('$ID_Application " . $data . "');</script>");
    echo("<script>console.log('$Rating " . $data . "');</script>");


    $sql = "SELECT COUNT(*) AS count_row
        FROM Ratings
        WHERE ID_User = $idUser AND ID_Application = $ID_Application";
    $result = mysqli_query($db, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($result);

        // Check the count of rows
        if ($row['count_row'] > 0) {
            $sql1="UPDATE Ratings
            set Rating = $Rating where ID_Application = $ID_Application and ID_User = $idUser";
            
        } else {
            $sql1="INSERT INTO Ratings(ID_Application, ID_User, Rating) values ('$ID_Application', '$idUser', $Rating)";
        }
        $result1=mysqli_query($db,$sql1);
        if($result1==TRUE)
        {
            echo"Добавлено";
            echo "<script> document.location.href = 'expert.php'</script>";
            
        }
        else
        {
            
        }
    } else {
        echo "Error executing the query: " . mysqli_error($db);
    }
        
}
?>
            </div>
        </div>
    </body>
</html>