<?php
	$path_root_downloadLista = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_downloadLista = "{$path_root_downloadLista}{$DS}..{$DS}";
	include_once "{$path_root_downloadLista}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_downloadLista}adm{$DS}class{$DS}download.class.php");
	$obj = new download();
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
<script type="text/javascript" src="js/download.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
          Painel Administrativo <strong>/ Download</strong>
	</div>

	<div class="left" style="width:auto;">
		<form action="downloadLista.php" method="post" id="formBusca" name="formbusca">
			<input type="hidden" name="submitado" value="1" />
			<input type="hidden" name="page" id="pagePag" value="<?=$aRows['page']?>" />
			<input type="hidden" name="rows" id="rowsPag" value="10" />
			<input type="hidden" name="total" id="totalPag" value="<?=$aRows['total']?>" />
			<input type="hidden" name="records" id="recordsPag" value="<?=$aRows['records']?>" />
			<div class="busca">
				<select name="fieldName" id="fieldName" class="srcForm" style="width:100%">
					<?	foreach($aFilterField AS $v):
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
		</form>
	</div>

	<div class="right" style="float:right;width:auto;">
		<a href="downloadEdicao.php" class="butCadastro">Adicionar</a>
	</div>
	<br clear="all" />
	<table cellpadding="8" cellspacing="0" border="0" width="100%">
		<thead>
			<tr class="tableHead">
				<td width="40" align="center">#</td>
				<td align="left">Data</td>
				<td align="left">Categoria</td>
				<td align="left">Titulo</td>
				<td align="left">Tipo</td>
				<td align="left">Tamanho</td>
				<td align="left">Arquivo</td>
				<td width="174">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<?	if(count($aRows['rows'])>0):?>
			<?		foreach($aRows['rows'] AS $k=> $v):
						$evenOdd = (($k+1)%2 > 0)?" even":"";
			?>
			<tr class="tableItem<?=$evenOdd?>">
				<td align="center"><?=$v['download_id']?></td>
				<td align="left"><?=$v['download_dt_hr']?></td>
				<td align="left"><?=$v['download_categoria_titulo']?></td>
				<td align="left"><?=$v['download_titulo']?></td>
				<td align="left"><?=$v['download_tipo_desc']?></td>
				<td align="left"><?=$v['download_tamanho']?></td>
				<td align="left"><?=$v['download_arquivo']?></td>
				<td>
					<a href="downloadEdicao.php?download_id=<?=$v['download_id']?>" class="btEdit">Editar</a>
					<a href="javascript:void(0);" rel="<?=$v['download_id']?>" class="btDel">Excluir</a>
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
<?php include_once "{$path_root_downloadLista}adm{$DS}includes{$DS}footer.php"; ?>
