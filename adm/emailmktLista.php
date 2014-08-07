<?php
	$path_root_emailmktLista = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_emailmktLista = "{$path_root_emailmktLista}{$DS}..{$DS}";
	include_once "{$path_root_emailmktLista}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_emailmktLista}adm{$DS}class{$DS}emailmkt.class.php");
	$obj = new emailmkt();
	$aStatus = $obj->getStatus();
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
	//$obj->debug($aRows);
?>
<script type="text/javascript" src="js/emailmkt.js"></script>
<style>
	#dialog-form label, #dialog-form input { display:block; }
	#dialog-form input.text { margin-bottom:12px; width:95%; padding: .4em; }
	#dialog-form fieldset { padding:0; border:0; margin-top:25px; }
	#dialog-form h1 { font-size: 1.2em; margin: .6em 0; }
	#dialog-form div#users-contain { width: 350px; margin: 20px 0; }
	#dialog-form div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
	#dialog-form div#users-contain table td, #dialog-form div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
	#dialog-form .ui-dialog .ui-state-error { padding: .3em; }
	#dialog-form .validateTips { border: 1px solid transparent; padding: 0.3em; }
</style>
<div id="dialog-form" title="Teste de Disparo" style="display:none">
	<form>
		<fieldset>
			<label for="name">Nome</label>
			<input type="text" name="nome_teste_disparo" id="nome_teste_disparo" value="" class="text ui-widget-content ui-corner-all" />
			<label for="email">E-mail</label>
			<input type="text" name="email_teste_disparo" id="email_teste_disparo" value="" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>
<div id="contentWrapper">
	<div id="breadCrumbs">
          Painel Administrativo <strong>/ E-mail Marketing</strong>
	</div>

	<div class="left" style="width:auto;">
		<form action="emailmktLista.php" method="post" id="formBusca" name="formbusca">
			<input type="hidden" name="submitado" value="1" />
			<input type="hidden" name="page" id="pagePag" value="<?=$aRows['page']?>" />
			<input type="hidden" name="rows" id="rowsPag" value="10" />
			<input type="hidden" name="total" id="totalPag" value="<?=$aRows['total']?>" />
			<input type="hidden" name="records" id="recordsPag" value="<?=$aRows['records']?>" />
			<div class="busca" style="margin-right:5px;">
				<select name="fieldName" id="fieldName" class="srcForm" style="width:100%">
					<? foreach($aFilterField AS $v):
							$selected = $v['fieldNameId']==$_POST['fieldName']?' selected="selected"':'';
					?>
					<option value="<?=$v['fieldNameId']?>"<?=$selected?>><?=$v['fieldNameLabel']?></option>
					<?	endforeach;?>
				</select>
			</div>
			<div class="busca" style="margin-right:5px;">
				<input type="text" name="data_ini" id="data_ini" placeholder="De..." class="srcForm datepicker dt" value="<?=$_POST['data_ini']?>" />
				<input type="image" src="imgs/busca.png" class="srcBt filtrar" align="absbottom" />
			</div>
			<div class="busca" style="margin-right:5px;">
				<input type="text" name="data_fim" id="data_fim" placeholder="Até..." class="srcForm datepicker dt" value="<?=$_POST['data_fim']?>" />
				<input type="image" src="imgs/busca.png" class="srcBt filtrar" align="absbottom" />
			</div>
			<div class="busca" style="margin-right:5px;">
				<input type="text" name="txtPesquisar" id="txtPesquisar" placeholder="Pesquisar..." class="srcForm" value="<?=$_POST['txtPesquisar']?>" />
				<input type="image" id="filrar" src="imgs/busca.png" class="srcBt" align="absbottom" />
			</div>
			<div class="busca" style="margin-right:5px;">
				<select name="emailmkt_status" id="emailmkt_status" class="srcForm" style="width:205px">
					<?	foreach($aStatus AS $v):
							$selected = $v['id']==$_POST['emailmkt_status']?' selected="selected"':'';
					?>
					<option value="<?=$v['id']?>"<?=$selected?>><?=$v['titulo']?></option>
					<?	endforeach;?>
				</select>
				<input type="image" src="imgs/busca.png" class="srcBt filtrar" align="absbottom" />
			</div>
		</form>
	</div>
	<br clear="all" />
	<div class="right" style="float: right; width: auto; margin: 10px 24px 0px 0px;">
		<a href="emailmktEdicao.php" class="butCadastro">Cadastrar novo E-mail Marketing</a>
	</div>
	<br clear="all" />
	<table cellpadding="8" cellspacing="0" border="0" width="100%">
		<thead>
			<tr class="tableHead">
				<td width="40" align="center">#</td>
				<td align="left">Titulo</td>
				<td align="left">Data</td>
				<td align="left">Status</td>
				<td width="250">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<?	if(count($aRows['rows'])>0):?>
			<?		foreach($aRows['rows'] AS $k=> $v):
						$evenOdd = (($k+1)%2 > 0)?" even":"";
			?>
			<tr class="tableItem<?=$evenOdd?>">
				<td align="center"><?=$v['emailmkt_id']?></td>
				<td align="left"><?=$v['emailmkt_titulo']?></td>
				<td align="left"><?=$obj->dateDB2BR($v['emailmkt_dt_agendada'])?> às <?=$v['emailmkt_hr_agendada']?></td>
				<td align="left"><?=$v['emailmkt_status_label']?></td>
				<td>
					<a href="emailmktEdicao.php?emailmkt_id=<?=$v['emailmkt_id']?>" class="btEdit">Editar</a>
					<a href="javascript:void(0);" rel="<?=$v['emailmkt_id']?>" class="btDel">Excluir</a>
					<a href="../newsletterItem.php?emailmkt_id=<?=$v['emailmkt_id']?>" class="popups btView">Ver</a>
					
					<a href="javascript:void(0)" rel="<?=$v['emailmkt_id']?>"  class="btDisparo btView">Teste de Disparo</a>
				</td>
			</tr>
			<?		endforeach;?>
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
<?php include_once "{$path_root_emailmktLista}adm{$DS}includes{$DS}footer.php"; ?>
