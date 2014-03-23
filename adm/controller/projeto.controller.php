<?php
$path_root_ProjetoController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_ProjetoController = "{$path_root_ProjetoController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_ProjetoController}adm{$DS}class{$DS}projeto.class.php";
$obj = new projeto();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "projetoEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['projeto_id']) && trim($_POST['projeto_id'])!=''){
			if($exec['success']){
				$msg = "Projeto Atualizado com Sucesso!";
				$url = "{$volta}?projeto_id={$_POST['projeto_id']}";
			}else{
				$msg = "Erro ao atualizar o projeto!";
				$url = "{$volta}?projeto_id={$_POST['projeto_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Projeto Cadastrado com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar o projeto!";
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