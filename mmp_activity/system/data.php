<?php

function get_db_connection(){

	global $db_host, $db_name, $db_user, $db_pass, $db_charset;

	$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset"; // siehe https://en.wikipedia.org/wiki/Data_source_name
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false
	];
	try {
		$db = new PDO($dsn, $db_user, $db_pass, $options);
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}
	return $db;
}

// ********************************************************


// function selektiere_alle_rezepte(){
// 	$db = get_db_connection();
// 	$sql = 	"SELECT * FROM rezepte;";
// 	$result = $db->query($sql);
// 	return $result->fetchAll();
// }
//
//
// function selektiere_rezept_anhand_id($id){
// 	$db = get_db_connection();
// 	$sql = 	"SELECT * FROM rezepte WHERE rezept_id = $id;";
// 	$result = $db->query($sql);
// 	return $result->fetch();
//
// }
//
//
// function anmelden($email, $passwort){
// 	$db = get_db_connection();
// 	$sql = 	"SELECT * FROM autor WHERE email='$email' AND passwort='$passwort';";
// 	$result = $db->query($sql);
// 	if($result->rowCount() == 1){
// 		$row = $result->fetch();
// 		return $row;
// 	}else{
// 		return false;
// 	}
// }
//
// function selektiere_autor_anhand_id($id){
// 	$db = get_db_connection();
// 	$sql = 	"SELECT * FROM autor WHERE autor_id = $id;";
// 	$result = $db->query($sql);
// 	return $result->fetch();
// }
//
//
// function rezeptdaten_eintragen($titel, $beschreibung, $autor_id){
// 	$db = get_db_connection();
// 	$sql = "INSERT INTO rezepte (titel, beschreibung, autor_id) VALUES (?,?,?);";
// 	$stmt = $db->prepare($sql);
// 	return $stmt->execute(array($titel, $beschreibung, $autor_id));
// }
//
//
// function rezeptdaten_aktualisieren($titel, $beschreibung, $rezept_id){
// 	$db = get_db_connection();
// 	$sql = "UPDATE rezepte SET titel=?, beschreibung=?  WHERE rezept_id =?;";
// 	$stmt = $db->prepare($sql);
// 	return $stmt->execute(array($titel, $beschreibung, $rezept_id));
// }
//
//
// function rezeptdaten_entfernen($rezept_id){
// 	$db = get_db_connection();
// 	$sql = "DELETE FROM rezepte WHERE rezept_id = ?;";
// 	$stmt = $db->prepare($sql);
// 	return $stmt->execute(array($rezept_id));
// }
//
// function registrieren($vorname, $nachname, $email, $passwort){
// 	$db = get_db_connection();
// 	$sql ="INSERT INTO autor (vorname, nachname, email, passwort) VALUES (?,?,?,?);";
// 	$stmt = $db->prepare($sql);
// 	return $stmt->execute(array($vorname, $nachname, $email, $passwort));
//
// }
//
//
// function does_email_exist($email){
// 	$db = get_db_connection();
// 	$sql ="SELECT * FROM autor WHERE email = '$email';";
// 	$result = $db->query($sql);
// 	if($result->rowCount() > 0){
// 		return true;
// 	}else{
// 		return false;
// 	}
// }
