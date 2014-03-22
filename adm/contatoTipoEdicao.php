<?php
	$path_root_contatoTipoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_contatoTipoEdicao = "{$path_root_contatoTipoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_contatoTipoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_contatoTipoEdicao}adm{$DS}class{$DS}contatoTipo.class.php");
	$obj = new contatoTipo();
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
<script type="text/javascript" src="js/contatoTipo.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Tipo de Contato <strong>/ <?=isset($aRow['contato_tipo_id'])?'Editar':'Cadastrar'?> Tipo de Contato</strong>
	</div>
	<form action="controller/contatoTipo.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="contato_tipo_id" id="contato_tipo_id" value="<?=$aRow['contato_tipo_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="contatoTipoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Tipo de Contato</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Tipo de Contato<br />
						<input type="text" class="formTxt obrigatorio" name="contato_tipo" id="contato_tipo" style="width:98%" value="<?=$aRow['contato_tipo']?>" />
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Ícone do Tipo de Contato (10x10 à 15x15)<br />
						<?	if(is_file("../images/{$aRow['contato_tipo_icone']}")):?>
						<span>(<a href="javascript:void(0)" rel="contato_tipo_icone" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
                        <input type="file" class="formTxt" name="contato_tipo_icone" id="contato_tipo_icone" />
						<?	if(is_file("../images/{$aRow['contato_tipo_icone']}")):?>
						<div class="images">
                        	<img src="../images/<?=$aRow['contato_tipo_icone']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>
				<tr>
            		<td colspan="3">
						Ícone do Tipo de Contato - Contraste (10x10 à 15x15)<br />
						<?	if(is_file("../images/{$aRow['contato_tipo_icone_contraste']}")):?>
						<span>(<a href="javascript:void(0)" rel="contato_tipo_icone_contraste" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
                        <input type="file" class="formTxt" name="contato_tipo_icone_contraste" id="contato_tipo_icone" />
						<?	if(is_file("../images/{$aRow['contato_tipo_icone_contraste']}")):?>
						<div class="images">
                        	<img src="../images/<?=$aRow['contato_tipo_icone_contraste']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>
				<tr>
					<td colspan="3">
						<input type="checkbox" name="contato_tipo_status" value="S" <?=$aRow['contato_tipo_status']=='S'?' checked="checked"':''?> /> Exibir
					</td>
				</tr>
				<tr>
					<td align="right" colspan="3">
						<a href="contatoTipoLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_contatoTipoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
