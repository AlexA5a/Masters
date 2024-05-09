<?php
session_start();
?>
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
            <label> Статус</label>
            <select name="typeStatus" value="Статус" class="form-control">
                <option value="Необработана">Необработана</option>
                <option value="Принята">Принята</option>
                <option value="Отклонена">Отклонена</option>
            </select>
            <button type="submit" name="submit" class='btn btn-primary' style='background-color: black; color: white;'>Поиск</button>
            <button type="submit" name="reset" class='btn btn-primary' style='background-color: black; color: white;'>Сброс</button>
        </form>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 desc"> 

<?php


if(!isset($_POST['submit']) || isset($_POST['reset']))
{

        echo("<script>console.log(' 1 " . $data . "');</script>");
        $sql="SELECT Applications.ID_Application, Applications.Date_of_Request, Applications.Status, Users.User_name, Categories.Name_of_Category from Applications 
        inner join Users on Applications.ID_User = Users.ID_User inner join Categories on Applications.ID_Category = Categories.ID_Category";
        $result=mysqli_query($db, $sql);
        echo "<h4>Заявки</h4>";
        echo "<table class='table table-bordered table-sm'>
        <tr class='table=primary'><th>Номер заявки</th><th>Пользователь</th>
        <th>Категория</th><th>Дата заявки</th><th>Статус</th><th></th>";
        while ($myrow=mysqli_fetch_array($result))
        {
            
        
                $statusRNN = $myrow["Status"];
                if($statusRNN==0){
                $statusRNN = "В рассмотрении";
                }
                elseif($statusRNN==1){
                    $statusRNN = "Принято";
                    }
                else{
                    $statusRNN = "Отклонено";
                }
            echo "<tr>";
            echo "<td>".$myrow['ID_Application']."</td>";
            echo "<td>".$myrow['User_name']."</td>";
            echo "<td>".$myrow['Name_of_Category']."</td>";
            echo "<td>".$myrow['Date_of_Request']."</td>";
            echo "<td>".$statusRNN."</td>";

            echo "<td> <form method='post'>
        <button type='submit' name='submit' style='background-color: black; color: white;' class='btn btn-primary' formaction='inspectApplication.php'>Просмотреть</button>
        </td>";
        echo"<input type='hidden' name='ID_Application' value='".$myrow['ID_Application']."'></form>";
            echo "<tr>";
        }
            echo "</table>";
    }

else
    {

        $typeStatus=$_POST['typeStatus'];
        switch($typeStatus)
        {
            case 'Необработана': $typeStatus = 0;
            break;
            case 'Принята': $typeStatus = 1;
            break;
            case 'Отклонена': $typeStatus = 2;
            break;
        }

        echo("<script>console.log(' $typeStatus " . $data . "');</script>");
        $sql="SELECT Applications.ID_Application, Applications.Date_of_Request, Applications.Status, Users.User_name, Categories.Name_of_Category from Applications 
        inner join Users on Applications.ID_User = Users.ID_User inner join Categories on Applications.ID_Category = Categories.ID_Category where Applications.Status = $typeStatus";
        $result=mysqli_query($db, $sql);
        echo "<h4>Заявки</h4>";
        echo "<table class='table table-bordered table-sm'>
        <tr class='table=primary'><th>Номер заявки</th><th>Пользователь</th>
        <th>Категория</th><th>Дата заявки</th><th>Статус</th>";

        while ($myrow=mysqli_fetch_array($result))
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
            echo "<td>".$myrow['ID_Application']."</td>";
            echo "<td>".$myrow['User_name']."</td>";
            echo "<td>".$myrow['Name_of_Category']."</td>";
            echo "<td>".$myrow['Date_of_Request']."</td>";
            echo "<td>".$statusRNN."</td>";

            echo "<td> <form method='post'>
        <button type='submit' name='submit' style='background-color: black; color: white;' class='btn btn-primary' formaction='inspectApplication.php'>Просмотреть</button>
        </td>";
        echo"<input type='hidden' name='ID_Application' value='".$myrow['ID_Application']."'></form>";
            echo "<tr>";
        }
            echo "</table>";
    }
    
?>