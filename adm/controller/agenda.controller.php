se<?php
$path_root_AgendaController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_AgendaController = "{$path_root_AgendaController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_AgendaController}adm{$DS}class{$DS}agenda.class.php";
$obj = new agenda();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "agendaEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['agenda_id']) && trim($_POST['agenda_id'])!=''){
			if($exec['success']){
				$msg = "Agenda Atualizada com Sucesso!";
				$url = "{$volta}?agenda_id={$_POST['agenda_id']}";
			}else{
				$msg = "Erro ao atualizar a agenda!";
				$url = "{$volta}?agenda_id={$_POST['agenda_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Agenda Cadastrada com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar a agenda!";
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
	case 'removeImage':
		$obj->setValues($_REQUEST);
		$exec = $obj->removeImage();
		if($exec['success']){
			$msg = "CMD_SUCCESS|Imagem Removida com Sucesso!";
		}else{
			$msg = "CMD_FAILED|Não é possivel remover a imagem!";
		}
		echo $msg;
	break;
}