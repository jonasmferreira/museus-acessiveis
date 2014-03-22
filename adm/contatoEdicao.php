<?php
	$path_root_mailingEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_mailingEdicao = "{$path_root_mailingEdicao}{$DS}..{$DS}";
	include_once "{$path_root_mailingEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_mailingEdicao}adm{$DS}class{$DS}mailing.class.php");
	$obj = new mailing();
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
<script type="text/javascript" src="js/mailing.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Institucional / mailing <strong>/ <?=isset($aRow['mailing_id'])?'Editar':'Cadastrar'?> mailing</strong>
	</div>
	<form action="controller/mailing.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="mailing_id" id="autor_id" value="<?=$aRow['mailing_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="mailingEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Mailing</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<input type="checkbox" name="mailing_enviar" value="S" <?=$aRow['mailing_enviar']=='S'?' checked="checked"':''?> /> Receber Informações
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Nome<br />
						<input type="text" class="formTxt obrigatorio" name="mailing_nome" id="mailing_nome" style="width:98%" value="<?=$aRow['mailing_nome']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						E-mail<br />
						<input type="text" class="formTxt obrigatorio" name="mailing_email" id="mailing_email" style="width:98%" value="<?=$aRow['mailing_email']?>" />
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="mailingLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_mailingEdicao}adm{$DS}includes{$DS}footer.php"; ?>
