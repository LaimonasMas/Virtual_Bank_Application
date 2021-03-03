<?php
require __DIR__.'/bootstrap.php';
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

// jei dar nera id failo tai sukuriu ir irasau pirma id
// if (!is_file('C:\xampp\htdocs\nd\nd_8\indexes.json')) {
//     $id = [$_SESSION['indexId'];
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sukurti sąskaitą</title>
<link rel="stylesheet" href="main.css">

    <style>
        input {
            display: block;
        }
    </style>
</head>

<body style="background:#DEE1E6">
<?php include 'navigation.php' ?>
<br>
    <form action="http://localhost/nd/nd_8/saskaituSarasas.php" method="post">
        <label style="display:inline-block; margin-left: 30px" for="vardas"><p style="border-style:outset; border-radius:5px; font-weight:bold; width:75px">Vardas</p></label>
        <input style="display:inline-block; margin:10px 30px 10px 5px" type="text" pattern=".{4,50}" name="vardas" id="" required title="Galima įvesti nuo 4 iki 50 raidžių">
        <label for="pavarde"><p style="display:inline-block; margin-left: 30px; border-style:outset; border-radius:5px; font-weight:bold; width:75px">Pavardė</p></label>
        <input style="display:inline-block; margin:10px 30px 10px 5px" type="text" pattern=".{4,50}" name="pavarde" id="" required title="Galima įvesti nuo 4 iki 50 raidžių">
        <input style="display:inline-block; margin:10px 30px 10px 5px" type="hidden" name="saskaitosNumeris" value="<?= accountGenerator() ?>" id="">
        <label for="asmensKodas"><p style="display:inline-block; margin-left: 30px; border-style:outset; border-radius:5px; font-weight:bold; width:130px">Asmens kodas</p></label>
        <input style="display:inline-block; margin:10px 5px 10px 5px" type="text" pattern="(^[3-6]\d{2}[0-1]\d{1}[0-3]\d{5})$" name="asmensKodas" id="" required title="Neteisingas asmens kodo formatas">
        <input type="hidden" name="suma" value="0">
        <input type="hidden" name="indexId" value="1">
        <button style="background:#4CAF50; color:#FFFFFF; border-radius:5px" type="submit" name="newAccButton" value="1">Sukurti</button>
    </form>

</body>

</html>