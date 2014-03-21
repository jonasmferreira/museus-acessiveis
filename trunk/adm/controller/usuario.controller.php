<?php
$path_root_AutorController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_AutorController = "{$path_root_AutorController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_AutorController}adm{$DS}class{$DS}autor.class.php";
$obj = new autor();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "editarautor.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$exec = $obj->edit();
		if(isset($_POST['autor_id']) && trim($_POST['autor_id'])!=''){
			if($exec['success']){
				$msg = "Autor Atualizado com Sucesso!";
				$url = "{$volta}?autor_id={$_POST['autor_id']}";
			}else{
				$msg = "Erro ao atualizar o autor!";
				$url = "{$volta}?autor_id={$_POST['autor_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Autor Cadastrado com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar o autor!";
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
