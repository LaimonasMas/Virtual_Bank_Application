<?php
require __DIR__.'/bootstrap.php';

$nuskaitytiLesas = withdrawFunds();
$readAccount = readAccount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuskaityti lėšas</title>
    <link rel="stylesheet" href="main.css">

</head>

<body style="background:#DEE1E6">
    <?php include 'navigation.php'; ?>
    <table class="table" class="table" style="background:#F3F3F3; width:97vw">
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
            <?php if (isset($readAccount)) : ?>
                <?php usort($readAccount, function ($a, $b) {
                    return $a['pavarde'] <=> $b['pavarde'];
                }); ?>
                <?php foreach ($readAccount as $key => $value) : ?>
                    <tr>
                        <th scope="row"><?= ($key + 1) ?></th>
                        <td><?= $readAccount[$key]['vardas'] ?></td>
                        <td><?= $readAccount[$key]['pavarde'] ?></td>
                        <td><?= '€'.' '.$readAccount[$key]['suma'] ?></td>
                        <td>
                            <form action="http://localhost/nd/nd_8/nuskaitytiLesas.php" method="post">
                                <label for="skaiciai">Įveskite sumą: </label>
                                <input type="number" name="skaiciai" min="0" value="" id="">
                                <button style="background:#E2E51B; font-weight:bold; color:black; border-radius:5px" type="submit" name="nuskaitytiLesas" value="<?= $value['accountId'] ?>">Nuskaityti lėšas</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</body>

</html>