<?php
	$path_root_newsletterEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_newsletterEdicao = "{$path_root_newsletterEdicao}{$DS}..{$DS}";
	include_once "{$path_root_newsletterEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_newsletterEdicao}adm{$DS}class{$DS}newsletter.class.php");
	$obj = new newsletter();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	$obj->debug($aRow);
?>
<script type="text/javascript" src="js/newsletter.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Institucional / Newsletter <strong>/ <?=isset($aRow['newsletter_id'])?'Editar':'Cadastrar'?> Newsletter</strong>
	</div>
	<form action="controller/newsletter.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="newsletter_id" id="autor_id" value="<?=$aRow['newsletter_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="newsletterEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Contato</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<input type="checkbox" name="newsletter_receber_informacoes" value="S" <?=$aRow['newsletter_receber_informacoes']=='S' ? ' ckecked':''?>>&nbsp;Receber Informações<br>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Nome<br />
						<input type="text" class="formTxt obrigatorio" name="newsletter_nome" id="newsletter_nome" style="width:98%" value="<?=$aRow['newsletter_nome']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						E-mail<br />
						<input type="text" class="formTxt obrigatorio" name="newsletter_email" id="newsletter_email" style="width:98%" value="<?=$aRow['newsletter_email']?>" />
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="newsletterLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_newsletterEdicao}adm{$DS}includes{$DS}footer.php"; ?>
