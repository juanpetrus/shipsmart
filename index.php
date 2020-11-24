<?php
    ob_start(); session_start();
    //ini_set('display_errors', 1);
    //error_reporting(E_ALL);

    require('dts/dbaSis.php');
    require('dts/outSis.php');
    require('dts/setSis.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ShipSmart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
</head>
<body>
    <?php setArq('includes/nav'); ?>
    <div class="container">
        <?php
            if(empty($_GET['exe'])){
                require('home.php');
            }elseif(file_exists($_GET['exe'].'.php')){
                require($_GET['exe'].'.php');
            }else{
                echo '<div class="bloco"><span class="ms in">Desculpe, a página que você está tentando acessar é inválida!</span></div>';	
            }
        ?>
    </div>
    <script>
        $(function() {
            $('.money').maskMoney();
            $('.weight').mask("#0.000", {reverse: true});
            $('.alpha').mask('ZZ',{translation:  {'Z': {pattern: /[áéíóúñüàèa-zA-Z0-9\s]/, recursive: true}}});
        })
    </script>
</body>
</html>