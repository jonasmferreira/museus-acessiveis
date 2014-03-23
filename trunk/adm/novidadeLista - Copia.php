<?php
	$path_root_novidadeLista = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_novidadeLista = "{$path_root_novidadeLista}{$DS}..{$DS}";
	include_once "{$path_root_novidadeLista}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_novidadeLista}adm{$DS}class{$DS}novidade.class.php");
	$obj = new novidade();
	$aFilterField = $obj->getFilterFieldName();
	if(isset($_POST['submitado'])){
		$obj->setValues($_REQUEST);
	}else{
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10'
		));
	}
	$aRows = $obj->getLista();
	$aControlePaginacao = $obj->controlePaginacao($aRows);
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	$obj->debug($aRows);
?>
<script type="text/javascript" src="js/novidade.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
          Painel Administrativo <strong>/ Novidade 360º</strong>
	</div>

	<div class="left" style="width:auto;">
		<form action="cursoLista.php" method="post" id="formBusca" name="formbusca">
			<input type="hidden" name="submitado" value="1" />
			<input type="hidden" name="page" id="pagePag" value="<?=$aRows['page']?>" />
			<input type="hidden" name="rows" id="rowsPag" value="10" />
			<input type="hidden" name="total" id="totalPag" value="<?=$aRows['total']?>" />
			<input type="hidden" name="records" id="recordsPag" value="<?=$aRows['records']?>" />
			<div class="busca">
				<select name="fieldName" id="fieldName" class="srcForm" style="width:100%">
					<? foreach($aFilterField AS $v):
							$selected = $v['fieldNameId']==$_POST['fieldName']?' selected="selected"':'';
					?>
					<option value="<?=$v['fieldNameId']?>"<?=$selected?>><?=$v['fieldNameLabel']?></option>
					<?	endforeach;?>
				</select>
			</div>
			<div class="busca">
				<input type="text" name="txtPesquisar" id="txtPesquisar" placeholder="Pesquisar..." class="srcForm" value="<?=$_POST['txtPesquisar']?>" />
				<input type="image" id="filrar" src="imgs/busca.png" class="srcBt" align="absbottom" />
			</div>
			<div class="busca">
				<input type="text" name="data_ini" id="data_ini" placeholder="De..." class="srcForm datepicker dt" value="<?=$_POST['data_ini']?>" />
				<input type="image" src="imgs/busca.png" class="srcBt filtrar" align="absbottom" />
			</div>
			<div class="busca">
				<input type="text" name="data_fim" id="data_fim" placeholder="Até..." class="srcForm datepicker dt" value="<?=$_POST['data_fim']?>" />
				<input type="image" src="imgs/busca.png" class="srcBt filtrar" align="absbottom" />
			</div>
		</form>
	</div>

	<div class="right" style="float:right;width:auto;">
		<a href="novidadeEdicao.php" class="butCadastro">Cadastrar novo curso</a>
	</div>
	<br clear="all" />
	<table cellpadding="8" cellspacing="0" border="0" width="100%">
		<thead>
			<tr class="tableHead">
				<td width="40" align="center">#</td>
				<td>Data</td>
				<td>Agenda</td>
				<td>Título</td>
				<td>Resumo</td>
				<td>Exibe Outdoor?</td>
				<td>Destaque na Home?</td>
				<td width="174">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<?	if(count($aRows['rows'])>0):?>
			<?		foreach($aRows['rows'] AS $k=> $v):
						$evenOdd = (($k+1)%2 > 0)?" even":"";
			?>
			<tr class="tableItem<?=$evenOdd?>">
				<td align="center"><?=$v['novidade_360_id']?></td>
				<td><?=$v['novidade_360_dt']?> às <?=$v['novidade_360_hr']?></td>
				<td><?=$v['novidade_360_dt_agenda']?></td>
				<td><?=$v['novidade_360_titulo']?></td>
				<td><?=$v['novidade_360_resumo']?></td>
				<td><?=($v['novidade_360_exibir_banner']=='S') ? 'Sim': 'Não';?></td>
				<td><?=($v['novidade_360_exibir_destaque_home']=='S') ? 'Sim': 'Não';?></td>
				<td>
					<a href="novidadeEdicao.php?novidade_360_id=<?=$v['novidade_360_id']?>" class="btEdit">Editar</a>
					<a href="javascript:void(0);" rel="<?=$v['novidade_360_id']?>" class="btDel">Excluir</a>
				</td>
			</tr>
			<?		endforeach;?>
			<?	else:?>
			<?	endif;?>
		</tbody>
	</table>
	<?	if(count($aControlePaginacao) > 0):?>
	<!-- Paginação -->
	<div id="paginacao">
		<a href="javascript:void(0);" id="antPage">« Anterior</a>
		<?	foreach($aControlePaginacao AS $v):
				echo $v."\n";
			endforeach;
		?>
		<a href="javascript:void(0);" id="antProx">Próxima »</a>
	</div>
	<?	endif;?>
</div>
<?php include_once "{$path_root_novidadeLista}adm{$DS}includes{$DS}footer.php"; ?>
