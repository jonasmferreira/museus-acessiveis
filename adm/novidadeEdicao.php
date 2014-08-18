<?php
	$path_root_novidadeEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_novidadeEdicao = "{$path_root_novidadeEdicao}{$DS}..{$DS}";
	include_once "{$path_root_novidadeEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_novidadeEdicao}adm{$DS}class{$DS}novidade.class.php");
	$obj = new novidade();
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
	$aDownloads = $obj->getDownload();
	
?>
<script type="text/javascript" src="js/novidade.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Novidades 360º <strong>/ <?=isset($aRow['novidade_360_id'])?'Editar':'Cadastrar'?> Novidades 360º</strong>
	</div>
	<form action="controller/novidade.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="novidade_360_id" id="novidade_360_id" value="<?=$aRow['novidade_360_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="novidadeEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Novidades 360º</strong>
					</td>
				</tr>
				<tr>
					<td width="150">
						Agenda<br />
						<input type="text" class="formTxt datepicker" name="novidade_360_dt_agenda" id="novidade_360_dt_agenda" style="width:95%" value="<?=$aRow['novidade_360_dt_agenda']?>" />
                    </td>
					<td width="150">
                    	Data (dd/mm/yyyy)<br />
                        <input disabled="disabled" <?=$readOnly?> value="<?=$obj->dateDB2BR($aRow['novidade_360_dt'])?>" type="text" class="formTxt <?=$class?> dt" name="novidade_360_dt" id="novidade_360_dt" style="width:95%" />
                    </td>
            		<td>
						<input value="S" type="checkbox" <?=$aRow['novidade_360_exibir_listagem']=='N'?'':'checked="checked"'?> name="novidade_360_exibir_listagem" id="novidade_360_exibir_listagem"/>&nbsp; Exibir na Listagem de Novidades?
                    </td>
                </tr>
				<tr>
					<td colspan="3">
						Título<br />
						<input type="text" class="formTxt obrigatorio" name="novidade_360_titulo" id="novidade_360_titulo" style="width:98%" value="<?=$aRow['novidade_360_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Título Síntese<br />
						<input type="text" class="formTxt obrigatorio" name="novidade_360_titulo_sintese" id="novidade_360_titulo_sintese" style="width:98%" value="<?=$aRow['novidade_360_titulo_sintese']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Resumo<br />
						<textarea name="novidade_360_resumo" id="novidade_360_resumo" rows="5" style="width:99%"><?=$aRow['novidade_360_resumo']?></textarea>
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Thumb(150x115)<br />
						<?	if(is_file("../images/{$aRow['novidade_360_thumb']}")):?>
						<span>(<a href="javascript:void(0)" rel="novidade_360_thumb" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
						<input type="file" name="novidade_360_thumb" id="novidade_360_thumb" />
						<?	if(is_file("../images/{$aRow['novidade_360_thumb']}")):?>
						<div class="images">
                        	<img src="../images/<?=$aRow['novidade_360_thumb']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição do Thumb<br />
						<textarea name="novidade_360_thumb_desc" id="novidade_360_thumb_desc" rows="5" style="width:99%"><?=$aRow['novidade_360_thumb_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Fonte<br />
						<input type="text" class="formTxt" name="novidade_360_fonte" id="novidade_360_fonte" style="width:98%" value="<?=$aRow['novidade_360_fonte']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Link da Fonte<br />
						<input type="text" class="formTxt" name="novidade_360_url_fonte" id="novidade_360_url_fonte" style="width:98%" value="<?=$aRow['novidade_360_url_fonte']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="novidade_360_conteudo" id="novidade_360_conteudo" class="editor" rows="5" style="width:99%"><?=$aRow['novidade_360_conteudo']?></textarea>
					</td>
				</tr>
				<!-- Sessão A - Exibir no Outdoor -->
				<tr>
            		<td colspan="3">
						<input value="S" type="checkbox" <?=$aRow['novidade_360_exibir_banner']=='S'?'checked="checked"':''?> name="novidade_360_exibir_banner" id="novidade_360_exibir_banner"/>&nbsp; Exibir no Outdoor?
                    </td>
                </tr>
				<tr>
            		<td colspan="3">
						Outdoor(517x227)<br />
						<?	if(is_file("../images/{$aRow['novidade_360_banner']}")):?>
						<span>(<a href="javascript:void(0)" <?=$aRow['novidade_360_exibir_banner']=='S'?'disabled="disabled"':''?> rel="novidade_360_banner" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
						<input type="file" name="novidade_360_banner" id="novidade_360_banner" />
						<?	if(is_file("../images/{$aRow['novidade_360_banner']}")):?>
						<div class="images">
                        	<img src="../images/<?=$aRow['novidade_360_banner']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>

				<tr>
					<td colspan="3">
						Descrição do Outdoor<br />
						<textarea name="novidade_360_banner_desc" <?=$aRow['novidade_360_exibir_banner']!='S'?'readonly="yes"':''?> id="novidade_360_banner_desc" rows="5" style="width:99%"><?=$aRow['novidade_360_banner_desc']?></textarea>
					</td>
				</tr>
				<!-- Sessão B - Exibir no Destaque -->
				<tr>
            		<td colspan="3">
						<input value="S" type="checkbox" <?=$aRow['novidade_360_exibir_destaque_home']=='S'?'checked="checked"':''?> name="novidade_360_exibir_destaque_home" id="novidade_360_exibir_destaque_home"/>&nbsp; Destacar na Home?
                    </td>
                </tr>
				<tr>
					<td colspan="3">
						Destaque Imagem(262x262)<br />
						<input type="file" name="novidade_360_destaque_home" id="novidade_360_destaque_home" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Destaque Imagem Descrição<br />
						<textarea name="novidade_360_destaque_home_desc" <?=$aRow['novidade_360_exibir_destaque_home']!='S'?'readonly="yes"':''?> id="novidade_360_destaque_home_desc" rows="5" style="width:99%"><?=$aRow['novidade_360_destaque_home_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Destaque Frase <br />
						<textarea name="novidade_360_destaque_home_frase" <?=$aRow['novidade_360_exibir_destaque_home']!='S'?'readonly="yes"':''?> id="novidade_360_destaque_home_frase" rows="5" style="width:99%"><?=$aRow['novidade_360_destaque_home_frase']?></textarea>
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
					<td align="right" colspan="3">
						<a href="novidadeLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_novidadeEdicao}adm{$DS}includes{$DS}footer.php"; ?>
