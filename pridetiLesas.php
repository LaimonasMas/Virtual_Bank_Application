<?php

_d($_POST);
if (is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json')) {
    $stringas = file_get_contents('saskaitos.json');
$masyvas = json_decode($stringas, 1);
_d($masyvas);
}
foreach ($masyvas as $key => $value) {
    if ($masyvas[$key]['asmensKodas'] == $_POST['asmensKodas']) {
        $masyvas[$key]['suma'] = 200;
        _d('as ife');
    }
}
$stringas = json_encode($masyvas);
file_put_contents('saskaitos.json', $stringas);
$stringas = file_get_contents('saskaitos.json');
$masyvas = json_decode($stringas, 1);
_d($masyvas);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">

</head>

<body>
    <?php include 'navigation.php'; ?>


</body>

</html>