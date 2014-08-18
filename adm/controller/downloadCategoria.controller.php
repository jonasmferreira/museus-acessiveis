<?php
$path_root_downloadCategoriaController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_downloadCategoriaController = "{$path_root_downloadCategoriaController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_downloadCategoriaController}adm{$DS}class{$DS}downloadCategoria.class.php";
$obj = new downloadCategoria();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "downloadCategoriaEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['download_categoria_id']) && trim($_POST['download_categoria_id'])!=''){
			if($exec['success']){
				$msg = "Atualizado com Sucesso!";
				$url = "{$volta}?download_categoria_id={$_POST['download_categoria_id']}";
			}else{
				$msg = "Erro ao atualizar!";
				$url = "{$volta}?download_categoria_id={$_POST['download_categoria_id']}";
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
	case 'deleteItem':
		$obj->setValues($_REQUEST);
		$exec = $obj->deleteItem();
		if($exec['success']){
			$msg = "CMD_SUCCESS|Item excluido com sucesso!";
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

