<?php
	$path_root_cursoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_cursoEdicao = "{$path_root_cursoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_cursoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_cursoEdicao}adm{$DS}class{$DS}curso.class.php");
	$obj = new curso();
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
	$aGlossarios = $obj->getGlossario();
	$aDownloads = $obj->getDownload();
	$aExtras = $obj->getExtra();
?>
<script type="text/javascript" src="js/curso.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Cursos <strong>/ <?=isset($aRow['curso_id'])?'Editar':'Cadastrar'?> Curso</strong>
	</div>
	<form action="controller/curso.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="curso_id" id="curso_id" value="<?=$aRow['curso_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="cursoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados da Glossario</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Nome<br />
						<input type="text" class="formTxt obrigatorio" name="curso_titulo" id="curso_titulo" style="width:98%" value="<?=$aRow['curso_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Resumo<br />
						<textarea name="curso_resumo" id="curso_resumo" rows="5" style="width:99%"><?=$aRow['curso_resumo']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Thumb(150x115)<br />
						<input type="file" name="curso_thumb" id="curso_thumb" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição do Thumb<br />
						<textarea name="curso_thumb_desc" id="curso_thumb_desc" rows="5" style="width:99%"><?=$aRow['curso_thumb_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="curso_conteudo" id="curso_conteudo" class="editor" rows="5" style="width:99%"><?=$aRow['curso_conteudo']?></textarea>
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
					<td>
						Termo Relacionado<br />
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
					<td>
						Download<br />
						<select class="formTxt" name="downloads[]" id="downloads" multiple="yes" style="width:99%;">
							<?	foreach($aDownloads AS $k=>$v):
									if(is_array($aRow['downloads'])){
										$selected = in_array($v['download_id'], $aRow['downloads'])!==false?' selected="selected"':'';
									}else{
										$selected = "";
									}
							?>
							<option value="<?=$v['download_id']?>"<?=$selected?>><?=$v['download_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Fonte<br />
						<input type="text" class="formTxt" name="curso_fonte" id="curso_fonte" style="width:98%" value="<?=$aRow['curso_fonte']?>" />
					</td>
					<td colspan="2">
						Link da Fonte<br />
						<input type="text" class="formTxt" name="curso_link_fonte" id="curso_link_fonte" style="width:98%" value="<?=$aRow['curso_link_fonte']?>" />
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Sob demanda?<br />
						<input value="S" type="checkbox" <?=$aRow['curso_sob_demanda']=='S'?'checked="checked"':''?> name="curso_sob_demanda" id="curso_sob_demanda"/>&nbsp; Sim
                    </td>
                </tr>
				<tr>
            		<td>
						Periodo De<br />
						<input type="text" <?=$aRow['curso_sob_demanda']=='S'?'disabled="disabled"':''?> class="formTxt datepicker" name="curso_dt_ini" id="curso_dt_ini" style="width:98%" value="<?=$aRow['curso_dt_ini']?>" />
                    </td>
					<td>
						Periodo Ate<br />
						<input type="text" <?=$aRow['curso_sob_demanda']=='S'?'disabled="disabled"':''?> class="formTxt datepicker" name="curso_dt_fim" id="curso_dt_fim" style="width:98%" value="<?=$aRow['curso_dt_fim']?>" />
                    </td>
					<td>
						Agenda<br />
						<input type="text" class="formTxt obrigatorio datepicker" name="curso_agenda" id="curso_agenda" style="width:98%" value="<?=$aRow['curso_agenda']?>" />
                    </td>
                </tr>
				<?	if(count($aExtras) > 0):?>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Informações Extras</strong>
					</td>
				</tr>
				<?	foreach($aExtras AS $v):?>
				<td>
					<?=$v['extra_nome_campo']?><br />
					<input type="text" class="formTxt" name="extras[<?=$v['extra_id']?>]" id="extras_<?=$v['extra_id']?>" style="width:98%" value="<?=$aRow['extras'][$v['extra_id']]?>" />
				</td>
				<?	endforeach;?>
				<?	endif;?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="cursoLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_cursoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
