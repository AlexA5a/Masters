<?php

include("manNav.php");
include("db.php");
?>
<body style="margin-top: 50px;">
<div class="row about">
    <div class="col-lg-4 col-md-4 col-sm-12 ">
        <form method="post" action="" id="#form" style="left: 5%;top:0%;width: 1wh;" >
        <h4> Фильтр</h4>
            <label> Фамилия</label>
            <input type="text" name="inputFIO" placeholder="Фамилия" class="form-control">
            <button type="submit" name="submit" style='background-color: black; color: white;' class='btn btn-primary' >Поиск</button>
            <button type="submit" name="reset" style='background-color: black; color: white;' class='btn btn-primary' >Сброс</button>
        </form>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 desc"> 

<?php

if(!isset($_POST['submit']) || isset($_POST['reset']))
{

    $sql="SELECT ID_Application, concat(Lastname, ' ', Firstname) as FIO, Name_of_Category, Date_of_Request, Status from Applications 
    inner join Categories on Applications.ID_Category= Categories.ID_Category 
    inner join Users on Applications.ID_User = Users.ID_User where Applications.Status = 0";

    $result=mysqli_query($db,$sql);
    echo"<h4> Необработанные заявки</h4>";

    echo"<table class='table table-bordered table-sm'>
    <tr class='table-primary'><th>Номер</th><th>Имя</th><th>Категория</th><th>Дата заявки</th><th>Статус</th><th></th>";

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
        echo "<td>".$myrow["FIO"]."</td>";
        echo "<td>".$myrow["Name_of_Category"]."</td>";
        echo "<td>".$myrow["Date_of_Request"]."</td>";
        echo "<td>".$statusRNN."</td>";
        echo "<td> <form method='post'>
        <button type='submit' name='submit' style='background-color: black; color: white;' class='btn btn-primary' formaction='inspectApplication.php'>
        Просмотреть и принять решение</button>
        </td>";

        echo"<input type='hidden' name='ID_Application' value='".$myrow['ID_Application']."'></form>";
        echo"</tr>";
    }
    echo "</table>";
}
if(isset($_POST['submit']))
{

    $inputFIO = $_POST['inputFIO'];
    $sql="SELECT ID_Application, concat(Lastname, ' ', Firstname) as FIO, Name_of_Category, Date_of_Request, Status from Applications 
    inner join Categories on Applications.ID_Category= Categories.ID_Category 
    inner join Users on Applications.ID_User = Users.ID_User where Applications.Status = 0";

    $result=mysqli_query($db,$sql);
    echo"<h4> Необработанные заявки</h4>";

    echo"<table class='table table-bordered table-sm'>
    <tr class='table-primary'><th>Номер</th><th>Имя</th><th>Категория</th><th>Дата заявки</th><th>Статус</th><th></th>";

    while($myrow=mysqli_fetch_array($result))
    {

        if($inputFIO != null){
            echo("<script>console.log(' $inputFIO " . $data . "');</script>");
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
            if(strpos($myrow["FIO"], $inputFIO) != false) 
            {
               echo "<tr>";
               echo "<td>".$myrow["ID_Application"]."</td>";
               echo "<td>".$myrow["FIO"]."</td>";
               echo "<td>".$myrow["Name_of_Category"]."</td>";
               echo "<td>".$myrow["Date_of_Request"]."</td>";
               echo "<td>".$statusRNN."</td>";
               echo "<td> <form method='post'>
               <button type='submit' name='submit' class='btn btn-primary' style='background-color: black; color: white;' formaction='inspectApplication.php'>Изменить</button>
               </td>";
   
               echo"<input type='hidden' name='ID_Application' value='".$myrow['ID_Application']."'></form>";
               echo"</tr>";
            }
            echo "</table>";
        }
        else{
            echo "<tr>";
               echo "<td>".$myrow["ID_Application"]."</td>";
               echo "<td>".$myrow["FIO"]."</td>";
               echo "<td>".$myrow["Name_of_Category"]."</td>";
               echo "<td>".$myrow["Date_of_Request"]."</td>";
               echo "<td>".$statusRNN."</td>";
               echo "<td> <form method='post'>
               <button type='submit' name='submit' style='background-color: black; color: white;' class='btn btn-primary' formaction='inspectApplication.php'>Изменить</button>
               </td>";
   
               echo"<input type='hidden' name='ID_Application' value='".$myrow['ID_Application']."'></form>";
               echo"</tr>";

            
        }
        echo "</table>";
        
        
    }
    

}
?>
