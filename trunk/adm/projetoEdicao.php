<?php
	$path_root_projetoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_projetoEdicao = "{$path_root_projetoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_projetoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_projetoEdicao}adm{$DS}class{$DS}projeto.class.php");
	$obj = new projeto();
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
	$aTipoProjeto = $obj->getTipoProjeto();
	
?>
<script type="text/javascript" src="js/projeto.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Projetos <strong>/ <?=isset($aRow['projeto_id'])?'Editar':'Cadastrar'?> Projeto</strong>
	</div>
	<form action="controller/projeto.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="projeto_id" id="projeto_id" value="<?=$aRow['projeto_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="projetoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Projeto</strong>
					</td>
				</tr>
				<tr>
					<td>
						Tipo do Projeto<br />
						<select id="projeto_tipo" name="projeto_tipo" class="formTxt obrigatorio">
							<?php	foreach($aTipoProjeto as $k => $v):
									$selected = ($v['tipo_projeto_id']==$aRow['projeto_tipo'])?' selected="selected"':'';
							?>
							<option<?=$selected?> value="<?=$v['tipo_projeto_id']?>"><?=$v['tipo_projeto_titulo']?></option>
							<?php	endforeach;?>
						</select>
					</td>
					<td colspan="2">
						Nome<br />
						<input type="text" class="formTxt obrigatorio" name="projeto_titulo" id="projeto_titulo" style="width:98%" value="<?=$aRow['projeto_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Resumo<br />
						<textarea name="projeto_resumo" id="projeto_resumo" rows="5" style="width:99%"><?=$aRow['projeto_resumo']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Thumb(150x115)<br />
						<?	if(is_file("../images/{$aRow['projeto_thumb']}")):?>
						<span>(<a href="javascript:void(0)" rel="projeto_thumb" class="delImg">Remover Imagem</a>)</span>
						<br />
						<?	endif;?>
						<input type="file" name="projeto_thumb" id="projeto_thumb" />
						<?	if(is_file("../images/{$aRow['projeto_thumb']}")):?>
						<br />
						<div class="images">
                        	<img src="../images/<?=$aRow['projeto_thumb']?>" />
                        </div>
						<?	endif;?>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição do Thumb<br />
						<textarea name="projeto_thumb_desc" id="projeto_thumb_desc" rows="5" style="width:99%"><?=$aRow['projeto_thumb_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="projeto_conteudo" id="projeto_conteudo" class="editor" rows="5" style="width:99%"><?=$aRow['projeto_conteudo']?></textarea>
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
						<input type="text" class="formTxt" name="projeto_fonte" id="projeto_fonte" style="width:98%" value="<?=$aRow['projeto_fonte']?>" />
					</td>
					<td colspan="2">
						Link da Fonte<br />
						<input type="text" class="formTxt" name="projeto_link_fonte" id="projeto_link_fonte" style="width:98%" value="<?=$aRow['projeto_link_fonte']?>" />
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Sob demanda?<br />
						<input value="S" type="checkbox" <?=$aRow['projeto_sob_demanda']=='S'?'checked="checked"':''?> name="projeto_sob_demanda" id="projeto_sob_demanda"/>&nbsp; Sim
                    </td>
                </tr>
				<tr>
            		<td>
						Periodo De<br />
						<input type="text" <?=$aRow['projeto_sob_demanda']=='S'?'disabled="disabled"':''?> class="formTxt datepicker" name="projeto_dt_ini" id="projeto_dt_ini" style="width:98%" value="<?=$aRow['projeto_dt_ini']?>" />
                    </td>
					<td>
						Periodo Ate<br />
						<input type="text" <?=$aRow['projeto_sob_demanda']=='S'?'disabled="disabled"':''?> class="formTxt datepicker" name="projeto_dt_fim" id="projeto_dt_fim" style="width:98%" value="<?=$aRow['projeto_dt_fim']?>" />
                    </td>
					<td>
						Agenda<br />
						<input type="text" class="formTxt obrigatorio datepicker" name="projeto_agenda" id="projeto_agenda" style="width:98%" value="<?=$aRow['projeto_agenda']?>" />
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
						<a href="projetoLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_projetoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
