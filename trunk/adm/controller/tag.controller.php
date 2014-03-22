<?php
$path_root_TagController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_TagController = "{$path_root_TagController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_TagController}adm{$DS}class{$DS}tag.class.php";
$obj = new tag();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "tagEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$exec = $obj->edit();
		if(isset($_POST['tag_id']) && trim($_POST['tag_id'])!=''){
			if($exec['success']){
				$msg = "Tag Atualizada com Sucesso!";
				$url = "{$volta}?tag_id={$_POST['tag_id']}";
			}else{
				$msg = "Erro ao atualizar a tag!";
				$url = "{$volta}?tag_id={$_POST['tag_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Tag Cadastrada com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar a tag!";
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