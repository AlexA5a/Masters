<?php
    session_start();
?>
<?php
    include("db.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/authstyle.css" type="text/css">
    <title>auth</title>
</head>
<body>
    <form method="post" action="">
        <input checked="" id="signin" name="action" type="radio" value="signin">
        <label for="signin">Вход</label>
        <input id="signup" name="action" type="radio" value="signup">
        <label for="signup">Регистрация</label>
        <div id="wrapper">
            <div id="arrow"></div>
            <input id="email" placeholder="Email" name="email" type="text">
            <input id="passw" placeholder="Пароль" name="passw" type="password">
            <input id="repass" placeholder="Повтор пароля" type="password" name="repass">
        </div>
        <button type="submit" id="submit" name="submit">
            <span>
            <br>
            Вход 
                <br>
                Регистрация
                <br>
                
            </span>
        </button>
    </form>
    <a id="hint" href="index.php">back to the site</a>

    
</body>

<?php
if(ISSET($_POST['submit']))
{
    
    $email=$_POST['email'];
    $passw=$_POST['passw'];

    
    
    if(empty($email) or empty($passw))
    {
        exit("Вы ввели не всю информацию");
    }
    
    if($_POST['action']=="signup")
    {
        $query="SELECT * FROM Users WHERE Email = '$email'";
        $result = mysqli_query($db,$query);
        $myrow=mysqli_fetch_array($result);

        if(!empty($myrow['ID_User']))
        {
            exit("Извините, пользователь с таким email уже существует");
        }

        $sql = "INSERT INTO Users(Email, Passw) VALUES ('$email','$passw')";
        $result=mysqli_query($db,$sql);
        
        if($result==TRUE)
        {
            echo "Вы успешно зарегестрированы. Вы можете авторизоваться и перейти в личный кабинет";
            $_SESSION['User_name']=$email;
            $query = "SELECT max(ID_User) AS ID_User FROM Users";
            $result = mysqli_query($db,$query);
            $myrow = mysqli_fetch_array($result);
            $_SESSION['ID_User']=$myrow['ID_User'];
            echo "<script> document.location.href = 'client.php'</script>";
        }
        else{
            echo("<script>console.log('2 " . $data . "');</script>");
            echo ("Ошибка регистрации");
        }
    }

    if($_POST['action']=="signin")
    {
        $query="SELECT * FROM Users WHERE Email = '$email'";
        $result = mysqli_query($db,$query);
        $myrow=mysqli_fetch_array($result);

        

        if(empty($myrow['User_name']))
        {
            exit("Извините, пользователь с таким логином/email не зарегестрирован");
        }
        else{
            if($myrow['Passw']==$passw)
        {
            $_SESSION['User_name']=$myrow['User_name'];
            $_SESSION['ID_User']=$myrow['ID_User'];
            
            if($myrow['Position']=="manager"){
                echo "<script> document.location.href = 'manager.php'</script>";
            }
            else if($myrow['Position']=="expert"){
                echo "<script> document.location.href = 'expert.php'</script>";
            }
            else{
                echo "<script> document.location.href = 'client.php'</script>";
            }
        }
        else{
            exit("Пароль неверный");
        }  
        }
    }
}

?>
