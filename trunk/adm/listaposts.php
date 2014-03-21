<?php
	$path_root_postLista = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_postLista = "{$path_root_postLista}{$DS}..{$DS}";
	include_once "{$path_root_postLista}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_postLista}adm{$DS}class{$DS}post.class.php");
	$obj = new post();
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
?>
<script type="text/javascript" src="js/post.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
          Painel Administrativo <strong>/ Posts</strong>
	</div>

	<div class="left" style="width:auto;">
		<form action="listaposts.php" method="post" id="formBusca" name="formbusca">
			<input type="hidden" name="submitado" value="1" />
			<input type="hidden" name="page" id="pagePag" value="<?=($aRows['page']<1)?1:$aRows['page']?>" />
			<input type="hidden" name="rows" id="rowsPag" value="10" />
			<input type="hidden" name="total" id="totalPag" value="<?=$aRows['total']?>" />
			<input type="hidden" name="records" id="recordsPag" value="<?=$aRows['records']?>" />
			<div class="busca">
				<input type="text" name="post_titulo" id="post_titulo" placeholder="Titulo..." class="srcForm" value="<?=$_POST['post_titulo']?>" />
				<input type="image" src="imgs/busca.png" class="srcBt filtrar" align="absbottom" />
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
		<a href="editarposts.php" class="butCadastro">Cadastrar novo post</a>
	</div>
	<br clear="all" />
	<table cellpadding="8" cellspacing="0" border="0" width="100%">
		<thead>
			<tr class="tableHead">
				<td width="40" align="center">#</td>
				<td>Título</td>
				<td width="100" align="center">Autor</td>
				<td width="90" align="center">Data</td>
				<td width="100" align="center">Status</td>
				<td width="174">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<?	if(count($aRows['rows'])>0):?>
			<?		foreach($aRows['rows'] AS $k=> $v):
						$evenOdd = (($k+1)%2 > 0)?" even":"";
			?>
			<tr class="tableItem<?=$evenOdd?>">
				<td align="center"><?=$v['post_id']?></td>
				<td><?=$v['post_titulo']?></td>
				<td align="center"><?=$v['autor_nome']?></td>
				<td align="center"><?=$obj->dateDB2BR($v['post_dt_agendamento'])?></td>
				<td align="center"><?=$v['post_status_label']?></td>
				<td>
					<a href="editarposts.php?post_id=<?=$v['post_id']?>" class="btEdit">Editar</a>
					<a href="javascript:void(0);" rel="<?=$v['post_id']?>" class="btDel">Excluir</a>
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
<?php include_once "{$path_root_postLista}adm{$DS}includes{$DS}footer.php"; ?>
