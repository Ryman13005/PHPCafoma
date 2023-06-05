<?php ob_start()?>
<?php
    if(isset($_GET['cookie-accept'])){
        setcookie('cookie-accept','true', time() + 3600); 
        header("Location: index.php");
    }
    require_once "outil/SecuriteClass.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" />
    <title>Cafoma</title>
 
</head>
<body>

<?php
require "header.php";
?>
     <div class="container">
        <h2><?php echo $titre ?></h2>
        <?php echo $content ?>
    </div>

    <div class="container">
     

<?php
require "footer.php";
?>
    
</body>
</html>

