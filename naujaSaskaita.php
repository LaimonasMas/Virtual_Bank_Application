<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="main.css">

    <style>
        input {
            display: block;
        }
    </style>
</head>

<body>
<?php include 'navigation.php' ?>
    <form action="http://localhost/nd/nd_8/saskaituSarasas.php" method="post">
        <label for="vardas">Vardas</label>
        <input type="text" name="vardas" id="">
        <label for="pavarde">Pavardė</label>
        <input type="text" name="pavarde" id="">
        <label for="saskaitosNumeris">Sąskaitos Numeris</label>
        <input type="text" name="saskaitosNumeris" id="">
        <label for="asmensKodas">Asmens kodas</label>
        <input type="text" name="asmensKodas" id="">
        <input type="hidden" name="suma" value="0">
        <input type="hidden" name="numeris" value="1">
        <button type="submit">Sukurti</button>
    </form>

</body>

</html>