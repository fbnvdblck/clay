<?php
/**
 * @author Fabien Vanden Bulck <fabien@elhena.com>
 */

namespace Clay\Mailing;
 
class Mailer {

	// Attributes
	private $destinationAddresses;
	private $senderName;
	private $senderAddress;
	private $attachments;
	private $mimeVersion;
	private $mailType;
	private $contentType;
	private $contentTransferEncoding;
	private $boundary;
	private $charset;
	private $subject;
	private $message;
	private $headers;
	 
	// Constructeur
	public function __construct($senderName, $senderAddress, $subject, $attachment = false) {	
		if ($this->checkEmail($senderAddress))
			$this->senderAddress = $senderAddress;
		else
			throw new \Exception("The sender's e-mail is incorrect");
		
		$this->senderName = $senderName;
		$this->subject = $subject;	
		$this->destinationAddresses = array();
		$this->attachments = array();
		$this->mimeVersion = "1.0";
		$this->contentType = "text/plain";
		$this->charset = "iso-8859-1";
		$this->contentTransferEncoding = "8bit";
		 
		if ($attachment) {
			$this->boundary = md5(uniqid(microtime(), true));
			$this->mailType = "multipart/mixed; boundary=\"--" . $this->boundary . "\"\r\n";
		}
	}
	
	// Méthodes : Encapsulation
	// Getters
	public function getDestinationAddresses() {
		return $this->destinationAddresses;
	}
	
	public function getSenderName() {
		return $this->senderName;
	}
	
	public function getSenderAddress() {
		return $this->senderAddress;
	}
	
	public function getMimeVersion() {
		return $this->mimeVersion;
	}
	
	public function getContentType() {
		return $this->contentType;
	}
	
	public function getContentTransferEncoding() {
		return $this->contentTransferEncoding;
	}
	
	public function getCharset() {
		return $this->charset;
	}
	
	public function getSubject() {
		return $this->subject;
	}
	
	public function getMessage() {
		return $this->message;
	}
	
	// Setters
	public function setSenderName($name) {
		$this->senderName = $name;
	}
	
	public function setSenderAddress($email) {
		if ($this->checkEmail($email))
			$this->senderAddress = $email;
		else
			throw new Exception("");
	}
		
	public function setMimeVersion($version) {
		$this->mimeVersion = $version;
	}
	
	public function setContentType($type) {
		$this->contentType = $type;
	}
	
	public function setContentTransferEncoding($encoding) {
		$this->contentTransferEncoding = $encoding;
	}
	
	public function setCharset($charset) {
		$this->charset = $charset;
	}
	
	// Méthode : Vérifier si au moins une pièce-jointe est présente
	private function attachmentsEnabled() {
		if (count($this->attachments) > 0)
			return true;
		else
			return false;
	}
	
	// Méthode : Activer le format HTML
	public function enableHTML()
	{
		$this->contentType = "text/html";
	}

	// Méthode : Ajouter une adresse destinataire
	public function addRecipient($email)
	{
		if ($this->checkEmail($email))
			array_push($this->destinationAddresses, $email);
			
		else
			throw new Exception("The new e-mail passed is incorrect");
	}
			
	// Méthode : Ajouter la liste d'adresses destinataire
	public function addRecipientArray($array)
	{
		if (is_array($array))
		{
			foreach ($array as $data)
			{
				if ($this->checkEmail($data))
					array_push($this->destinationAddresses, $data);
			}
		}

		else
			throw new Exception("The argument isn't an array");
	}
	
	// Méthode : Charger un message
	public function load($data)
	{
		$this->message = $data;
	}
	
	// Méthode : Charger un message depuis un fichier texte
	public function loadFromFile($url)
	{
		if (file_exists($url))
		{
			$fichier = fopen($url, "r");
			$data = fgets($fichier, 255);
			fclose($fichier);
			
			$this->message = $data;
		}
		
		else
			throw new Exception("The file doesn't exist");
	}
	
	public function addAttachment($url)
	{
		if (file_exists($url))
		{
			array_push($this->attachments, $url);
		}
		
		else
			throw new Exception("The file doesn't exist");
	}
	
	// Méthode : Vérifier le format de l'adresse électronique
	private function checkEmail($email)
	{
		if (preg_match("#^[a-z0-9._-]+@[a-z]{3,}[.][a-z]{2,4}$#", $email))
			return true;
		else
			return false;
	}
	
	// Méthode : Envoyer l'e-mail
	public function send()
	{
		// En-tête
		$this->headers = "From: " . $this->senderName . " <" . $this->senderAddress . ">\r\n";
		$this->headers .= "Mime-Version: " . $this->mimeVersion . "\r\n";
		
		if ($this->attachmentsEnabled())
			$this->headers .= "Content-Type: " . $this->mailType;
		else
			$this->headers .= "Content-Type: " . $this->contentType ."; charset=" . $this->charset . "\r\n";
		
		// Message		
		if ($this->attachmentsEnabled())
		{		
			$msg = "----" . $this->boundary . "\r\n";
			$msg .= "Content-Type: " . $this->contentType . "; charset=" . $this->charset . "\r\n";
			$msg .= "Content-Transfer-Encoding: " . $this->contentTransferEncoding . "\r\n";
			$msg .= "\r\n" . $this->message . "\r\n";
			
			foreach ($this->attachments as $att)
			{
				$fichier = file_get_contents($att);
				$msg .= "\r\n----" . $this->boundary . "\r\n";
				$msg .= "Content-Type: " . mime_content_type($att) . "; name=\"" . $att . "\"\r\n";
				$msg .= "Content-Transfer-Encoding: base64\r\n";
				$msg .= "Content-Disposition: attachment; filename=\"" . $att . "\"\r\n";
				$msg .= "\r\n" . chunk_split(base64_encode($fichier)) . "\r\n";
			}
			
			$this->message = $msg;	
		}

		// Envoi
		if ((strlen($this->subject) >= 5) && (strlen($this->message) >= 10))
		{
			foreach ($this->destinationAddresses as $dest)
			{
				if (!mail($dest, $this->subject, $this->message, $this->headers))
					throw new Exception("An error has occured during sending e-mail, please check your configuration");
			}
		}
		
		else
			throw new Exception("The subject or the message is empty or is too short");
	}
}
?>
