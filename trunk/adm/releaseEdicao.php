<?php
	$path_root_releaseEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_releaseEdicao = "{$path_root_releaseEdicao}{$DS}..{$DS}";
	include_once "{$path_root_releaseEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_releaseEdicao}adm{$DS}class{$DS}release.class.php");
	$obj = new release();
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
	//$obj->debug($aRow);
	
	$aGaleria = $obj->getGaleria();
	//$obj->debug($aGaleria);
	
	$aReleaseGaleria = $obj->getReleaseGaleria($aRow['release_id']);
	//$obj->debug($aReleaseGaleria);
	
?>
<script type="text/javascript" src="js/release.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Release <strong>/ <?=isset($aRow['release_id'])?'Editar':'Cadastrar'?> Release</strong>
	</div>
	<form action="controller/release.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="release_id" id="release_id" value="<?=$aRow['release_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="releaseEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Release</strong>
					</td>
				</tr>
				<tr>
					<td width="150">
						Agenda<br />
						<input type="text" class="formTxt datepicker" name="release_dt_agenda" id="release_dt_agenda" style="width:95%" value="<?=$aRow['release_dt_agenda']?>" />
                    </td>
					<td width="150">
                    	Data (dd/mm/yyyy)<br />
                        <input class="formTxt datepicker <?=$class?> dt" <?=$readOnly?> value="<?=$obj->dateDB2BR($aRow['release_dt'])?>" type="text" name="release_dt" id="release_dt" style="width:95%" />
                    </td>
            		<td>
						<input value="S" type="checkbox" <?=$aRow['release_exibir_listagem']=='N'?'':'checked="checked"'?> name="release_exibir_listagem" id="release_exibir_listagem"/>&nbsp; Exibir na Listagem de Release?
                    </td>
                </tr>
				<tr>
					<td colspan="3">
						Título<br />
						<input type="text" class="formTxt obrigatorio" name="release_titulo" id="release_titulo" style="width:98%" value="<?=$aRow['release_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Título Síntese<br />
						<input type="text" class="formTxt obrigatorio" name="release_titulo_sintese" id="release_titulo_sintese" style="width:98%" value="<?=$aRow['release_titulo_sintese']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Resumo<br />
						<textarea name="release_resumo" id="release_resumo" rows="5" style="width:99%"><?=$aRow['release_resumo']?></textarea>
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Thumb(150x115)<br />
						<?	if(is_file("../images/{$aRow['release_thumb']}")):?>
						<span>(<a href="javascript:void(0)" rel="release_thumb" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
						<input type="file" name="release_thumb" id="release_thumb" />
						<?	if(is_file("../images/{$aRow['release_thumb']}")):?>
						<div class="images">
                        	<img src="../images/<?=$aRow['release_thumb']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição do Thumb<br />
						<textarea name="release_thumb_desc" id="release_thumb_desc" rows="5" style="width:99%"><?=$aRow['release_thumb_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Fonte<br />
						<input type="text" class="formTxt" name="release_fonte" id="release_fonte" style="width:98%" value="<?=$aRow['release_fonte']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Link da Fonte<br />
						<input type="text" class="formTxt" name="release_url_fonte" id="release_url_fonte" style="width:98%" value="<?=$aRow['release_url_fonte']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="release_conteudo" id="release_conteudo" class="editor" rows="5" style="width:99%"><?=$aRow['release_conteudo']?></textarea>
					</td>
				</tr>
				<!-- Sessão A - Exibir no Outdoor -->
				<tr>
            		<td colspan="3">
						<input value="S" type="checkbox" <?=$aRow['release_exibir_banner']=='S'?'checked="checked"':''?> name="release_exibir_banner" id="release_exibir_banner"/>&nbsp; Exibir no Outdoor?
                    </td>
                </tr>
				<tr>
            		<td colspan="3">
						Outdoor(517x227)<br />
						<?	if(is_file("../images/{$aRow['release_banner']}")):?>
						<span>(<a href="javascript:void(0)" <?=$aRow['release_exibir_banner']=='S'?'disabled="disabled"':''?> rel="release_banner" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
						<input type="file" name="release_banner" id="release_banner" />
						<?	if(is_file("../images/{$aRow['release_banner']}")):?>
						<div class="images">
                        	<img src="../images/<?=$aRow['release_banner']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>

				<tr>
					<td colspan="3">
						Descrição do Outdoor<br />
						<textarea name="release_banner_desc" <?=$aRow['release_exibir_banner']!='S'?'readonly="yes"':''?> id="release_banner_desc" rows="5" style="width:99%"><?=$aRow['release_banner_desc']?></textarea>
					</td>
				</tr>
				<!-- Sessão B - Exibir no Destaque -->
				<tr>
            		<td colspan="3">
						<input value="S" type="checkbox" <?=$aRow['release_exibir_destaque_home']=='S'?'checked="checked"':''?> name="release_exibir_destaque_home" id="release_exibir_destaque_home"/>&nbsp; Destacar na Home?
                    </td>
                </tr>
				<tr>
					<td colspan="3">
						Destaque Imagem(262x262)<br />
						<input type="file" name="release_destaque_home" id="release_destaque_home" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Destaque Imagem Descrição<br />
						<textarea name="release_destaque_home_desc" <?=$aRow['release_exibir_destaque_home']!='S'?'readonly="yes"':''?> id="release_destaque_home_desc" rows="5" style="width:99%"><?=$aRow['release_destaque_home_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Destaque Frase <br />
						<textarea name="release_destaque_home_frase" <?=$aRow['release_exibir_destaque_home']!='S'?'readonly="yes"':''?> id="release_destaque_home_frase" rows="5" style="width:99%"><?=$aRow['release_destaque_home_frase']?></textarea>
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
							<?php	
									foreach($aDownloads AS $k=>$v){
									if(is_array($aRow['downloads'])){
										$selected = in_array($v['download_id'], $aRow['downloads'])!==false?' selected="selected"':'';
									}else{
										$selected = "";
									}
							?>
							<option value="<?=$v['download_id']?>"<?=$selected?>><?=$v['download_titulo']?></option>
							<?php } ?>
						</select>
					</td>
					
				</tr>

				<tr class="tableHead">
					<td colspan="3">
						<strong>Habilitar Galeria</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Galeria<br />
						<select class="formTxt" name="galeria_id" style="width:98%" id="galeria_id">
							<option value="">[Selecione a Galeria Desejada]</option>
							<?	
								foreach($aGaleria AS $k=>$v):
									$selected = ($v['galeria_id']==$aReleaseGaleria['galeria_id'])?' selected="selected"':'';
							?>
							<option value="<?=$v['galeria_id']?>"<?=$selected?>><?=$v['galeria_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				
				<tr>
					<td align="right" colspan="3">
						<a href="releaseLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_releaseEdicao}adm{$DS}includes{$DS}footer.php"; ?>

