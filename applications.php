<?php
    include("clientNav.php");
    include("db.php");
?>
<body style="margin-top: 50px;">
<?php
    $sql="SELECT Applications.ID_Application, Applications.Date_of_Request , Applications.Status , Applications.Issues , Categories.Name_of_Category from Applications 
    inner join Categories on Applications.ID_Category = Categories.ID_Category where Applications.ID_User=$idUser";
    
    $result=mysqli_query($db,$sql);
    echo"<h4> Мои заявки</h4>";

    echo"<table class='table table-bordered table-sm';>
    <tr class='table-primary'><th>Номер</th><th>Название категории</th><th>Дата заявки</th><th>Статус заявки</th><th>Проблемы</th><th></th>";

    while($myrow=mysqli_fetch_array($result))
    {
        $statusRNN = $myrow["Status"];
            if($statusRNN==0)
        {
            $statusRNN = "В рассмотрении";
        }
        elseif($statusRNN==1){
            $statusRNN = "Принято";
        }
        else{
            $statusRNN = "Отклонено";
        }

        echo "<tr>";
        echo "<td>".$myrow["ID_Application"]."</td>";
        echo "<td>".$myrow["Name_of_Category"]."</td>";
        echo "<td>".$myrow["Date_of_Request"]."</td>";
        echo "<td>".$statusRNN."</td>";
        echo "<td>".$myrow["Issues"]."</td>";
        echo "<td> <form method='post'>
        <button type='submit' id='submit' name='submit' class='btn btn-primary' style='background-color: black; color: white;'>Просмотреть</button> </td>";

        echo"<input type='hidden' name='ID_Application' value='".$myrow['ID_Application']."'></form>";
        echo"</tr>";
    }

    echo "</table>";

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