<?php
$path_root_ExtraController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_ExtraController = "{$path_root_ExtraController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_ExtraController}adm{$DS}class{$DS}extra.class.php";
$obj = new extra();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "extraEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$exec = $obj->edit();
		if(isset($_POST['extra_id']) && trim($_POST['extra_id'])!=''){
			if($exec['success']){
				$msg = "Extra Atualizado com Sucesso!";
				$url = "{$volta}?extra_id={$_POST['extra_id']}";
			}else{
				$msg = "Erro ao atualizar o extra!";
				$url = "{$volta}?extra_id={$_POST['extra_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Extra Cadastrada com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar o extra!";
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