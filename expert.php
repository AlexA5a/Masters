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
        $sql = "SELECT Applications.ID_Application, Categories.Name_of_Category, Applications.Date_of_Request, Users.User_name
        FROM Applications 
        INNER JOIN Users ON Applications.ID_User = Users.ID_User 
        INNER JOIN Categories ON Applications.ID_Category = Categories.ID_Category
        LEFT JOIN Ratings ON Applications.ID_Application = Ratings.ID_Application AND Ratings.ID_User = $idUser
        WHERE Applications.Status = 1 
        AND Ratings.ID_Rating IS NULL";

    $result=mysqli_query($db,$sql);
    echo"<h4>Заявки</h4>";


    echo"<table class='table table-bordered table-sm';>
    <tr class='table-primary'><th>ID</th><th>Пользователь</th><th>Категория</th><th>Дата заявки</th><th></th>";

    while($myrow=mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>".$myrow["ID_Application"]."</td>";
        echo "<td>".$myrow["User_name"]."</td>";
        echo "<td>".$myrow["Name_of_Category"]."</td>";
        echo "<td>".$myrow["Date_of_Request"]."</td>";
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