<?php
$path_root_servProjCurInfoEdicao = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_servProjCurInfoEdicao = "{$path_root_servProjCurInfoEdicao}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_servProjCurInfoEdicao}adm{$DS}class{$DS}servProjCurInfo.class.php";
$obj = new servProjCurInfo();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "servProjCurInfoEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$exec = $obj->edit();
		if(isset($_POST['serv_proj_cur_id']) && trim($_POST['serv_proj_cur_id'])!=''){
			if($exec['success']){
				$msg = "Dados atualizados com Sucesso!";
				$url = "{$volta}?serv_proj_cur_id={$_POST['serv_proj_cur_id']}";
			}else{
				$msg = "Erro ao atualizar a informação!";
				$url = "{$volta}?serv_proj_cur_id={$_POST['serv_proj_cur_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Dados cadastrados com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar dados!";
				$url = "{$volta}";
			}
		}
		$obj->registerSession(array('erro'=>$msg));
		header("Location: ../{$url}");
	break;
	case 'getLista':
		$obj->setValues($_REQUEST);
		$aResult = $obj->getLista();
		echo json_encode($aResult);
	break;
}