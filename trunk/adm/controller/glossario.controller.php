<?php
$path_root_GlossarioController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_GlossarioController = "{$path_root_GlossarioController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_GlossarioController}adm{$DS}class{$DS}glossario.class.php";
$obj = new glossario();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "glossarioEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$exec = $obj->edit();
		if(isset($_POST['glossario_id']) && trim($_POST['glossario_id'])!=''){
			if($exec['success']){
				$msg = "Glossario Atualizado com Sucesso!";
				$url = "{$volta}?glossario_id={$_POST['glossario_id']}";
			}else{
				$msg = "Erro ao atualizar o glossario!";
				$url = "{$volta}?glossario_id={$_POST['glossario_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Glossario Cadastrado com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar o glossario!";
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
	case 'getOne':
		$obj->setValues($_REQUEST);
		$aResult = $obj->getOne();
		echo json_encode($aResult);
	break;
	case 'generateGlossary':
		$aRet = array();
		$aTodosGlossario = $obj->getAll();
		if(count($aTodosGlossario) > 0){
			foreach($aTodosGlossario AS $v){
				$v['glossario_palavra'] = strtolower($v['glossario_palavra']);
				$arr = array();
				$arr['term'] = $v['glossario_palavra'];
				$arr['type'] = "0";
				$arr['definition'] = $v['glossario_conteudo'];
				//$arr['id'] = $v['id'];
				$aRet[] = $arr;
				
				$arr = array();
				$arr['term'] = strtoupper($v['glossario_palavra']);
				$arr['type'] = "0";
				$arr['definition'] = $v['glossario_conteudo'];
				//$arr['id'] = $v['id'];
				$aRet[] = $arr;
				
				$arr = array();
				$arr['term'] = ucfirst($v['glossario_palavra']);
				$arr['type'] = "0";
				$arr['definition'] = $v['glossario_conteudo'];
				//$arr['id'] = $v['id'];
				$aRet[] = $arr;
				
				$arr = array();
				$arr['term'] = ucwords($v['glossario_palavra']);
				$arr['type'] = "0";
				$arr['definition'] = $v['glossario_conteudo'];
				//$arr['id'] = $v['id'];
				$aRet[] = $arr;
				
			}
		}
		header('Content-type: application/json');
		echo json_encode($aRet);
	break;
}