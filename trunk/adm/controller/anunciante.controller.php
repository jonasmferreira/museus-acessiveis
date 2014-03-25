<?php
$path_root_AnuncianteController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_AnuncianteController = "{$path_root_AnuncianteController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_AnuncianteController}adm{$DS}class{$DS}anunciante.class.php";
$obj = new anunciante();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "anuncianteEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['anunciante_id']) && trim($_POST['anunciante_id'])!=''){
			if($exec['success']){
				$msg = "Anunciante Atualizado com Sucesso!";
				$url = "{$volta}?anunciante_id={$_POST['anunciante_id']}";
			}else{
				$msg = "Erro ao atualizar o anunciante!";
				$url = "{$volta}?anunciante_id={$_POST['anunciante_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Anunciante Cadastrado com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar o anunciante!";
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