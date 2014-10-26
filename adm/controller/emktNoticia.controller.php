<?php
$path_root_emktNoticiaController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_emktNoticiaController = "{$path_root_emktNoticiaController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_emktNoticiaController}adm{$DS}class{$DS}emktNoticia.class.php";
$obj = new emktNoticia();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "emktNoticiaEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['emkt_noticia_id']) && trim($_POST['emkt_noticia_id'])!=''){
			if($exec['success']){
				$msg = "Dados atualizados com sucesso!";
				$url = "{$volta}?emkt_noticia_id={$_POST['emkt_noticia_id']}";
			}else{
				$msg = "Erro ao atualizar!";
				$url = "{$volta}?emkt_noticia_id={$_POST['emkt_noticia_id']}";
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

