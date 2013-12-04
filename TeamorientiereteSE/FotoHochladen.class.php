<?php

require_once("FahrzeugInfo.class.php");

class FotoHochladen {
	
	public static $CONTENT_ID = "FotosHochladen";
 	
	private static $SUBMIT_KEY = "upload";

	public static $ARTIKEL_NR = "FahrzeugNr";
	
	private $statusText;
	
	public function doAction() {
		
		if (array_key_exists(self::$SUBMIT_KEY, $_REQUEST)) {
		
			$nr = $_REQUEST[self::$ARTIKEL_NR];
			
			$kfz = new FahrzeugInfo();
			$kfz->laden2($nr);
			$uploadDir ="uploads/";
			
			

$foto1 = $_FILES['foto1'];
$err = $foto1['error'];
$name1 = $foto1['name'];
// mit $id als Prim‰rschl¸ssel des zugehˆrigen Datensatzes
// und $uploadDir als Ablageordner f¸r hochgeladene Dateien
$pathInfo = pathinfo($name1);
$newPath = $uploadDir . $nr . "_1." . $pathInfo['extension']; 
//print $foto1['tmp_name'] . " => " . $newPath . "<br>";

if ($err == 0) {
move_uploaded_file($foto1['tmp_name'], $newPath);
$this->statusText = sprintf("Das Bild zu Fahrzeug '%s' wurde erfolgreich hochgeladen!<br>", $kfz);
$kfz->upload1($nr, $newPath);		
// speichern das Pfads zur hochgeladenen Datei in der DB
 
		// Folgende Fehler kˆnnen auftreten:
} elseif ($err == 1) {
	$this->statusText =sprintf("Das Bild ist zu groﬂ!<br>");
// Datei ist grˆﬂer als laut PHP.ini erlaubt
} elseif ($err == 2) {
	$this->statusText =sprintf("Die Datei ist zu groﬂ!<br>");
// Datei ist grˆﬂer als von MAX_FILE_SIZE im Formular erlaubt
} elseif ($err == 3) {
	$this->statusText =sprintf("Das Bild zu Fahrzeug '%s' konnte nur teilweise hochgeladen werden!<br>", $kfz);
// Die Datei wurde nur teilweise hochgeladen
} elseif ($err == 4) {
	$this->statusText =sprintf("Es wurde keine Datei hochgeladen!<br>");
// es wurde keine Datei hochgeladen
}

// Wiederholte Prozedur f¸r Çfoto2ë
$foto2 = $_FILES['foto2'];
$err = $foto2['error'];
$name2 = $foto2['name'];
// mit $id als Prim‰rschl¸ssel des zugehˆrigen Datensatzes
// und $uploadDir als Ablageordner f¸r hochgeladene Dateien
$pathInfo = pathinfo($name2);
$newPath = $uploadDir . $nr . "_2." . $pathInfo['extension'];
//print $foto2['tmp_name'] . " => " . $newPath . "<br>";
// pathinfo($name2) ['extension'];
if ($err == 0) {
move_uploaded_file($foto2['tmp_name'], $newPath);
$this->statusText = sprintf("Das Bild zu Fahrzeug '%s' wurde erfolgreich hochgeladen!<br>", $kfz);
$kfz->upload2($nr, $newPath);		
// speichern das Pfads zur hochgeladenen Datei in der DB

	// Folgende Fehler kˆnnen auftreten:
} elseif ($err == 1) {
	$this->statusText =sprintf("Das Bild ist zu groﬂ!<br>");
// Datei ist grˆﬂer als laut PHP.ini erlaubt
} elseif ($err == 2) {
	$this->statusText =sprintf("Die Datei ist zu groﬂ!<br>");
// Datei ist grˆﬂer als von MAX_FILE_SIZE im Formular erlaubt
} elseif ($err == 3) {
	$this->statusText =sprintf("Das Bild zu Fahrzeug '%s' konnte nur teilweise hochgeladen werden!<br>", $kfz);
// Die Datei wurde nur teilweise hochgeladen
} elseif ($err == 4) {
	$this->statusText =sprintf("Es wurde keine Datei hochgeladen!<br>");
// es wurde keine Datei hochgeladen
}
	$foto3 = $_FILES['foto3'];
$err = $foto3['error'];
$name3 = $foto3['name'];
// mit $id als Prim‰rschl¸ssel des zugehˆrigen Datensatzes
// und $uploadDir als Ablageordner f¸r hochgeladene Dateien
$pathInfo = pathinfo($name3);
$newPath = $uploadDir . $nr . "_3." . $pathInfo ['extension'];
//print $foto3['tmp_name'] . " => " . $newPath . "<br>";
//pathinfo($name3)['extension'];
if ($err == 0) {
move_uploaded_file($foto3['tmp_name'], $newPath);
$this->statusText = sprintf("Das Bild zu Fahrzeug '%s' wurde erfolgreich hochgeladen!<br>", $kfz);
$kfz->upload3($nr, $newPath);		
// speichern das Pfads zur hochgeladenen Datei in der DB

	// Folgende Fehler kˆnnen auftreten:
} elseif ($err == 1) {
	$this->statusText =sprintf("Das Bild ist zu groﬂ!<br>");
// Datei ist grˆﬂer als laut PHP.ini erlaubt
} elseif ($err == 2) {
	$this->statusText =sprintf("Die Datei ist zu groﬂ!<br>");
// Datei ist grˆﬂer als von MAX_FILE_SIZE im Formular erlaubt
} elseif ($err == 3) {
	$this->statusText =sprintf("Das Bild zu Fahrzeug '%s' konnte nur teilweise hochgeladen werden!<br>", $kfz);
// Die Datei wurde nur teilweise hochgeladen
} elseif ($err == 4) {
	$this->statusText =sprintf("Es wurde keine Datei hochgeladen!<br>");
// es wurde keine Datei hochgeladen
}

		}
	}
		

	
	public function getStatusText() {
		return $this->statusText;
	}
	
	public function __toString() {

		$kfz = new FahrzeugInfo();
		$kfz->laden2($_REQUEST[self::$ARTIKEL_NR]);
		
		$htmlStr = "<form method='post' action ='index.php' enctype='multipart/form-data'>";
		$htmlStr .= sprintf("Foto hochladen zum Fahrzeug '%s' !<br>",
								$kfz);
		$htmlStr .= sprintf("Foto1: <input type='file' name='foto1' /><br>"); 
		$htmlStr .= sprintf("<input type='hidden' name='%s' value='%s'>", 
								self::$ARTIKEL_NR, $kfz->getNr());
		
		$htmlStr .= sprintf("Foto2: <input type='file' name='foto2' /><br>"); 
		$htmlStr .= sprintf("Foto3: <input type='file' name='foto3' /><br>"); 
		$htmlStr .=sprintf("<input type='submit' name='%s' value='hochladen'/>", self::$SUBMIT_KEY);
		$htmlStr .= "<input type='hidden' name='MAX_FILE_SIZE' value='5000000'/>";
		
		$htmlStr .= "</form>";

		return $htmlStr;
	}
	
	
}





