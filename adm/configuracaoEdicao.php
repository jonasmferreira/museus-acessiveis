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
		<input type="hidden" name="voltar" id="voltar" value="configuracaoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr>
					<td colspan="3">
						URL Base do site (ex: www.google.com)<br />
						<input type="text" class="formTxt obrigatorio" name="configuracao_baseurl" id="configuracao_baseurl" style="width:98%" value="<?=$aRow['configuracao_baseurl']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						URL Base do CkFinder (ex: www.google.com/images)<br />
						<input type="text" class="formTxt obrigatorio" name="configuracao_baseurl_ckfinder" id="configuracao_baseurl_ckfinder" style="width:98%" value="<?=$aRow['configuracao_baseurl_ckfinder']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Meta Author (ex: Mobile Studio)<br />
						<input type="text" class="formTxt obrigatorio" name="configuracao_meta_author" id="configuracao_meta_author" style="width:98%" value="<?=$aRow['configuracao_meta_author']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Meta Keywords (ex: acessibilidade, inclusão, deficiência visual)<br />
						<input type="text" class="formTxt obrigatorio" name="configuracao_meta_keywords" id="configuracao_meta_keywords" style="width:98%" value="<?=$aRow['configuracao_meta_keywords']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Meta Description (ex: Site especializado em inclusão de pessoas com deficiência visual.)<br />
						<textarea name="configuracao_meta_description" id="configuracao_meta_description" rows="5" class="formTxt obrigatorio" style="width:99%"><?=$aRow['configuracao_meta_description']?></textarea>

					</td>
				</tr>
				<tr>
					<td align="right" colspan="3">
						<a href="home.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_configuracaoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
