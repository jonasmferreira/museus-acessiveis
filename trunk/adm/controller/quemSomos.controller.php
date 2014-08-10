<?php
$path_root_quemSomosController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_quemSomosController = "{$path_root_quemSomosController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_quemSomosController}adm{$DS}class{$DS}quemSomos.class.php";
$obj = new quemSomos();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "quemSomosEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['quemsomos_id']) && trim($_POST['quemsomos_id'])!=''){
			if($exec['success']){
				$msg = "Cadastro Atualizado com Sucesso!";
				$url = "{$volta}?quemsomos_id={$_POST['quemsomos_id']}";
			}else{
				$msg = "Erro ao atualizar o cadastro!";
				$url = "{$volta}?quemsomos_id={$_POST['quemsomos_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Cadastrado realizado com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao realizar o cadastro!";
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