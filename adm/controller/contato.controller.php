<?php
$path_root_contatoController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_contatoController = "{$path_root_contatoController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_contatoController}adm{$DS}class{$DS}contato.class.php";
$obj = new contato();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "contatoEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$exec = $obj->edit();
		if(isset($_POST['contato_id']) && trim($_POST['contato_id'])!=''){
			if($exec['success']){
				$msg = "Cadastro atualizado com sucesso!";
				$url = "{$volta}?contato_id={$_POST['contato_id']}";
			}else{
				$msg = "Erro ao atualizar dados!";
				$url = "{$volta}?contato_id={$_POST['contato_id']}";
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

?>
