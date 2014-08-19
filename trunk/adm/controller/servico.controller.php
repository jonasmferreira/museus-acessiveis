<?php
$path_root_ServiçoController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_ServiçoController = "{$path_root_ServiçoController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_ServiçoController}adm{$DS}class{$DS}servico.class.php";
$obj = new servico();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "servicoEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['servico_id']) && trim($_POST['servico_id'])!=''){
			if($exec['success']){
				$msg = "Serviço Atualizado com Sucesso!";
				$url = "{$volta}?servico_id={$_POST['servico_id']}";
			}else{
				$msg = "Erro ao atualizar o servico!";
				$url = "{$volta}?servico_id={$_POST['servico_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Serviço Cadastrado com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar o servico!";
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
	
	case 'down-order':
		
		$sOrderField = $_POST['order_field'];
		$linkAbsolute = $_POST['linkAbsolute'];
		$downPage = $_POST['downPage'];
		$downId = $_POST['downId'];
		
		if($sOrderField=='D'){
			$sOrder = 't.download_titulo';
		}elseif($sOrderField=='DT'){
			$sOrder = 't.download_dt';
		}elseif($sOrderField=='F'){
			$sOrder = 't.download_tipo_desc';
		}elseif($sOrderField=='S'){
			$sOrder = 't.download_tamanho';
		}elseif($sOrderField=='CT'){
			$sOrder = 'tc.download_categoria_titulo';
		}

		$obj->setAOrderBy(array(
			$sOrder => 'ASC'
		));
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'500000'
		));

		$aResult = $obj->getDownloadByServico($downId,$sOrder,'ASC');
		if(count($aResult)>0){
			$sTable="";
			foreach($aResult['rows'] as $k => $v){
				$sLinkFile='';
				if($v['download_tipo']!=7){
					$sLinkFile = $linkAbsolute .'arquivosDown/';
				}
				$sTable .= "<tr>";
				$sTable .= "	<td><span>" .$v['download_dt']."</span></td>";
				$sTable .= "	<td><span>" . $v['download_categoria_titulo'] . "</span></td>"; 
				$sTable .= "	<td><span><a target='_BLANK' href='" . $v['download_arquivo'] . "'>" . $v['download_titulo'] . "</a></span></td>"; 
				$sTable .= "	<td><span>" . $v['download_tipo_label'] . "</span></td>"; 
				$sTable .= "	<td><span>" . $v['download_tamanho_label'] . "</span></td>";
				$sTable .= "</tr>";
			}
		}
		$aRet = array(
			'success'=>true
			,'rows'=> $sTable
		);
		echo json_encode($aRet);
		
	break;
	
	
}