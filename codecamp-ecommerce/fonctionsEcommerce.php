<?php 

include("connectEcommerce.php");


function pourcentage($nombre) {
	return $nombre*0.2;
}

function traiteTexte($texte) {
	global $link;
	if (get_magic_quotes_gpc()) $texte = stripslashes($texte);
	return trim(mysqli_real_escape_string($link, $texte));
}

/**
 * 
 * Adaptation : ajout des balises classiques pour de début et fin de page pour n'envoyer que le contenu
 * Exemple d'utilisation : mailHTML(array('to_name'=>'Pour nom', 'to_email'=>'eblazeix@asptt.com', 'from_name'=>'De la part de EB', 'from_email'=>'eblazeix@asptt.com', 'subject'=>'Objet mail', 'message'=>"<p>J'ai simplement écrit ma partie ici en <b>gras</b>.</p>"));
 *
 */

function mailHTML($arr) {
	if (!isset($arr['to_email'], $arr['from_email'], $arr['subject'], $arr['message'])) {
		throw new HelperException('mail(); not all parameters provided.');
	}

	$to          = empty($arr['to_name']) ? $arr['to_email'] : '"' . mb_encode_mimeheader($arr['to_name']) . '" <' . $arr['to_email'] . '>';
	$from        = empty($arr['from_name']) ? $arr['from_email'] : '"' . mb_encode_mimeheader($arr['from_name']) . '" <' . $arr['from_email'] . '>';

	$headers    = array
	(
			'MIME-Version: 1.0',
			'Content-Type: text/html; charset="UTF-8";',
			'Content-Transfer-Encoding: 7bit',
			'Date: ' . date('r', $_SERVER['REQUEST_TIME']),
			'Message-ID: <' . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . '>',
			'From: ' . $from,
			'Reply-To: ' . $from,
			'Return-Path: ' . $from,
			'X-Mailer: PHP v' . phpversion(),
			'X-Originating-IP: ' . $_SERVER['SERVER_ADDR'],
	);
	$message = '<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title></title>
</head>

<body style="margin:0; padding:0;">
'.$arr['message'].'

</body>
</html>';
	mail($to, '=?UTF-8?B?' . base64_encode($arr['subject']) . '?=', $message, implode("\n", $headers));
}



/**
 * 
 *
 * Adaptation : ajout des balises classiques pour de début et fin de page pour n'envoyer que le contenu
 * Exemple d'utilisation : mailHTML(array('to_name'=>'Pour nom', 'to_email'=>'eblazeix@asptt.com', 'from_name'=>'De la part de EB', 'from_email'=>'eblazeix@asptt.com', 'subject'=>'Objet mail', 'message'=>"<p>J'ai simplement écrit ma partie ici en <b>gras</b>.</p>", 'file'=>'fichierRemise.xml', 'file_name'=>'mandatSepa.xml'));
 *
 */
function mailHTMLfile($arr) {
	if (!isset($arr['to_email'], $arr['from_email'], $arr['subject'], $arr['message'])) {
		throw new HelperException('mail(); not all parameters provided.');
	}

	// Ajout de l'encodage interne pour que le deuxieme argument de mb_encode_mimeheader fonctionne.
	mb_internal_encoding("UTF-8");

	$to          = empty($arr['to_name']) ? $arr['to_email'] : '"' . mb_encode_mimeheader($arr['to_name'], "UTF-8") . '" <' . $arr['to_email'] . '>';
	$from        = empty($arr['from_name']) ? $arr['from_email'] : '"' . mb_encode_mimeheader($arr['from_name'], "UTF-8") . '" <' . $arr['from_email'] . '>';

	// Recuperation des variables de fichier
	if (isset($arr['file'], $arr['file_name'])) {
		$file = $arr['file'];
		$filename = $arr['file_name'];
	} else {
		$file = '';
		$filename = '';
	}

	// C'est un \n
	$eol = PHP_EOL;

	$separator = md5(time());




$message = '<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title></title>
</head>

<body style="margin:0; padding:0;">
'.$arr['message'].'

</body>
</html>';

	// Si on il n'y a pas de piece jointe on envoie le message de la meme maniere qu'avant directement dans la fonction mail sinon on envoie via les headers

	$message2 = $message;

	// On rajoute le fichier a envoyer en piece jointe dans le header si le fichier n'est pas vide
	if (!empty($file) && !empty($filename)) {
		$file_size = filesize($file);
		$handle = fopen($file, "r");
		$content = fread($handle, $file_size);
		fclose($handle);
		$content = chunk_split(base64_encode($content));

		$message2 = '';

		$headerContent = 'Content-Type: multipart/mixed; boundary=\"' . $separator . '\"';

		$headersMessage = '--' . $separator.$eol;
		$headersMessage .= 'Content-Type: text/html; charset="UTF-8";'.$eol;
		$headersMessage .= 'Content-Transfer-Encoding: 8bit'.$eol;
		$headersMessage .= $message.$eol;

		$headersFile = "--" . $separator.$eol;
		$headersFile .= 'Content-Type: application/octet-stream; name=\"' .$filename . '\"'.$eol;
		$headersFile .= "Content-Transfer-Encoding: base64".$eol;
		$headersFile .= "Content-Disposition: attachment".$eol;
		$headersFile .= $content.$eol;
		$headersFile .= "--" . $separator . "--";
	} else {
		$headersFile = '';
		$headersMessage = '';
		$headerContent = 'Content-Type: text/html; charset="UTF-8";';
	}

	$headers    = array
	(
			'MIME-Version: 1.0',
			$headerContent,
			'Content-Transfer-Encoding: 7bit',
			'Date: ' . date('r', $_SERVER['REQUEST_TIME']),
			'Message-ID: <' . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . '>',
			'From: ' . $from,
			'Reply-To: ' . $from,
			'Return-Path: ' . $from,
			'X-Mailer: PHP v' . phpversion(),
			'X-Originating-IP: ' . $_SERVER['SERVER_ADDR'],
				
			$headersMessage,
				
			$headersFile,
	);

	mail($to, '=?UTF-8?B?' . base64_encode($arr['subject']) . '?=', $message2, implode("\n", $headers));
}

function newMailHTML($To, $From, $Suject, $Message, $file) {
	$random_hash = md5(time());
	$file1 = $file;

	$to = $To;
	$subject = $Suject;
	$headers = "From: $From" . "\r\n" .
			"Reply-To: $From" . "\r\n" .
			'X-Mailer: PHP/' . phpversion() . "\r\n" .
			'Content-Type: multipart/mixed; boundary="PHP-mixed-'.$random_hash.'"';
	$attachment1 = chunk_split(base64_encode(file_get_contents($file1)));


	$message = <<<EMAIL_MESSAGE
--PHP-mixed-$random_hash
Content-Type: text/html; charset="iso-8859-1"; boundary="PHP-alt-$random_hash

$Message
--PHP-mixed-$random_hash
Content-Type: application/pdf; name="$file1"
Content-Transfer-Encoding: base64
Content-Disposition: attachment

$attachment1

--PHP-mixed-$random_hash--
EMAIL_MESSAGE;

mail($to, $subject, $message, $headers);

}



?>