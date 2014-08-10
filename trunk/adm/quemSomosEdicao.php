<?php
	$path_root_quemSomosEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_quemSomosEdicao = "{$path_root_quemSomosEdicao}{$DS}..{$DS}";
	include_once "{$path_root_quemSomosEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_quemSomosEdicao}adm{$DS}class{$DS}quemSomos.class.php");
	$obj = new quemSomos();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	//$obj->debug($aRow);
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	
?>
<script type="text/javascript" src="js/curso.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Quem Somos <strong>/ <?=isset($aRow['quemsomos_id'])?'Editar':'Cadastrar'?> Quem Somos</strong>
	</div>
	<form action="controller/quemSomos.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="quemsomos_id" id="curso_id" value="<?=$aRow['quemsomos_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="quemSomosEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Quem Somos</strong>
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Exibir?<br />
						<input value="S" type="checkbox" <?=$aRow['quemsomos_exibir']=='S'?'checked="checked"':''?> name="quemsomos_exibir" id="quemsomos_exibir"/>&nbsp; Sim
                    </td>
                </tr>
				<tr>
					<td colspan="3">
						Título<br />
						<input type="text" class="formTxt obrigatorio" name="quemsomos_titulo" id="quemsomos_titulo" style="width:98%" value="<?=$aRow['quemsomos_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="quemsomos_conteudo" id="quemsomos_conteudo" class="editor" rows="5" style="width:99%"><?=$aRow['quemsomos_conteudo']?></textarea>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="quemSomosLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_quemSomosEdicao}adm{$DS}includes{$DS}footer.php"; ?>
