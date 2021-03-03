<?php

// generuoja nauja saskaita
function accountGenerator() {
    $string1 = '';
    for ($i=0; $i < 2; $i++) { 
        $string1 .= rand(0,9);
    }
    $string2 = '';
    for ($i=0; $i < 3; $i++) { 
        $string2 .= rand(0,9);
    }
    $string3 = '';
    for ($i=0; $i < 4; $i++) { 
        $string3 .= rand(0,9);
    }
    $string4 = '';
    for ($i=0; $i < 4; $i++) { 
        $string4 .= rand(0,9);
    }
    return 'LT'.$string1.' '.'7044 0'.$string2.' '.$string3.' '.$string4;
}

?>

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
        <input type="text" pattern=".{4,}" name="vardas" id="" required title="Mažiausiai 4 raidės">
        <label for="pavarde">Pavardė</label>
        <input type="text" pattern=".{4,}" name="pavarde" id="" required title="Mažiausiai 4 raidės">
        <input type="hidden" name="saskaitosNumeris" value="<?= accountGenerator() ?>" id="">
        <label for="asmensKodas">Asmens kodas</label>
        <input type="text" pattern="(^[3-6])\d{10}" name="asmensKodas" id="" required title="Neteisingas asmens kodo formatas">
        <input type="hidden" name="suma" value="0">
        <button type="submit" name="newAccButton" value="1">Sukurti</button>
    </form>

</body>

</html>