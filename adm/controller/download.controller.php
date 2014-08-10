<?php
$path_root_downloadController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_downloadController = "{$path_root_downloadController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_downloadController}adm{$DS}class{$DS}download.class.php";
$obj = new download();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "downloadEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['download_id']) && trim($_POST['download_id'])!=''){
			if($exec['success']){
				$msg = "Cadastro atualizado com sucesso!";
				$url = "{$volta}?download_id={$_POST['download_id']}";
			}else{
				$msg = "Erro ao atualizar dados!";
				$url = "{$volta}?download_id={$_POST['download_id']}";
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

	case 'down-order':
		
		$sOrderField = $_POST['order_field'];
		$linkAbsolute = $_POST['linkAbsolute'];
		
		if($sOrderField=='D'){
			$sOrder = 't.download_titulo';
		}elseif($sOrderField=='DT'){
			$sOrder = 't.download_dt';
		}elseif($sOrderField=='F'){
			$sOrder = 't.download_tipo_desc';
		}elseif($sOrderField=='S'){
			$sOrder = 't.download_tamanho';
		}

		$obj->setAOrderBy(array(
			$sOrder => 'ASC'
		));
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'500000'
		));

		$aResult = $obj->getLista();
		if($aResult['records']>0){
			$sTable="";
			foreach($aResult['rows'] as $k => $v){
				$sLinkFile='';
				if($v['download_tipo']!=7){
					$sLinkFile = $linkAbsolute .'arquivosDown/';
				}
				$sTable .= "<tr><td><span>" .$v['download_dt'];
				$sTable .= "</span></td><td><span><a target='_BLANK' href='"; 
				$sTable .= $sLinkFile . $v['download_arquivo'] . "'>";
				$sTable .= $v['download_titulo'];
				$sTable .= "</a></span></td><td><span>"; 
				$sTable .= $v['download_tipo_label'] . "</span></td><td><span>";
				$sTable .= $v['download_tamanho_label'] . "</span></td></tr>";
			}
		}
		$aRet = array(
			'success'=>true
			,'rows'=> $sTable
		);
		echo json_encode($aRet);
		
	break;

}
