<?php
require __DIR__.'/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bankas</title>   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> 
    <link rel="stylesheet" href="main.css?ver=<?= time() ?>">
</head>
<body style="background:#DEE1E6">
<?php include 'navigation.php'; ?>
<h1>Laimono Bankas</h1>

<div class="virsimg">
<img style="display:block; width:300px;" src="img/1. 19_SEB_Kontor_Katarinavägen17_147_5.jpg" alt="">
<p class="ptagpoimg">Foto 1</p>
</div>
<div class="virsimg">
<img style="display:block; width:300px;" src="img/3. DSF0434a.jpg" alt="">
<p class="ptagpoimg">Foto 2</p>
</div><div class="virsimg">
<img style="display:block; width:300px;" src="img/SEB-credit-card-without-card.png" alt="">
<p class="ptagpoimg">Foto 3</p>
</div>


</body>
</html>