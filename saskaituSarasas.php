
<?php
session_start();
require __DIR__.'/bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION = $_POST;

    // nukilinu lentele
    header('Location: http://localhost/nd/nd_8/naujaSaskaita.php');
    die;
}
deleteAccount();
writeAccId();
readNextAccId();
writeAccount();
readAccount();
_d($_SESSION);
_d(readNextAccId());
if(isset($_SESSION['newAccButton'])) {
    _d($_SESSION['newAccButton']);
}
$readAccount = readAccount();
unset($_SESSION['newAccButton']);
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

<body style="background:#DEE1E6">
    <?php include 'navigation.php'; ?>
    <table class="table" style="background:#F3F3F3">
        <thead>
            <tr>
            <br>
                <th scope="col" style="width:40px"><p style="border-style:outset; border-radius:5px">#</p></th>
                <th scope="col" style="width:40px; text-align:left"><p style="border-style:outset; border-radius:5px">ID</p></th>
                <th scope="col" style="width:165px; text-align:left"><p style="border-style:outset; border-radius:5px">Vardas</p></th>
                <th scope="col" style="width:180px; text-align:left"><p style="border-style:outset; border-radius:5px">Pavardė</p></th>
                <th scope="col" style="width:250px; text-align:left"><p style="border-style:outset; border-radius:5px">Sąskaitos numeris</p></th>
                <th scope="col" style="width:150px; text-align:left"><p style="border-style:outset; border-radius:5px">Asmens kodas</p></th>
                <th scope="col" style="width:150px; text-align:left"><p style="border-style:outset; border-radius:5px">Sąskaitos likutis</p></th>
                <th scope="col" style="width:350px; text-align:left"><p style="border-style:outset; border-radius:5px">Veiksmai</p></th>                
            </tr>            
        </thead>        
        <tbody>     
            <?php if (isset($readAccount)) : ?>
                <?php usort($readAccount, function ($a, $b) {
                    return $a['pavarde'] <=> $b['pavarde'];
                }); ?>
                <?php foreach ($readAccount as $key => $value) : ?>
                    <tr>
                        <th scope="row"><?= ($key + 1) ?></th>
                        <td><?= $readAccount[$key]['accountId'] ?></td>
                        <td><?= $readAccount[$key]['vardas'] ?></td>
                        <td><?= $readAccount[$key]['pavarde'] ?></td>
                        <td><?= $readAccount[$key]['saskaitosNumeris'] ?></td>
                        <td><?= $readAccount[$key]['asmensKodas'] ?></td>
                        <td><?= '€'.' '.$readAccount[$key]['suma']?></td>
                        <td>
                            <form style="display:inline-block" action="http://localhost/nd/nd_8/pridetiLesas.php" method="post">
                                <button style="background:#4CAF50; color:#FFFFFF; border-radius:5px" type="submit" name="prideti" value="<?php echo $value['accountId'] ?>">Pridėti Lėšų</button>
                            </form>
                            <form style="display:inline-block" action="http://localhost/nd/nd_8/nuskaitytiLesas.php" method="post">
                                <button style="background:#E2E51B; font-weight:bold; color:black; border-radius: 5px" type="submit" name="nuskaityti" value="<?php echo $value['accountId'] ?>">Nuskaityti Lėšas</button>
                            </form>
                            <form style="display:inline-block" action="http://localhost/nd/nd_8/saskaituSarasas.php" method="post">
                                <button style="background:#ED5E68; color:#FFFFFF; font-weight:bold; border-radius:5px" type="submit" name="istrintiPagalID" value="<?php echo $value['accountId'] ?>">Ištrinti sąskaitą</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>

    </table>

</body>

</html>