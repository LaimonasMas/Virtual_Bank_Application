<?php
session_start();
require __DIR__ . '/bootstrap.php';

// LOGOUT scenarijus
if (isset($_GET['name'])) {
    //keli budai
    // $_SESSION['login'] = 0;
    // unset($_SESSION['user']);
    // kitas
    session_destroy();
    header('Location: http://localhost/nd/nd_8/login/login.php');
    die;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginName']) && isset($_POST['loginPass'])) {
    $_SESSION = $_POST;
if (!file_exists('http://localhost/nd/nd_8/login/users.json')) {
    include 'migration.php';
}
    $users = file_get_contents(__DIR__.'/users.json');
    $users = json_decode($users, 1);

    $postName = $_POST['loginName'] ?? '';
    $postPass = $_POST['loginPass'] ?? '';

    foreach ($users as $user) {
        if ($postName == $user['name']) { // <--- turim useri
            if (password_verify($postPass, $user['pass'])) { // <--- viskas OK
                 // sugalvojam kad 1 reiks prisijungusi vartotoja
                //  o 0 reiks neprisijungusi
                $_SESSION['login'] = 1;
                $_SESSION['user'] = $user;
                header('Location: http://localhost/nd/nd_8/index.php');
                die;
            }
        }
    }
    // $_SESSION['error_msg'] = 'Password or Name is invalid.';
    // header('Location: http://localhost/nd/nd_8/login/login.php');
    // die;
}


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
    <table class="table table-bordered table-hover" style="background:#F3F3F3">
        <thead class="table-light">
            <tr>
                <th scope="col">Įrašykite vartotojo vardą ir slaptažodį</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <form action="http://localhost/nd/nd_8/login/login.php" method="post">

                        <label style="display:inline-block; margin-left: 15px" for="">Vartotojo vardas: </label>
                        <input style="display:inline-block; margin:10px 30px 10px 5px" type="text" name="loginName">
                        <label style="display:inline-block; margin-left: 15px" for="">Spaltažodis: </label>
                        <input style="display:inline-block; margin:10px 30px 10px 5px" type="text" name="loginPass">
                        <button class="btn btn-outline-success btn-sm" type="submit" name="loginButton" value="1">Prisijungti</button>

                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <?php include 'footer.php' ?>

</body>

</html>