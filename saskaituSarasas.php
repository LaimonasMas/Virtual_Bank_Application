<?php
session_start();
require __DIR__.'/bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION = $_POST;

    // nukilinu lentele
    header('Location: http://localhost/nd/nd_8/saskaituSarasas.php');
    die;
}
_d($_SESSION);

// jei dar nera failo tai sukuriu ir irasau pirma saskaita
if (!is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json') && !empty($_SESSION['vardas']) && !empty($_SESSION['pavarde']) && !empty($_SESSION['saskaitosNumeris']) && !empty($_SESSION['asmensKodas'])) {
    $masyvas[] = $_SESSION;
    $stringas = json_encode($masyvas);
    file_put_contents('saskaitos.json', $stringas);
    $stringas = file_get_contents('saskaitos.json');
    $masyvas = json_decode($stringas, 1);
} else if (!empty($_SESSION['vardas']) && !empty($_SESSION['pavarde']) && !empty($_SESSION['saskaitosNumeris']) && !empty($_SESSION['asmensKodas'])) {
    $stringas = file_get_contents('saskaitos.json');
    $masyvas = json_decode($stringas, 1);
    // pridedu kitas saskaitas jei nesikartoja asmens kodas
    if (!str_contains($stringas, $_SESSION['asmensKodas'])) { 
        $masyvas[] = $_SESSION;
        $stringas = json_encode($masyvas);
        file_put_contents('saskaitos.json', $stringas);
    }
}

// istrinti saskaita
if (isset($_SESSION['istrintiPagalAK']) && is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json')) {
    $stringas = file_get_contents('saskaitos.json');
    $masyvas = json_decode($stringas, 1);
    foreach ($masyvas as $key => $value) {
        if (isset($_SESSION['istrintiPagalAK']) && $_SESSION['istrintiPagalAK'] == $masyvas[$key]['asmensKodas']  && ($masyvas[$key]['suma'] == 0)) {
            unset($masyvas[$key]);
        }
        unset($_SESSION['istrintiPagalAK']);   
    }
    array_values($masyvas);
    $stringas = json_encode($masyvas);
    file_put_contents('saskaitos.json', $stringas);
} 

$stringas = file_get_contents('saskaitos.json');
$masyvas = json_decode($stringas, 1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sąskaitų sąrašas</title>
    <link rel="stylesheet" href="main.css">

</head>

<body style="background:#DEE1E6">
    <?php include 'navigation.php'; ?>
    <table class="table" style="background:#F3F3F3">
        <thead>
            <tr>
            <br>
                <th scope="col" style="width:60px"><p style="border-style:outset; border-radius:5px">#</p></th>
                <th scope="col" style="width:165px; text-align:left"><p style="border-style:outset; border-radius:5px">Vardas</p></th>
                <th scope="col" style="width:180px; text-align:left"><p style="border-style:outset; border-radius:5px">Pavardė</p></th>
                <th scope="col" style="width:250px; text-align:left"><p style="border-style:outset; border-radius:5px">Sąskaitos numeris</p></th>
                <th scope="col" style="width:150px; text-align:left"><p style="border-style:outset; border-radius:5px">Asmens kodas</p></th>
                <th scope="col" style="width:150px; text-align:left"><p style="border-style:outset; border-radius:5px">Sąskaitos likutis</p></th>
                <th scope="col" style="width:350px; text-align:left"><p style="border-style:outset; border-radius:5px">Veiksmai</p></th>                
            </tr>            
        </thead>        
        <tbody>     
            <?php if (isset($masyvas)) : ?>
                <?php usort($masyvas, function ($a, $b) {
                    return $a['pavarde'] <=> $b['pavarde'];
                }); ?>
                <?php foreach ($masyvas as $key => $value) : ?>
                    <tr>
                        <th scope="row"><?= ($key + 1) ?></th>
                        <td><?= $masyvas[$key]['vardas'] ?></td>
                        <td><?= $masyvas[$key]['pavarde'] ?></td>
                        <td><?= $masyvas[$key]['saskaitosNumeris'] ?></td>
                        <td><?= $masyvas[$key]['asmensKodas'] ?></td>
                        <td><?= '€'.' '.$masyvas[$key]['suma']?></td>
                        <td>
                            <form style="display:inline-block" action="http://localhost/nd/nd_8/pridetiLesas.php" method="post">
                                <button style="background:#4CAF50; color:#FFFFFF; border-radius:5px" type="submit" name="asmensKodas" value="<?php echo $value['asmensKodas'] ?>">Pridėti Lėšų</button>
                            </form>
                            <form style="display:inline-block" action="http://localhost/nd/nd_8/nuskaitytiLesas.php" method="post">
                                <button style="background:#E2E51B; font-weight:bold; color:black; border-radius: 5px" type="submit" name="asmensKodas" value="<?php echo $value['asmensKodas'] ?>">Nuskaityti Lėšas</button>
                            </form>
                            <form style="display:inline-block" action="http://localhost/nd/nd_8/saskaituSarasas.php" method="post">
                                <button style="background:#ED5E68; color:#FFFFFF; font-weight:bold; border-radius:5px" type="submit" name="istrintiPagalAK" value="<?php echo $value['asmensKodas'] ?>">Ištrinti sąskaitą</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>

    </table>

</body>

</html>