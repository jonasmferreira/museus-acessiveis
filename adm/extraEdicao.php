<?php
	$path_root_extraEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_extraEdicao = "{$path_root_extraEdicao}{$DS}..{$DS}";
	include_once "{$path_root_extraEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_extraEdicao}adm{$DS}class{$DS}extra.class.php");
	$obj = new extra();
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
<script type="text/javascript" src="js/extra.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Extras <strong>/ <?=isset($aRow['extra_id'])?'Editar':'Cadastrar'?> Extra</strong>
	</div>
	<form action="controller/extra.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="extra_id" id="extra_id" value="<?=$aRow['extra_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="extraEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Extra</strong>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Nome<br />
						<input type="text" class="formTxt obrigatorio" name="extra_nome_campo" id="extra_nome_campo" style="width:98%" value="<?=$aRow['extra_nome_campo']?>" />
					</td>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="extraLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_extraEdicao}adm{$DS}includes{$DS}footer.php"; ?>
