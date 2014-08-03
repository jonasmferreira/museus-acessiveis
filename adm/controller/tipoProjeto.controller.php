<?php
$path_root_tipoProjetoController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_tipoProjetoController = "{$path_root_tipoProjetoController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_tipoProjetoController}adm{$DS}class{$DS}tipoProjeto.class.php";
$obj = new tipoProjeto();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "tipoProjetoEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$exec = $obj->edit();
		if(isset($_POST['tipo_projeto_id']) && trim($_POST['tipo_projeto_id'])!=''){
			if($exec['success']){
				$msg = "Tipo do Projeto Atualizado com Sucesso!";
				$url = "{$volta}?tipo_projeto_id={$_POST['tipo_projeto_id']}";
			}else{
				$msg = "Erro ao atualizar o Tipo do Projeto!";
				$url = "{$volta}?tipo_projeto_id={$_POST['tipo_projeto_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Tipo do Projeto Cadastrado com sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar o Tipo do Projeto!";
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