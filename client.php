<?php

    include("clientNav.php");
    include("db.php");

?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<body style="margin-top: 50px;">
<?php
$sql="SELECT * FROM Users WHERE ID_User=$idUser";
$result=mysqli_query($db,$sql);
$myrow=mysqli_fetch_array($result);

$userName=$myrow["User_name"];
$passw=$myrow["Passw"];
$lastName=$myrow["Lastname"];
$firstName=$myrow["Firstname"];
$email=$myrow["Email"];

echo "
<div class='row about'>
</div>
<div class='col-lg-8 col-md-8 col-sm-12 desc'>
<form action='' method='POST' class='form-group' style='margin-bottom: 1%;'>
<h4> Редактирование профиля </h4>
<input type='text' name='userName' placeholder='Логин/E-mail' class='form-control' value='$userName' required><br>
<input type='password' name='passw' placeholder='' class='form-control' value='$passw' required><br>
<input type='text' name='lastName' placeholder='Фамилия' class='form-control' value='$lastName'><br>
<input type='text' name='firstName' placeholder='Имя' class='form-control' value='$firstName'><br>
<input type='email' name='email' placeholder='email' class='form-control' value='$email'><br>
<button type='submit' id='submit' name='submit' class='btn' style='background-color: black; color: white;'>Сохранить изменения</button>
</form>
</div>";
?>

<?php
if (isset($_POST['submit']))
{
    $userName=$_POST["userName"];
    $passw=$_POST["passw"];
    $lastName=$_POST["lastName"];
    $firstName=$_POST["firstName"];
    $email=$_POST["email"];

    $sql="UPDATE Users SET User_name='$userName', Passw='$passw', Lastname='$lastName', Firstname='$firstName', Email='$email'
    WHERE ID_User=$idUser";
    $result=mysqli_query($db,$sql);
    echo("<script>console.log('3 " . $data . "');</script>");
        if($result==TRUE)
        {
            echo "Данные успешно сохранены!";
            echo "<script> document.location.href = 'client.php'</script>";
        }
        else
        {
            echo "Ошибка";
        }
}
?>
</body>
</html>