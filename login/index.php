<?php
require __DIR__ . '/bootstrap.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bankas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../main.css?= time() ?>">
</head>

<body style="background:#DEE1E6">
    <?php include 'loginNavigation.php' ?>
    <h1>Laimono Bankas</h1>
    <div class="virsimg">
        <img style="display:block; width:300px;" src="../img/1. 19_SEB_Kontor_Katarinavägen17_147_5.jpg" alt="">
        <h5 class="index-h5">Informacija dėl finansų tvarkymo karantino metu</h5>
        <span>Sužinokite, kaip atidėti kreditų grąžinimą, nuotoliniu būdu tvarkyti savo finansus</span>
    </div>
    <div class="virsimg">
        <img style="display:block; width:300px;" src="../img/3. DSF0434a.jpg" alt="">
        <h5 class="index-h5">Lengvas būdas taupyti</h5>
        <span>Mobiliojoje programėlėje susikurkite tikslus ir sekite savo taupymo progresą.</span>
    </div>
    <div class="virsimg">
        <img style="display:block; width:300px;" src="../img/SEB-credit-card-without-card.png" alt="">
        <h5 class="index-h5">Vaizdo konsultacija internetu</h5>
        <span>Pasitarti finansų klausimais yra paprasta, kadangi tai galite daryti ir internetu.</span>
    </div>

    <?php include 'footer.php' ?>

</body>

</html>