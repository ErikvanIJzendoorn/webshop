<?php
//Maak een saltcode aan met de volgende mogelijkheden
function generateSalt($pass) {
	$max = 12;
	$characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789=";
	$i = 0;
	$salt = "";
	while ($i < $max) {
	    $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
	    $i++;
	}
	return $salt;
}

function CreatePasswordHash($pass, $salt)
{
    $saltAndPwd = $pass . $salt;
    $hashedPwd = hash('sha512', $saltAndPwd);

    $hex_strs = str_split($hashedPwd,2);

    foreach($hex_strs as &$hex) {
        $hex = preg_replace('/[0]+/', '', $hex);
    }
    $hashedPwd = implode('', $hex_strs);

    return strtoupper($hashedPwd);
}

function checkPassword($pass)
{
	$hex_strs = str_split($pass,2);

    foreach($hex_strs as &$hex) {
        $hex = preg_replace('/[0]+/', '', $hex);
    }
    $hashedPwd = implode('', $hex_strs);

    return strtoupper($hashedPwd);
}


?>