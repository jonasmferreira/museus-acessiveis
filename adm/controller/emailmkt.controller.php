<?php
$path_root_emailmktController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_emailmktController = "{$path_root_emailmktController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_emailmktController}adm{$DS}class{$DS}emailmkt.class.php";
$obj = new emailmkt();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "emailmktEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['emailmkt_id']) && trim($_POST['emailmkt_id'])!=''){
			if($exec['success']){
				$msg = "Cadastro atualizado com sucesso!";
				$url = "{$volta}?emailmkt_id={$_POST['emailmkt_id']}";
			}else{
				$msg = "Erro ao atualizar dados!";
				$url = "{$volta}?emailmkt_id={$_POST['emailmkt_id']}";
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
	case 'disparoTeste':
		$obj->setValues($_REQUEST);
		$exec = $obj->disparoEmailTeste();
		if($exec){
			$msg = "CMD_SUCCESS|E-mail Enviado com Sucesso!";
		}else{
			$msg = "CMD_FAILED|Erro ao tentar enviar e-mail!";
		}
		echo $msg;
	break;
}