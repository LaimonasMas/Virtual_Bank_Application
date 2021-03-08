<?php if (isset($_SESSION['user']['status']) && $_SESSION['user']['status'] == 1) : ?>
<div style="height: 400px; background-image: url('img/1593762393592(2).jpg')" class="topnav">
  <img style="width:100px; float:left; margin-left:30px" src="img/logo.jpg" alt="">
  <a class="active" href="index.php">Pradžia</a>
  <a href="naujaSaskaita.php">Sukurti naują sąskaitą</a>
  <a href="saskaituSarasas.php">Sąskaitų sąrašas</a>
  <a href="pridetiLesas.php">Pridėti lėšų</a>
  <a href="nuskaitytiLesas.php">Nuskaityti lėšas</a>
  <a class="logout" name="logout" href="login/login.php?name=loggedOut">Atsijungti</a>
</div>
<?php elseif (isset($_SESSION['user']['status']) && $_SESSION['user']['status'] == 0) : ?>
  <div style="height: 400px; background-image: url('img/1593762393592(2).jpg')" class="topnav">
  <img style="width:100px; float:left; margin-left:30px" src="img/logo.jpg" alt="">
  <a class="active" href="index.php">Pradžia</a>
  <a href="saskaituSarasas.php">Sąskaitų sąrašas</a>
  <a href="pridetiLesas.php">Pridėti lėšų</a>
  <a href="nuskaitytiLesas.php">Nuskaityti lėšas</a>
  <a class="logout" name="logout" href="login/login.php?name=loggedOut">Atsijungti</a>
</div>
<?php else : ?>
  <div style="height: 400px; background-image: url('img/1593762393592(2).jpg')" class="topnav">
  <img style="width:100px; float:left; margin-left:30px" src="img/logo.jpg" alt="">
  <a class="active" href="index.php">Pradžia</a>
  <a href="naujaSaskaita.php">Sukurti naują sąskaitą</a>
  <a href="saskaituSarasas.php">Sąskaitų sąrašas</a>
  <a href="pridetiLesas.php">Pridėti lėšų</a>
  <a href="nuskaitytiLesas.php">Nuskaityti lėšas</a>
  <a class="logout" name="logout" href="login/login.php?name=loggedOut">Atsijungti</a>
</div>
<?php endif ?>