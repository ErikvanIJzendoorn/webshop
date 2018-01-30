<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title>Registratie</title>
  <link rel="stylesheet" href="../materialize/css/materialize.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script rel="materialize" src="../materialize/js/materialize.min.js"></script>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script type="text/javascript" href="../js/materialize.js"></script>
  <script type="text/javascript" src="../checkout/js/simpleCart.js"></script>
  <link rel="shortcut icon" type="image/png" href="../fotos/logo-axa.png"/>
  <link rel="stylesheet" href="checkout.css">
</head>

<header>
  <!-- Navbar -->
  <div class="row">
    <nav>
    <div class="nav-wrapper">
      <ul class="center">
        <li><a href="../shop/shop.php?filter=PrijsHL"  style="max-width: 150px; max-height: 100px;"><img src="../fotos/logo-axa.png" width="150" height="100" alt="Logo"></a></li>
      </ul>
      <ul class="right">
        <li><a class="nav_item" href="../shop/shop.php?filter=PrijsHL">Winkel</a></li>
        <li><a class="nav_item" href="../home/info.php">Home</a></li>
        <li><a class="nav_item" href="../checkout/admin_login.php">Administrator login</a></li>
      </ul>
    </div>
  </nav>
  </div>
</header>

<div class="container margin">
    <?php
      if(isset($_GET['register']))
      {
        if($_GET['register'] == 2)
        {
          ?>
            <form class="container" action="../database/register.php?register=2" method="post">
          <?php
        }else{
          ?>
            <form class="container" action="../database/register.php?register=3" method="post">
          <?php
        }
      }


    ?>


        <div class="row">
          <div class="input-field col s4">
            <input placeholder="Voornaam" id="Voornaam" type="text" name="Voornaam" required>
            <label for="Voornaam">Voornaam</label>
          </div>
          <div class="input-field col s4">
            <input placeholder="Achternaam" id="Achternaam" type="text" name="Achternaam" required>
            <label for="Achternaam">Achternaam</label>
          </div>
        </div>
        
        <div class="row">
          <div class="input-field col s6">
            <input placeholder="Wachtwoord" id="Wachtwoord" type="password" name="Wachtwoord" required>
            <label for="Wachtwoord">Wachtwoord</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <input placeholder="Adres" id="Adres" type="text" name="Adres" required>
            <label for="Adres">Adres</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
              <input placeholder="Postcode" id="Postcode" type="text" name="Postcode" required>
              <label for="Postcode">Postcode</label>
          </div>
          <div class="input-field col s6">
              <input placeholder="Plaats" id="Plaats" type="text" name="Plaats" required>
              <label for="Plaats">Plaats</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <input placeholder="Email" id="Email" type="text" name="Email" required>
            <label for="Email">Email</label>
          </div>
        </div>
        
        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light" type="submit" name="action">Account aanmaken</button>
          </div>
        </div>
    </form>
</div>

</body>
</html>