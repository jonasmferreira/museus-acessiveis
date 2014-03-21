<?php
	$path_root_loginPage = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_loginPage = "{$path_root_loginPage}{$DS}..{$DS}";
	require_once "{$path_root_loginPage}adm{$DS}class{$DS}login.class.php";
	$obj = new login();
	$obj->verifyLogon();
	
	$session = $obj->getSessions();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Painel Administrativo - Dashboard</title>
		<link href="admstyle.css" type="text/css" media="screen" rel="stylesheet" />
		<link href="../plugins/css/south-street/jquery-ui-1.10.4.custom.min.css" type="text/css" rel="stylesheet" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<script src="../plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="../plugins/jquery-migrate.js" type="text/javascript"></script>
		<script src="../plugins/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
		<script src="../plugins/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/utils.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
	</head>
	<body>
		<?php
			$erro = $session['erro'];
			if(trim($erro)!=""){
				$obj->alert($erro);
				$aErro['erro'] =  $erro;
				$obj->unRegisterSession($aErro);
			}
		?>
		<div id="wrapperLogin">
			<img src="imgs/logo_contrast.png" width="230" />
			<hr />
			<form name="frmlogin" id="frmlogin" method="post" action="controller/login.controller.php">
				<input type="hidden" name="action" id="action" value="login" />
				<p><input type="text" name="user" id="user" maxlength="32" placeholder="Login" class="obrigatorio formTxt login" /></p>
				<p><input type="password" id="pass" name="pass" placeholder="Senha" class="obrigatorio formTxt login" /></p>
				<p><input type="button" id="enviar" value="Entrar" class="butEntrar" /></p>
			</form>
		</div>
	</body>
</html>
