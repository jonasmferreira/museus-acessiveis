<?php
	$path_root_downloadCategoriaEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_downloadCategoriaEdicao = "{$path_root_downloadCategoriaEdicao}{$DS}..{$DS}";
	include_once "{$path_root_downloadCategoriaEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_downloadCategoriaEdicao}adm{$DS}class{$DS}downloadCategoria.class.php");
	$obj = new downloadCategoria();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	//$obj->debug($aRow);
?>
<script type="text/javascript" src="js/downloadCategoria.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Categoria de Download <strong>/ <?=isset($aRow['download_categoria_id'])?'Editar':'Cadastrar'?> Categoria de Download</strong>
	</div>
	<form action="controller/downloadCategoria.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="download_categoria_id" id="download_categoria_id" value="<?=$aRow['download_categoria_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="downloadCategoriaEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Categoria de Download</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Categoria de Download<br />
						<input type="text" class="formTxt obrigatorio" name="download_categoria_titulo" id="download_categoria_titulo" style="width:98%" value="<?=$aRow['download_categoria_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td align="right" colspan="3">
						<a href="downloadCategoriaLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_downloadCategoriaEdicao}adm{$DS}includes{$DS}footer.php"; ?>
