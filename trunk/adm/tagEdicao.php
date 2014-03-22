<?php
	$path_root_tagEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_tagEdicao = "{$path_root_tagEdicao}{$DS}..{$DS}";
	include_once "{$path_root_tagEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_tagEdicao}adm{$DS}class{$DS}tag.class.php");
	$obj = new tag();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
?>
<script type="text/javascript" src="js/tag.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Tags <strong>/ <?=isset($aRow['tag_id'])?'Editar':'Cadastrar'?> Tag</strong>
	</div>
	<form action="controller/tag.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="tag_id" id="tag_id" value="<?=$aRow['tag_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="tagEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados da Tag</strong>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Nome<br />
						<input type="text" class="formTxt obrigatorio" name="tag_titulo" id="tag_titulo" style="width:98%" value="<?=$aRow['tag_titulo']?>" />
					</td>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="tagLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_tagEdicao}adm{$DS}includes{$DS}footer.php"; ?>
