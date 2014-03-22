<?php
$path_root_contatoTipoController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_contatoTipoController = "{$path_root_contatoTipoController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_contatoTipoController}adm{$DS}class{$DS}contatoTipo.class.php";
$obj = new contatoTipo();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "contatoTipoEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['contato_tipo_id']) && trim($_POST['contato_tipo_id'])!=''){
			if($exec['success']){
				$msg = "Atualizado com Sucesso!";
				$url = "{$volta}?contato_tipo_id={$_POST['contato_tipo_id']}";
			}else{
				$msg = "Erro ao atualizar!";
				$url = "{$volta}?contato_tipo_id={$_POST['contato_tipo_id']}";
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