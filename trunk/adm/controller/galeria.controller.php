<?php
$path_root_galeriaController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_galeriaController = "{$path_root_galeriaController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_galeriaController}adm{$DS}class{$DS}galeria.class.php";

$obj = new galeria();

switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "galeriaEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['galeria_id']) && trim($_POST['galeria_id'])!=''){
			if($exec['success']){
				$msg = "Cadastro atualizado com sucesso!";
				$url = "{$volta}?galeria_id={$_POST['galeria_id']}";
			}else{
				$msg = "Erro ao atualizar dados!";
				$url = "{$volta}?galeria_id={$_POST['galeria_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Cadastro realizado com sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar dados!";
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

	case 'deleteImagem':
		$obj->setValues($_REQUEST);
		$exec = $obj->deleteImagem($_REQUEST['galeria_imagem_id']);
		if($exec['success']){
			$msg = "CMD_SUCCESS|Imagem Excluido com Sucesso!";
		}else{
			$msg = "CMD_FAILED|Não é possivel excluir!";
		}
		echo $msg;
	break;
}
