<?php
	$path_root_contatoLista = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_contatoLista = "{$path_root_contatoLista}{$DS}..{$DS}";
	include_once "{$path_root_contatoLista}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_contatoLista}adm{$DS}class{$DS}contato.class.php");
	$obj = new contato();
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
<script type="text/javascript" src="js/contato.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
          Painel Administrativo <strong>/ Contato</strong>
	</div>

	<div class="left" style="width:auto;">
		<form action="contatoLista.php" method="post" id="formBusca" name="formbusca">
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
		<a href="contatoEdicao.php" class="butCadastro">Cadastrar novo Contato</a>
	</div>
	<br clear="all" />
	<table cellpadding="8" cellspacing="0" border="0" width="100%">
		<thead>
			<tr class="tableHead">
				<td width="40" align="center">#</td>
				<td align="left">Data</td>
				<td align="left">Tipo</td>
				<td align="left">Nome</td>
				<td align="left">Link</td>
				<td width="150" align="center">Exibir</td>
				<td width="174">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<?	if(count($aRows['rows'])>0):?>
			<?		foreach($aRows['rows'] AS $k=> $v):
						$evenOdd = (($k+1)%2 > 0)?" even":"";
			?>
			<tr class="tableItem<?=$evenOdd?>">
				<td align="center"><?=$v['contato_id']?></td>
				<td align="left"><?=$v['contato_dt']?> às <?=$v['contato_hr']?></td>
				<td align="left"><?=$v['contato_tipo']?></td>
				<td align="left"><?=$v['contato_nome']?></td>
				<td align="left"><?=$v['contato_link']?></td>
				<td width="150" align="center"><?=($v['contato_exibir']=='S'?'Sim':'Não');?></td>
				<td>
					<a href="contatoEdicao.php?contato_id=<?=$v['contato_id']?>" class="btEdit">Editar</a>
					<a href="javascript:void(0);" rel="<?=$v['contato_id']?>" class="btDel">Excluir</a>
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
<?php include_once "{$path_root_contatoLista}adm{$DS}includes{$DS}footer.php"; ?>
