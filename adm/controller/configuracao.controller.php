<?php
$path_root_ConfiguracaoController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_ConfiguracaoController = "{$path_root_ConfiguracaoController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_ConfiguracaoController}adm{$DS}class{$DS}configuracao.class.php";
$obj = new configuracao();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "configuracaoEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$exec = $obj->update();
		if($exec['success']){
			$msg = "Configurações Atualizadas com Sucesso!";
			$url = "{$volta}";
		}else{
			$msg = "Erro ao atualizar as configurações!";
			$url = "{$volta}";
		}
		
		$obj->registerSession(array('erro'=>$msg));
		header("Location: ../{$url}");
	break;
}