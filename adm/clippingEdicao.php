<?php
	$path_root_clippingEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_clippingEdicao = "{$path_root_clippingEdicao}{$DS}..{$DS}";
	include_once "{$path_root_clippingEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_clippingEdicao}adm{$DS}class{$DS}clipping.class.php");
	$obj = new clipping();
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
	
	$aClippingGaleria = $obj->getClippingGaleria($aRow['clipping_id']);
	//$obj->debug($aClippingGaleria);
	
?>
<script type="text/javascript" src="js/clipping.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / clipping <strong>/ <?=isset($aRow['clipping_id'])?'Editar':'Cadastrar'?> clipping</strong>
	</div>
	<form action="controller/clipping.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="clipping_id" id="clipping_id" value="<?=$aRow['clipping_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="clippingEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Clipping</strong>
					</td>
				</tr>
				<tr>
					<td width="150">
						Agenda<br />
						<input type="text" class="formTxt datepicker" name="clipping_dt_agenda" id="clipping_dt_agenda" style="width:95%" value="<?=$aRow['clipping_dt_agenda']?>" />
                    </td>
					<td width="150">
                    	Data (dd/mm/yyyy)<br />
                        <input class="formTxt datepicker <?=$class?> dt" <?=$readOnly?> value="<?=$obj->dateDB2BR($aRow['clipping_dt'])?>" type="text" name="clipping_dt" id="clipping_dt" style="width:95%" />
                    </td>
            		<td>
						<input value="S" type="checkbox" <?=$aRow['clipping_exibir_listagem']=='N'?'':'checked="checked"'?> name="clipping_exibir_listagem" id="clipping_exibir_listagem"/>&nbsp; Exibir na Listagem de clipping?
                    </td>
                </tr>
				<tr>
					<td colspan="3">
						Título<br />
						<input type="text" class="formTxt obrigatorio" name="clipping_titulo" id="clipping_titulo" style="width:98%" value="<?=$aRow['clipping_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Título Síntese<br />
						<input type="text" class="formTxt obrigatorio" name="clipping_titulo_sintese" id="clipping_titulo_sintese" style="width:98%" value="<?=$aRow['clipping_titulo_sintese']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Resumo<br />
						<textarea name="clipping_resumo" id="clipping_resumo" rows="5" style="width:99%"><?=$aRow['clipping_resumo']?></textarea>
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Thumb(150x115)<br />
						<?	if(is_file("../images/{$aRow['clipping_thumb']}")):?>
						<span>(<a href="javascript:void(0)" rel="clipping_thumb" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
						<input type="file" name="clipping_thumb" id="clipping_thumb" />
						<?	if(is_file("../images/{$aRow['clipping_thumb']}")):?>
						<div class="images">
                        	<img src="../images/<?=$aRow['clipping_thumb']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição do Thumb<br />
						<textarea name="clipping_thumb_desc" id="clipping_thumb_desc" rows="5" style="width:99%"><?=$aRow['clipping_thumb_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Fonte<br />
						<input type="text" class="formTxt" name="clipping_fonte" id="clipping_fonte" style="width:98%" value="<?=$aRow['clipping_fonte']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Link da Fonte<br />
						<input type="text" class="formTxt" name="clipping_url_fonte" id="clipping_url_fonte" style="width:98%" value="<?=$aRow['clipping_url_fonte']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="clipping_conteudo" id="clipping_conteudo" class="editor" rows="5" style="width:99%"><?=$aRow['clipping_conteudo']?></textarea>
					</td>
				</tr>
				<!-- Sessão A - Exibir no Outdoor -->
				<tr>
            		<td colspan="3">
						<input value="S" type="checkbox" <?=$aRow['clipping_exibir_banner']=='S'?'checked="checked"':''?> name="clipping_exibir_banner" id="clipping_exibir_banner"/>&nbsp; Exibir no Outdoor?
                    </td>
                </tr>
				<tr>
            		<td colspan="3">
						Outdoor(517x227)<br />
						<?	if(is_file("../images/{$aRow['clipping_banner']}")):?>
						<span>(<a href="javascript:void(0)" <?=$aRow['clipping_exibir_banner']=='S'?'disabled="disabled"':''?> rel="clipping_banner" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
						<input type="file" name="clipping_banner" id="clipping_banner" />
						<?	if(is_file("../images/{$aRow['clipping_banner']}")):?>
						<div class="images">
                        	<img src="../images/<?=$aRow['clipping_banner']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>

				<tr>
					<td colspan="3">
						Descrição do Outdoor<br />
						<textarea name="clipping_banner_desc" <?=$aRow['clipping_exibir_banner']!='S'?'readonly="yes"':''?> id="clipping_banner_desc" rows="5" style="width:99%"><?=$aRow['clipping_banner_desc']?></textarea>
					</td>
				</tr>
				<!-- Sessão B - Exibir no Destaque -->
				<tr>
            		<td colspan="3">
						<input value="S" type="checkbox" <?=$aRow['clipping_exibir_destaque_home']=='S'?'checked="checked"':''?> name="clipping_exibir_destaque_home" id="clipping_exibir_destaque_home"/>&nbsp; Destacar na Home?
                    </td>
                </tr>
				<tr>
					<td colspan="3">
						Destaque Imagem(262x262)<br />
						<input type="file" name="clipping_destaque_home" id="clipping_destaque_home" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Destaque Imagem Descrição<br />
						<textarea name="clipping_destaque_home_desc" <?=$aRow['clipping_exibir_destaque_home']!='S'?'readonly="yes"':''?> id="clipping_destaque_home_desc" rows="5" style="width:99%"><?=$aRow['clipping_destaque_home_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Destaque Frase <br />
						<textarea name="clipping_destaque_home_frase" <?=$aRow['clipping_exibir_destaque_home']!='S'?'readonly="yes"':''?> id="clipping_destaque_home_frase" rows="5" style="width:99%"><?=$aRow['clipping_destaque_home_frase']?></textarea>
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
									$selected = ($v['galeria_id']==$aClippingGaleria['galeria_id'])?' selected="selected"':'';
							?>
							<option value="<?=$v['galeria_id']?>"<?=$selected?>><?=$v['galeria_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				
				<tr>
					<td align="right" colspan="3">
						<a href="clippingLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_clippingEdicao}adm{$DS}includes{$DS}footer.php"; ?>

