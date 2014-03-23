<?php
$path_root_imprensaController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_imprensaController = "{$path_root_imprensaController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_imprensaController}adm{$DS}class{$DS}imprensa.class.php";
$obj = new imprensa();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "imprensaEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['imprensa_id']) && trim($_POST['imprensa_id'])!=''){
			if($exec['success']){
				$msg = "Cadastro atualizado com sucesso!";
				$url = "{$volta}?imprensa_id={$_POST['imprensa_id']}";
			}else{
				$msg = "Erro ao atualizar dados!";
				$url = "{$volta}?imprensa_id={$_POST['imprensa_id']}";
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
}