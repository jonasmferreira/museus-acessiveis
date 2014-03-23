<?php
$path_root_novidadeController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_novidadeController = "{$path_root_novidadeController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_novidadeController}adm{$DS}class{$DS}novidade.class.php";
$obj = new novidade();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "novidadeEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['novidade_360_id']) && trim($_POST['novidade_360_id'])!=''){
			if($exec['success']){
				$msg = "Dados atualizados com sucesso!";
				$url = "{$volta}?novidade_360_id={$_POST['novidade_360_id']}";
			}else{
				$msg = "Erro ao atualizar!";
				$url = "{$volta}?novidade_360_id={$_POST['novidade_360_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Cadastro bem sucedido!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar!";
				$url = "{$volta}";
			}
		}
		$obj->registerSession(array('erro'=>$msg));
		header("Location: ../{$url}");
	break;
	case 'deleteItem':
		$obj->setValues($_REQUEST);
		$exec = $obj->deleteItem();
		if($exec['success']){
			$msg = "CMD_SUCCESS|Item Excluido com Sucesso!";
		}else{
			$msg = "CMD_FAILED|Não é possivel excluir!";
		}
		echo $msg;
	break;
	case 'getLista':
		$obj->setValues($_REQUEST);
		$aResult = $obj->getLista();
		echo json_encode($aResult);
	break;
}