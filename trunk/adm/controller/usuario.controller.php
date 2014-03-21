<?php
$path_root_UsuarioController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_UsuarioController = "{$path_root_UsuarioController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_UsuarioController}adm{$DS}class{$DS}usuario.class.php";
$obj = new usuario();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "usuarioEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$exec = $obj->edit();
		if(isset($_POST['usuario_id']) && trim($_POST['usuario_id'])!=''){
			if($exec['success']){
				$msg = "Usuario Atualizado com Sucesso!";
				$url = "{$volta}?usuario_id={$_POST['usuario_id']}";
			}else{
				$msg = "Erro ao atualizar o usuario!";
				$url = "{$volta}?usuario_id={$_POST['usuario_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Usuario Cadastrado com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar o usuario!";
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