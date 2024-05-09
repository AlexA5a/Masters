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


    $Name_of_Category = $_POST['Name_of_Category'];
    $ID_Category = $_POST['idCategory'];
    $sql = "SELECT Applications.ID_Application, Categories.Name_of_Category, Applications.Date_of_Request, Users.User_name, Ratings.Rating
        FROM Applications 
        INNER JOIN Users ON Applications.ID_User = Users.ID_User 
        INNER JOIN Categories ON Applications.ID_Category = Categories.ID_Category
        LEFT JOIN Ratings ON Applications.ID_Application = Ratings.ID_Application AND Ratings.ID_User = $idUser
        WHERE Applications.Status = 1 
         AND Applications.ID_Category = $ID_Category";
        
        $result=mysqli_query($db,$sql);
    echo"<h4>Заявки с оценкой в категории <b>$Name_of_Category</b></h4>";

    echo"<table class='table table-bordered table-sm';>
    <tr class='table-primary'><th>ID</th><th>Пользователь</th><th>Дата заявки</th><th>Оценка</th><th></th>";

    while($myrow=mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>".$myrow["ID_Application"]."</td>";
        echo "<td>".$myrow["User_name"]."</td>";
        echo "<td>".$myrow["Date_of_Request"]."</td>";
        echo "<td>".$myrow["Rating"]."</td>";
        echo "<td> <form method='post' action=''>
        <button type='submit' name='submit' class='btn btn-primary' formaction='viewPApp.php' style='background-color: black; color: white;'>Просмотреть</button>
        </td>";

        echo"<input type='hidden' name='ID_Application' value='".$myrow['ID_Application']."'></form>";
        echo"</tr>";
    }

    echo "</table>";
?>
            </div>
        </div>
    </body>
</html>