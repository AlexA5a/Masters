<?php
    include("manNav.php");
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

$ID_Application=$_POST['ID_Application'];

if (!empty($ID_Application)) {
        $sql="SELECT Applications.Date_of_Request, Applications.Photo_name, Applications.Photo_path, Applications.Description, 
    Applications.Cameras, Applications.Medium, Users.User_name, Categories.Name_of_Category, Applications.Status, Applications.Issues from Applications
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
<h4>Заявка номер: $ID_Applciation</h4>
<label>Пользователь: </label>
<label>$userName</label><br>
<label>Дата подачи заявки: </label>
<label>$dateOfRequest</label><br>
<label>Категория: </label>
<label>$nameCategory</label><br>
<label>Описание: </label>
<label>$description</label><br>
<label>Камера: </label>
<label>$cameras</label><br>
<label>Формат: </label>
<label>$medium</label><br><br>
<label>Фотография: </label>
<img src='$photoPath' alt='$photoName' width='100%'>

<br><br><label>Статус: </label>
<label>$statusRN</label><br>

<label>Решение</label>
<select name='decision' value='Решение' class='form-control'>
    <option value='decline'>Отклонить</option>
    <option value='accept'>Принять</option>
    <option value='nothing'>В рассмотрение</option>
</select><br>
<label>Описание проблемы</label>
<input type='text' name='inputIssue' placeholder='' value='$myrow[Issues]' class='form-control'><br>
<input type='hidden' name='ID_Application' value='$ID_Application'>
<button type='submit' id='submit1' name='submit1' class='btn' style='background-color: black; color: white;'>Отправить</button>


</form>
</div>";

if (isset($_POST['submit1']))
{
    $ID_Application=$_POST['ID_Application'];
    $issuesUPD=$_POST['inputIssue'];
	$decision = $_POST['decision'];
    $status = 0;

	if($decision=='decline')
    {
        $status = 2;
    }
    elseif($decision=='accept'){
        $status = 1;
    }
    else{
        $status = 0;
    }

    $sql1="UPDATE Applications
        set Status = $status, Issues = '$issuesUPD' where ID_Application = $ID_Application";
        $result1=mysqli_query($db,$sql1);

        if($result1==TRUE)
        {
            echo"Добавлено";
            echo "<script> document.location.href = 'manOrders.php'</script>";
            
        }
        else
        {
            echo "Ошибка!";
        }
}

?>
        </div>
    </body>
</html>