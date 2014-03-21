<?php
$path_root_acessibilidadeClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_acessibilidadeClass = "{$path_root_acessibilidadeClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_acessibilidadeClass}adm{$DS}class{$DS}acessibilidade.class.php";
$obj = new acessibilidade();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "acessibilidadeEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['texto_id']) && trim($_POST['texto_id'])!=''){
			if($exec['success']){
				$msg = "Conteudo atualizado com Sucesso!";
				$url = "{$volta}?texto_id={$_POST['texto_id']}";
			}else{
				$msg = "Erro ao atualizar o conteudo!";
				$url = "{$volta}?texto_id={$_POST['texto_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Cadastrado com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar!";
				$url = "{$volta}";
			}
		}
		$obj->registerSession(array('erro'=>$msg));
		header("Location: ../{$url}");
	break;
}

