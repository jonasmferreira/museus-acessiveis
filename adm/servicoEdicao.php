<?php
	$path_root_servicoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_servicoEdicao = "{$path_root_servicoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_servicoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_servicoEdicao}adm{$DS}class{$DS}servico.class.php");
	$obj = new servico();
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
	$aTipoServico = $obj->getTipoServico();
	
	$aGaleria = $obj->getGaleria();
	//$obj->debug($aGaleria);
	
	$aServicoGaleria = $obj->getServicoGaleria($aRow['servico_id']);
	//$obj->debug($aServicoGaleria);
	
?>
<script type="text/javascript" src="js/servico.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Servicos <strong>/ <?=isset($aRow['servico_id'])?'Editar':'Cadastrar'?> Servico</strong>
	</div>
	<form action="controller/servico.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="servico_id" id="servico_id" value="<?=$aRow['servico_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="servicoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Servico</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Tipo<br />
						<select id="tipo_servico_id" name="tipo_servico_id">
							<?	if(count($aTipoServico) > 0):?>
							<?		foreach($aTipoServico AS $v):
										$selected = $v['tipo_servico_id']==$aRow['tipo_servico_id']?' selected="selected"':'';
							?>
							<option<?=$selected?> value="<?=$v['tipo_servico_id']?>"><?=$v['tipo_servico_titulo']?></option>
							<?		endforeach;?>
							<?	endif;?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Nome<br />
						<input type="text" class="formTxt obrigatorio" name="servico_titulo" id="servico_titulo" style="width:98%" value="<?=$aRow['servico_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Resumo<br />
						<textarea name="servico_resumo" id="servico_resumo" rows="5" style="width:99%"><?=$aRow['servico_resumo']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Thumb(150x115)<br />
						<?	if(is_file("../images/{$aRow['servico_thumb']}")):?>
						<span>(<a href="javascript:void(0)" rel="servico_thumb" class="delImg">Remover Imagem</a>)</span>
						<br />
						<?	endif;?>
						<input type="file" name="servico_thumb" id="servico_thumb" />
						<?	if(is_file("../images/{$aRow['servico_thumb']}")):?>
						<br />
						<div class="images">
                        	<img src="../images/<?=$aRow['servico_thumb']?>" />
                        </div>
						<?	endif;?>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição do Thumb<br />
						<textarea name="servico_thumb_desc" id="servico_thumb_desc" rows="5" style="width:99%"><?=$aRow['servico_thumb_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="servico_conteudo" id="servico_conteudo" class="editor" rows="5" style="width:99%"><?=$aRow['servico_conteudo']?></textarea>
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
						<input type="text" class="formTxt" name="servico_fonte" id="servico_fonte" style="width:98%" value="<?=$aRow['servico_fonte']?>" />
					</td>
					<td colspan="2">
						Link da Fonte<br />
						<input type="text" class="formTxt" name="servico_link_fonte" id="servico_link_fonte" style="width:98%" value="<?=$aRow['servico_link_fonte']?>" />
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Sob demanda?<br />
						<input value="S" type="checkbox" <?=$aRow['servico_sob_demanda']=='S'?'checked="checked"':''?> name="servico_sob_demanda" id="servico_sob_demanda"/>&nbsp; Sim
                    </td>
                </tr>
				<tr>
            		<td>
						Periodo De<br />
						<input type="text" <?=$aRow['servico_sob_demanda']=='S'?'disabled="disabled"':''?> class="formTxt datepicker" name="servico_dt_ini" id="servico_dt_ini" style="width:98%" value="<?=$aRow['servico_dt_ini']?>" />
                    </td>
					<td>
						Periodo Ate<br />
						<input type="text" <?=$aRow['servico_sob_demanda']=='S'?'disabled="disabled"':''?> class="formTxt datepicker" name="servico_dt_fim" id="servico_dt_fim" style="width:98%" value="<?=$aRow['servico_dt_fim']?>" />
                    </td>
					<td>
						Agenda<br />
						<input type="text" class="formTxt datepicker" name="servico_agenda" id="servico_agenda" style="width:98%" value="<?=$aRow['servico_agenda']?>" />
                    </td>
                </tr>

				<?	if(count($aExtras) > 0):?>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Informações Extras</strong>
					</td>
				</tr>
				<?	foreach($aExtras AS $v):?>
				<tr>
					<td colspan="3">
						<?=$v['extra_nome_campo']?><br />
						<textarea name="extras[<?php echo $v['extra_id'];?>]" id="extras_<?php echo $v['extra_id'];?>" rows="5" style="width:99%"><?=$aRow['extras'][$v['extra_id']]?></textarea>						
					</td>
				</tr>
				<?	endforeach;?>
				<?	endif;?>
				
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
									$selected = ($v['galeria_id']==$aServicoGaleria['galeria_id'])?' selected="selected"':'';
							?>
							<option value="<?=$v['galeria_id']?>"<?=$selected?>><?=$v['galeria_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>

				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="servicoLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_servicoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
