<?php
require __DIR__.'/bootstrap.php';
// jei json failas egzistuoja
if (is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json')) {
    // issivynioju masyva
    $stringas = file_get_contents('saskaitos.json');
    $masyvas = json_decode($stringas, 1);
    if (isset($_POST['skaiciai'])) {            // <--- tikrinu ar ivesta prideti reiksme
        foreach ($masyvas as $key => $value) {  
            // ieškau ivesto ak reiksmes atitikmens masyve ir jei randu tai pridedu reiksme
            if ($_POST['asmensKodas'] == $masyvas[$key]['asmensKodas'])
            $masyvas[$key]['suma'] += $_POST['skaiciai'];          
        }
        // ivynioju ir pasidedu masyva, paskui nukilinu lentele
        $stringas = json_encode($masyvas);
        file_put_contents('saskaitos.json', $stringas);
        header('Location: http://localhost/nd/nd_8/pridetiLesas.php');
        die;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pridėti lėšas</title>
    <link rel="stylesheet" href="main.css">

</head>

<body style="background:#DEE1E6">
    <?php include 'navigation.php'; ?>
    <table class="table" style="background:#F3F3F3; width:97vw">
        <thead>
        <tr>
            <br>
                <th scope="col" style="width:60px"><p style="border-style:outset; border-radius:5px">#</p></th>
                <th scope="col" style="width:165px; text-align:left"><p style="border-style:outset; border-radius:5px">Vardas</p></th>
                <th scope="col" style="width:180px; text-align:left"><p style="border-style:outset; border-radius:5px">Pavardė</p></th>
                <th scope="col" style="width:150px; text-align:left"><p style="border-style:outset; border-radius:5px">Sąskaitos likutis</p></th>
                <th scope="col" style="width:400px; text-align:left"><p style="border-style:outset; border-radius:5px">Veiksmai</p></th>                
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
                        <td><?= '€'.' '.$masyvas[$key]['suma'] ?></td>
                        <td>
                            <form action="http://localhost/nd/nd_8/pridetiLesas.php" method="post">
                                <label for="skaiciai">Įveskite sumą: </label>
                                <input type="number" name="skaiciai" min="0" value="" id="">
                                <button style="background:#4CAF50; color:#FFFFFF; border-radius:5px" type="submit" name="asmensKodas" value="<?= $value['asmensKodas'] ?>">Pridėti lėšas</button>
                            </form>


                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>

    </table>



</body>

</html>