<?php
$path_root_ltic = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_ltic = "{$path_root_ltic}{$DS}..{$DS}";
require_once "{$path_root_ltic}lib{$DS}phpMailler{$DS}class.phpmailer.php";
class emailClass {
	protected $hostEmail = "anjomob.com.br";
	protected $smtpUsuario = "admin@anjomob.com.br";
	protected $smtpSenha = "cat200200";
	protected $emailUsuario = "admin@anjomob.com.br";
	protected $emailNomeUsuario = "Gestão AnjoMob";
	protected $assunto = "AnjoMob";
	public $conteudo = "";
	protected $dbConn = null;
	protected $url_log;
	protected $url_log_error;
	protected $show_log = true;
	protected $show_log_screen = true;
	protected $enviaEmailCC = null;


	public function __construct() {
		//$this->config();
	}

	public function setAssunto($assunto) {
		$this->assunto = $assunto;
	}

	public function setEnviaEmailCC($enviaEmailCC) {
		$this->enviaEmailCC = $enviaEmailCC;
	}

	
	public function config() {
		$this->mail = new PHPMailer();
		$this->mail->IsSMTP();
		$this->mail->Host = "{$this->hostEmail}";
		$this->mail->SMTPDebug = true;
		$this->mail->SMTPAuth = true;
		$this->mail->CharSet = 'utf-8';
		$this->mail->Port = 26;
		$this->mail->Username = "{$this->smtpUsuario}";
		$this->mail->Password = "{$this->smtpSenha}";
		$this->mail->SetFrom("{$this->emailUsuario}", $this->emailNomeUsuario);
	}

	public function codetoText($textTo){
		if(mb_detect_encoding($textTo."x", 'UTF-8, ISO-8859-1') == 'UTF-8'){
			return utf8_decode($textTo);
		}else{
			return $textTo;
		}
	}

	public function utf8Encode2Decode($string)
	{
		if(strtoupper(mb_detect_encoding($string."x", 'UTF-8, ISO-8859-1')) == 'UTF-8'){
			return $string;
		}else{
			return utf8_encode($string);
		}
	}

	public function enviaEmail($aEmail) {
		$this->mail = new PHPMailer();
		$this->mail->IsSMTP();
		$this->mail->Host = "{$this->hostEmail}";
		$this->mail->SMTPDebug = true;
		$this->mail->SMTPAuth = true;
		$this->mail->CharSet = 'utf-8';
		$this->mail->Port = 26;
		$this->mail->Username = "{$this->smtpUsuario}";
		$this->mail->Password = "{$this->smtpSenha}";
		$this->mail->SetFrom("{$this->emailUsuario}", $this->emailNomeUsuario);
		$body = htmlspecialchars_decode($this->utf8Encode2Decode($this->conteudo));
		$this->mail->Subject = htmlspecialchars_decode($this->utf8Encode2Decode($this->assunto));
		$bPulaoPrimeiro = false;
		$this->mail->AddAddress($this->emailNomeUsuario,$this->smtpUsuario);
		if(is_array($aEmail)&&count($aEmail)>0){
			foreach($aEmail AS $v){
				$this->mail->AddAddress($v['email'],$v['nome']);
			}
		}
		$this->mail->MsgHTML($body);
		if(!$this->mail->Send()){
			$this->mail->ClearAddresses();
			$this->mail->ClearCCs();
			return false;
		}else{
			$this->mail->ClearAddresses();
			$this->mail->ClearCCs();
			return true;
		}
		
	}
}
?>
