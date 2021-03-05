<?php
session_start();
require __DIR__ . '/bootstrap.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sukurti sąskaitą</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css?ver=<?= time() ?>">

    <style>
        input {
            display: block;
        }
    </style>
</head>

<body style="background:#DEE1E6">
    <?php include 'navigation.php' ?>
    <table class="table table-bordered table-hover" style="background:#F3F3F3">
        <thead class="table-light">
            <tr>
                <th scope="col">Sukurti naują sąskaitą</th>
                <th scope="col">Suteiktas sąskaitos numeris</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <form action="http://localhost/nd/nd_8/saskaituSarasas.php" method="post">
                        <label style="display:inline-block; margin-left: 15px" for="vardas">
                            <p>Vardas</p>
                        </label>
                        <input style="display:inline-block; margin:10px 30px 10px 5px" type="text" name="vardas" id="">
                        <label for="pavarde">
                            <p>Pavardė</p>
                        </label>
                        <input style="display:inline-block; margin:10px 30px 10px 5px" type="text" name="pavarde" id="">
                        <input style="display:inline-block; margin:10px 30px 10px 5px" type="hidden" name="saskaitosNumeris" value="<?= accountGenerator() ?>" id="">
                        <label for="asmensKodas">
                            <p>Asmens kodas</p>
                        </label>
                        <input style="display:inline-block; margin:10px 5px 10px 5px" type="text" name="asmensKodas" id="">
                        <input type="hidden" name="suma" value="0">
                        <input type="hidden" name="accountId" value="<?= readNextAccId() ?? 1 ?>">
                        <button class="btn btn-outline-success btn-sm" type="submit" name="newAccButton" value="1">Sukurti naują sąskaitą</button>
                    </form>
                </td>
                <td>
                <p><?php   if(isset($_SESSION['accNumberReadOnly']) && str_contains(file_get_contents(DIR . 'data/saskaitos.json'), $_SESSION['asmensKodas'])) { 
                    echo $_SESSION['accNumberReadOnly'];                  
                    } 
                    unset($_SESSION['accNumberReadOnly']);?></p>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>