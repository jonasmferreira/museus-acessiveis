<?php
$path_root_CursoController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_CursoController = "{$path_root_CursoController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_CursoController}adm{$DS}class{$DS}curso.class.php";
$obj = new curso();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "cursoEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['curso_id']) && trim($_POST['curso_id'])!=''){
			if($exec['success']){
				$msg = "Curso Atualizado com Sucesso!";
				$url = "{$volta}?curso_id={$_POST['curso_id']}";
			}else{
				$msg = "Erro ao atualizar o curso!";
				$url = "{$volta}?curso_id={$_POST['curso_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Curso Cadastrado com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar o curso!";
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