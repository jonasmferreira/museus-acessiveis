<?php
$path_root_Tipo_SrvicoController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_Tipo_SrvicoController = "{$path_root_Tipo_SrvicoController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_Tipo_SrvicoController}adm{$DS}class{$DS}tipo_servico.class.php";
$obj = new tipo_servico();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "tipo_servicoEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$exec = $obj->edit();
		if(isset($_POST['tipo_servico_id']) && trim($_POST['tipo_servico_id'])!=''){
			if($exec['success']){
				$msg = "Tipo do serviço Atualizado com Sucesso!";
				$url = "{$volta}?tipo_servico_id={$_POST['tipo_servico_id']}";
			}else{
				$msg = "Erro ao atualizar o Tipo do curso!";
				$url = "{$volta}?tipo_servico_id={$_POST['tipo_servico_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Extra Cadastrada com Tipo do serviço!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar o Tipo do serviço!";
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