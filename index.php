<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>hotviissp8</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="CSS/Style.css">
        
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <img href="index.php" class="logo" src="img/1984.jpg" width="100px" height="15px">
            <nav>
                <ul class="nav__links">
                    <li><a href="shop.html">Shop</a></li>
                    <li><a href="index.php">Masters</a></li>
                    <li><a href="about.html">About</a></li>
                </ul>
            </nav>
            <a class="cta" href="login.php">Login</a>
        </header>

        <div>
            <h1 style="text-align: center; margin-top: 30px; color: white;">Masters</h1>
            <p style="text-align: center; margin-top: 10px; color: lightgray;">The Masters competition features six categories, focusing on the essence of visual art: <br>
                exceptional image quality, authentic colours, storytelling, and creativity.</p>
        </div>

        <div class="wrapper">
                <?php
                include("db.php");

                $sql="SELECT Description, Title, Photo_path, Photo_name from Categories";
                $result=mysqli_query($db,$sql);
            
                while($myrow=mysqli_fetch_array($result))
                {
                    echo "
                    <div class='image'>
                    <img src='$myrow[Photo_path]' width='100%'/>
                    <div class='content'>
                        <p>$myrow[Description]</p>
                    </div>
                    <h1 style='text-align: center; color: white; margin-top: 10px;'>$myrow[Title]</h1>
                </div>";
                }
                ?>
            
        </div>

        <footer>
            <div class="footer__container">
                
                <div class="footer__links">
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer__social">
                    <ul>
                        <li><a href="https://instagram.com/hotviissp8"><i class="fa fa-instagram">inst</i></a></li>
                        <li><a href="https://t.me/hotviissp8"><i class="fa fa-telegram">tg</i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>

<script>
    
</script>