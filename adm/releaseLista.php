<?php
	$path_root_releaseLista = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_releaseLista = "{$path_root_releaseLista}{$DS}..{$DS}";
	include_once "{$path_root_releaseLista}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_releaseLista}adm{$DS}class{$DS}release.class.php");
	$obj = new release();
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
	//$obj->debug($aRows);
	
	$aControlePaginacao = $obj->controlePaginacao($aRows);
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	$sBaseUrl = $obj->getBaseUrl();
?>
<script type="text/javascript" src="js/release.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
          Painel Administrativo <strong>/ Release</strong>
	</div>
	<div class="left" style="width:auto;">
		<form action="releaseLista.php" method="post" id="formBusca" name="formbusca">
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
		<a href="releaseEdicao.php" class="butCadastro">Adicionar</a>
	</div>
	<br clear="all" />
	<table cellpadding="8" cellspacing="0" border="0" width="100%">
		<thead>
			<tr class="tableHead">
				<td width="40" align="center">ID</td>
				<td>Data</td>
				<td>Agenda</td>
				<td>Exibir <br />Listagem?</td>
				<td>Titulo Síntese</td>
				<td>Titulo</td>
				<!--td>Fonte</td-->
				<td>Banner <br />Principal?</td>
				<td>Destaque <br />Home?</td>
				<td width="174">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<?	if(count($aRows['rows'])>0):?>
			<?		foreach($aRows['rows'] AS $k=> $v):
						$evenOdd = (($k+1)%2 > 0)?" even":"";
			?>
			<tr class="tableItem<?=$evenOdd?>">
				<td align="center"><?=$v['release_id']?></td>
				<td><?=$v['release_dthr']?></td>
				<td><?=$v['release_dt_agenda']?></td>
				<td>
					<?php
						$exibe= strtolower($v['release_exibir_listagem']);
						if($exibe=='n'){
							echo '<div style="font-weight:bold; color:#FF0000;">' . $v['release_exibir_listagem_label'] . '</div>';
						}else{
							echo $v['release_exibir_listagem_label'];
						}
					?>
				</td>

				<td><?=$v['release_titulo_sintese']?></td>
				<td><?=$v['release_titulo']?></td>
				<!--td><?=$v['release_fonte']?></td-->
				<td>
					<?php
						$exibe= strtolower($v['release_exibir_banner_label']);
						if($exibe=='sim'){
							echo '<div style="font-weight:bold; color:#FF0000;">' . $v['release_exibir_banner_label'] . '</div>';
						}else{
							echo $v['release_exibir_banner_label'];
						}
					?>
				</td>
				<td>
					<?php
						$exibe= strtolower($v['release_exibir_destaque_home_label']);
						if($exibe=='sim'){
							echo '<div style="font-weight:bold; color:#0000FF;">' . $v['release_exibir_destaque_home_label'] . '</div>';
						}else{
							echo $v['release_exibir_destaque_home_label'];
						}
					?>
				</td>
				<td>
					<a href="<?=$sBaseUrl?>release/<?=$v['release_id']?>/<?=$obj->toNormaliza($v['release_titulo'])?>" class="popupsNew btView">Ver</a>
					<a href="releaseEdicao.php?release_id=<?=$v['release_id']?>" class="btEdit">Editar</a>
					<a href="javascript:void(0);" rel="<?=$v['release_id']?>" class="btDel">Excluir</a>
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
<?php include_once "{$path_root_releaseLista}adm{$DS}includes{$DS}footer.php"; ?>

