<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">

        <title>Личный кабинет пользователя</title>
    </head>
    <body>
        <header>
            <nav>
                <ul class="nav__links">
                    <li><a href="manOrders.php">Заявки</a></li>
                    <li><a href="manager.php">Категории</a></li>
                    <li><a href="reports.php">Отчеты</a></li>
                    <li><a href="ratingsTable.php">Таблица</a></li>
                    <li><a href="winners.php">Победители</a></li>
                    <li><a href="index.php">Выход</a></li>
                </ul>
            </nav>
        </header>
    </body>
</html>

<?php
    $idUser=$_SESSION['ID_User'];
    $userName=$_SESSION['User_name'];
?>
