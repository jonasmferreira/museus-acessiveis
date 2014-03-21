<?php
	$path_root_configuracaoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_configuracaoEdicao = "{$path_root_configuracaoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_configuracaoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_configuracaoEdicao}adm{$DS}class{$DS}configuracao.class.php");
	$obj = new configuracao();
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
<script type="text/javascript" src="js/configuracao.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Configurações <strong>/ Editar Configurações</strong>
	</div>
	<form action="controller/configuracao.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="configuracao_id" id="configuracao_id" value="1" />
		<input type="hidden" name="voltar" id="voltar" value="editarconfiguracao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr>
					<td colspan="3">
						Base URL CkFinder<br />
						<input type="text" class="formTxt obrigatorio" name="configuracao_baseurl_ckfinder" id="configuracao_baseurl_ckfinder" style="width:98%" value="<?=$aRow['configuracao_baseurl_ckfinder']?>" />
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_configuracaoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
