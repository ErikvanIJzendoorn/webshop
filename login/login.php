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

	<link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
  <form action="../database/login.php" method="post">
  <div class="row reg z-depth-5 log">
    <div class="row">
      <div class="input-field col s3 offset-s4">
        <input placeholder="Naam" name="naam" type="text" required>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s3 offset-s4">
        <input placeholder="Wachtwoord" name="wachtwoord" type="password" required>
      </div>
    </div>
    <div class="row">
    <div class="col s4 offset-s4">
      <button class="btn" type="submit" name="action">Inloggen
        <i class="material-icons right">send</i>
      </button>
    </div>
    </div>
  </div>
</form>
</div>
</body>
</html>