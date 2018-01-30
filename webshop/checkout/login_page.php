<!DOCTYPE html>
<html>
<head>
<head>
<meta charset="utf-8">
  <title>Klanten login</title>
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

<body>
<div class="row margin">
  <div class="col s4 offset-s2 wrap">
    <form action="../database/login.php" method="post" class="form">
      <div class="row">
        <span class="titel"><strong>Inloggen</strong></span>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <?php
            // Als er een bestaand email is opgegeven 
            if (isset($_GET['email'])) {
              ?><input value="<?=$_GET['email'];?>" id="email" type="text" name="Email" required><?php
            }
            else{
              // Zoniet vraag dan naar een email
              ?><input placeholder="Email" id="email" type="text" name="Email" required><?php
            }
          ?>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Wachtwoord" id="wachtwoord" type="password" name="Wachtwoord" required>
          <label for="wachtwoord">Wachtwoord</label>
        <div class="input-field col s12">
          <button class="btn but waves-effect waves-light" type="submit" name="action">Inloggen</button>
        </div>
      </div>
    </div>
    </form>
  </div>
  <div class="col s4 wrap">
    <!-- Als email al gebruikt is inloggen met dat email -->
    <form action="../database/register.php?register=1" method="post" class="form" id="reg_form">
      <div class="row">
      <span class="titel"><strong>Registreren</strong></span>
      </div>
      <div class="row">
        <div class="input-field col s6">
            <input placeholder="Email" id="email" type="text" name="email" required>
            <label for="email">Email</label>
        </div>
      </div>
    </form>
      <div class="col s12">
        <div class="input-field col s12">
          <button class="btn but reg_button" type="submit" value="Submit" form="reg_form">Registreren</button>
        </div>
      </div>
      <div class="col s12">
        <div class="input-field col s12">
          <a href="gast_page.php" class="btn but">Verder gaan als gast</a>
        </div>
      </div>
  </div>
</div>
</body>
</html>