<?php
session_start();
require __DIR__ . '/bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['login'] = 1;
    $_SESSION['user'] = $user;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['login'])) {
    if ($_SESSION['login'] = 1) {     
        _d($_SESSION['login']);    
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Location: http://localhost/nd/nd_8/login/login.php');
    die;
} 

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URL ?>main.css?ver=<?= time() ?>">

</head>

<body style="background:#DEE1E6">
    <?php include 'navigation.php'; ?>
    <table class="table table-bordered table-hover" style="background:#F3F3F3">
        <thead class="table-light">
        <tr>
            <br>
                <th scope="col"><p>#</p></th>
                <th scope="col"><p>ID</p></th>
                <th scope="col"><p>Vardas</p></th>
                <th scope="col"><p>Pavardė</p></th>
                <th scope="col"><p>Sąskaitos likutis</p></th>
                <th scope="col"><p>Veiksmai</p></th>                
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
                        <td><?= '€' . ' ' . $readAccount[$key]['suma'] ?></td>
                        <td>
                            <form action="http://localhost/nd/nd_8/nuskaitytiLesas.php" method="post">
                                <label for="skaiciai">Įveskite sumą: </label>
                                <input type="number" name="skaiciai" min="0" value="" id="">
                                <button class="btn btn-outline-primary btn-sm" type="submit" name="nuskaitytiLesas" value="<?= $value['accountId'] ?>">Nuskaityti lėšas</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>

    <?php include 'footer.php' ?>

</body>

</html>