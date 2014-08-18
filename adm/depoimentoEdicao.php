<?php
	$path_root_depoimentoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_depoimentoEdicao = "{$path_root_depoimentoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_depoimentoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_depoimentoEdicao}adm{$DS}class{$DS}depoimento.class.php");
	$obj = new depoimento();
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
<script type="text/javascript" src="js/depoimento.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Depoimento <strong>/ <?=isset($aRow['depoimento_id'])?'Editar':'Cadastrar'?> Depoimento</strong>
	</div>
	<form action="controller/depoimento.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="depoimento_id" id="depoimento_id" value="<?=$aRow['depoimento_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="depoimentoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Depoimento</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Data<br />
						<input type="text" class="formTxt datepicker" name="depoimento_dt" id="depoimento_dt" style="width:15%" value="<?=$aRow['depoimento_dt']?>" />
                    </td>
                </tr>
				<tr>
					<td colspan="3">
						Autor<br />
						<input type="text" class="formTxt obrigatorio" name="depoimento_autor" id="depoimento_autor" style="width:98%" value="<?=$aRow['depoimento_autor']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Empresa<br />
						<input type="text" class="formTxt obrigatorio" name="depoimento_empresa" id="depoimento_empresa" style="width:98%" value="<?=$aRow['depoimento_empresa']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="depoimento_conteudo" id="depoimento_conteudo" rows="5" style="width:99%"><?=$aRow['depoimento_conteudo']?></textarea>
					</td>
				</tr>
				<tr>
					<td align="right" colspan="3">
						<a href="depoimentoLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_depoimentoEdicao}adm{$DS}includes{$DS}footer.php"; ?>


