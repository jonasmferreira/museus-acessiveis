<?php
	$path_root_glossarioEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_glossarioEdicao = "{$path_root_glossarioEdicao}{$DS}..{$DS}";
	include_once "{$path_root_glossarioEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_glossarioEdicao}adm{$DS}class{$DS}glossario.class.php");
	$obj = new glossario();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	
	$aTags = $obj->getTags();
	$aGlossarios = $obj->getGlossario($_REQUEST['glossario_id']);
?>
<script type="text/javascript" src="js/glossario.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Glossarios <strong>/ <?=isset($aRow['glossario_id'])?'Editar':'Cadastrar'?> Glossario</strong>
	</div>
	<form action="controller/glossario.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="glossario_id" id="glossario_id" value="<?=$aRow['glossario_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="glossarioEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados da Glossario</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Palavra<br />
						<input type="text" class="formTxt obrigatorio" name="glossario_palavra" id="glossario_palavra" style="width:98%" value="<?=$aRow['glossario_palavra']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Definição<br />
						<textarea name="glossario_definicao" id="glossario_definicao" rows="5" style="width:99%"><?=$aRow['glossario_definicao']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="glossario_conteudo" id="glossario_conteudo" class="editor" rows="5" style="width:99%"><?=$aRow['glossario_conteudo']?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						Tags<br />
						<select class="formTxt" name="tags[]" id="tags" multiple="yes" style="width:99%;">
							<?	foreach($aTags AS $k=>$v):
									if(is_array($aRow['tags'])){
										$selected = in_array($v['tag_id'], $aRow['tags'])!==false?' selected="selected"':'';
									}else{
										$selected = "";
									}
							?>
							<option value="<?=$v['tag_id']?>"<?=$selected?>><?=$v['tag_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
					<td colspan="2">
						Glossário Relacionado<br />
						<select class="formTxt" name="glossarios[]" id="glossarios" multiple="yes" style="width:99%;">
							<?	foreach($aGlossarios AS $k=>$v):
									if(is_array($aRow['glossarios'])){
										$selected = in_array($v['glossario_id'], $aRow['glossarios'])!==false?' selected="selected"':'';
									}else{
										$selected = "";
									}
							?>
							<option value="<?=$v['glossario_id']?>"<?=$selected?>><?=$v['glossario_palavra']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Fonte<br />
						<input type="text" class="formTxt" name="glossario_fonte" id="glossario_fonte" style="width:98%" value="<?=$aRow['glossario_fonte']?>" />
					</td>
					<td colspan="2">
						Link da Fonte<br />
						<input type="text" class="formTxt" name="glossario_link_fonte" id="glossario_link_fonte" style="width:98%" value="<?=$aRow['glossario_link_fonte']?>" />
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Exibir?<br />
						<input value="S" type="checkbox" <?=$aRow['glossario_exibir']=='S'?'checked="checked"':''?> name="glossario_exibir" id="glossario_exibir"/>&nbsp; Sim
                    </td>
                </tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="glossarioLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_glossarioEdicao}adm{$DS}includes{$DS}footer.php"; ?>
