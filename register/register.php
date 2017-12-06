<!DOCTYPE html>
<html style="background-color: #616161">
<head>
<meta charset="utf-8">
	<title>Register</title>
	<link rel="stylesheet" href="../materialize/css/materialize.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script rel="materialize" src="../materialize/js/materialize.min.js"></script>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" href="../js/materialize.js"></script>

	<link rel="stylesheet" href="register.css">
</head>
<body>
<form action="../database/register.php" method="post">
    <div class="container reg z-depth-5">
      <div class="row">
        <div class="input-field col s4 offset-s1">
          <input name="voornaam" type="text" required>
          <label for="voornaam">Voornaam</label>
        </div>
        <div class="input-field col s4 offset-s2">
          <input name="achternaam" type="text" required>
          <label for="achternaam">Achternaam</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4 offset-s1">
          <input name="wachtwoord" type="password" required>
          <label for="wachtwoord">Wachtwoord</label>
        </div>
        <div class="input-field col s4 offset-s2">
          <input name="email" type="email" class="validate" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s4 offset-s1">
          <input name="adres" type="text" required>
          <label for="adres">Adres</label>
        </div>
       </div>
       <div class="row">
        <div class="input-field col s4 offset-s1">
          <input name="postcode" type="text" required>
          <label for="postcode">Postcode</label>
        </div>
        <div class="input-field col s4 offset-s2">
          <input name="plaats" type="text" required>
          <label for="plaats">Plaats</label>
        </div>
      </div>
      <div class="row">
	      <div class="col s4 offset-s8">
	      	<button class="btn" type="submit" name="action">Aanmelden
		    	<i class="material-icons right">send</i>
		  	</button>
	      </div>
  	   </div>
    </form>
  </div>
</body>
</html>