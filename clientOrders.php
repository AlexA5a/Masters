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
        <div class="row about">
            <div class="col-lg-4 col-md-4 col-sm-12 ">
                <form method="post" action="" id="#form" style="left: 5%;top:0%;width: 1wh;" >
                <h4> Фильтр</h4>
                    <input type="checkbox" name="chb1" value="1">По названию
                    <input type="text" name="searchName" placeholder="Название программы" class="form-control">
                    <input type="checkbox" name="chb2" value="2">Статус
                    <select name="typeStatus" value="Статус" class="form-control">
                        <option value="Рассматривается">Рассматривается</option>
                        <option value="Принята">Принята</option>
                    </select>
                    <input type="checkbox" name="chb3" value="3">№ документа
                    <input type="number" name="searchDocNum" placeholder="*******" class="form-control">
                    <button type="submit" class='btn btn-primary' >Поиск</button>
                </form>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 desc"> 


<?php
    $sql="SELECT * FROM Applications where ID_User = $idUser";
    $result=mysqli_query($db,$sql);
    echo"<h4> Мои заявки</h4>";

    echo"<table class='table table-bordered table-sm';>
    <tr class='table-primary'<th>ID</th><th>Название</th><th>Дата заявки</th><th>Статус заявки</th><th>№ документа</th>";

    while($myrow=mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>".$myrow["ID_Category"]."</td>";
        echo "<td>".$myrow["Name_of_Category"]."</td>";
        echo "<td>".$myrow["Date_of_Request"]."</td>";
        echo "<td>".$myrow["Status"]."</td>";
        echo "<td>".$myrow["N_Request"]."</td>";

        echo"<input type='hidden' name='idCategory' value='".$myrow['ID_Category']."'></form>";
        echo"</tr>";
    }

    echo "</table>";
?>
            </div>
        </div>
    </body>
</html>