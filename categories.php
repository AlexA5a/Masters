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
if (!isset($_POST['submit']))
{
        $sql="SELECT * FROM Categories";
        $result=mysqli_query($db,$sql);
        echo"<h4> Выбор категории</h4>";

        echo"<table class='table table-bordered table-sm';>
        <tr class='table-primary'><th>Название</th><th></th>";

        while($myrow=mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>".$myrow["Name_of_Category"]."</td>";
            echo "<td> <form method='post' action=''>
            <button type='submit' class='btn btn-primary' style='background-color: black; color: white;' formaction='submitOrders.php'>Подать заявку</button>
            </td>";

            echo"<input type='hidden' name='idCategory' value='".$myrow['ID_Category']."'></form>";
            echo"<input type='hidden' name='nameCategory' value='".$myrow['Name_of_Category']."'></form>";
            echo"</tr>";
        }

        echo "</table>";
}

?>
        </div>
    </body>
</html>