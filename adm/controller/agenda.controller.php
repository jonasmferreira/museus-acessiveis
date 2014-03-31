<?php
$path_root_AgendaController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_AgendaController = "{$path_root_AgendaController}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_AgendaController}adm{$DS}class{$DS}agenda.class.php";
$obj = new agenda();
switch($_REQUEST['action']){
	case 'edit-item':
		$volta = "agendaEdicao.php";
		if(isset($_POST['volta'])&&trim($_POST['volta'])!=''){
			$volta = $_POST['volta'];
		}
		$obj->setValues($_POST);
		$obj->setFiles($_FILES);
		$exec = $obj->edit();
		if(isset($_POST['agenda_id']) && trim($_POST['agenda_id'])!=''){
			if($exec['success']){
				$msg = "Agenda Atualizada com Sucesso!";
				$url = "{$volta}?agenda_id={$_POST['agenda_id']}";
			}else{
				$msg = "Erro ao atualizar a agenda!";
				$url = "{$volta}?agenda_id={$_POST['agenda_id']}";
			}
		}else{
			if($exec['success']){
				$msg = "Agenda Cadastrada com Sucesso!";
				$url = "{$volta}";
			}else{
				$msg = "Erro ao cadastrar a agenda!";
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
	case 'getAgendaGeral':
		if($_REQUEST['tipoMes']=='mes_anterior'){
			$mes = date("m",  mktime(0, 0, 0, $_REQUEST['mes']-1, 1, $_REQUEST['ano']));
			$ano = date("Y",  mktime(0, 0, 0, $_REQUEST['mes']-1, 1, $_REQUEST['ano']));
		}else{
			$mes = date("m",  mktime(0, 0, 0, $_REQUEST['mes']+1, 1, $_REQUEST['ano']));
			$ano = date("Y",  mktime(0, 0, 0, $_REQUEST['mes']+1, 1, $_REQUEST['ano']));
		}

		$aArrAgenda = $obj->getAgendaGeral($mes, $ano);
		?>
<div id="month-info">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td><a tabIndex="63" href="javascript:void(0);" id="mes_anterior" mes="<?=$aArrAgenda['mes']?>" ano="<?=$aArrAgenda['ano']?>" class="arrow-l"><strong>&lt;&lt;</strong></a></td>
			<td><a tabIndex="64" href=""><strong><?=$aArrAgenda['mesExtenso']?></strong></a></td>
			<td><span>|</span></td>
			<td><a tabIndex="65" href=""><strong><?=$aArrAgenda['ano']?></strong></a></td>
			<td><a tabIndex="66" href="javascript:void(0);" id="mes_posterior" mes="<?=$aArrAgenda['mes']?>" ano="<?=$aArrAgenda['ano']?>" class="arrow-r"><strong>&gt;&gt;</strong></a></td>
		</tr>
	</table>
</div>
<div id="month-days">
   <table id='calendas' cellpadding="0" cellspacing="0" width="100%">
	   <thead>
		   <tr>
			   <td align="center" valign="middle">D</td>
			   <td align="center" valign="middle">S</td>
			   <td align="center" valign="middle">T</td>
			   <td align="center" valign="middle">Q</td>
			   <td align="center" valign="middle">Q</td>
			   <td align="center" valign="middle">S</td>
			   <td align="center" valign="middle">S</td>
		   </tr>
	   </thead>
	   <tbody>
		   <?	$tabIndex = 67;
			   foreach($aArrAgenda['dias'] AS $row):?>
		   <tr>
			   <?	foreach($row AS $dia):?>
			   <td tabIndex="<?=$tabIndex?>" align="center" valign="middle"><?=$dia?></td>
			   <?		$tabIndex++;
				   endforeach;?>
		   </tr>
		   <?	endforeach;?>
	   </tbody>
   </table>
</div>
		<?
	break;
}