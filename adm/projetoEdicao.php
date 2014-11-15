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

	$aGaleria = $obj->getGaleria();
	//$obj->debug($aGaleria);
	
	$aProjetoGaleria = $obj->getProjetoGaleria($aRow['projeto_id']);
	//$obj->debug($aProjetoGaleria);
	
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
					<td colspan="3">
						Tipo de Projeto<br />
						<select id="tipo_projeto_id" name="tipo_projeto_id" style="width:40%;">
							<?	if(count($aTipoProjeto) > 0):?>
							<?		foreach($aTipoProjeto AS $v):
										$selected = $v['tipo_projeto_id']==$aRow['tipo_projeto_id']?' selected="selected"':'';
							?>
							<option<?=$selected?> value="<?=$v['tipo_projeto_id']?>"><?=$v['tipo_projeto_titulo']?></option>
							<?		endforeach;?>
							<?	endif;?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
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
							<?php	foreach($aTags as $k =>$v){
										$selected = "";
										foreach($aRow['tags'] as $k2 => $v2){
											if($v['tag_id']==$v2['tag_id']){
												$selected = ' selected="selected"';
												break;
											}
										}
							?>
										<option value="<?=$v['tag_id']?>"<?=$selected?>><?=$v['tag_titulo']?></option>
							<?php	} ;?>
						</select>
					</td>
					<td>
						Termo Relacionado<br />
						<select class="formTxt" name="glossarios[]" id="glossarios" multiple="yes" style="width:99%;">
							<?php	foreach($aGlossarios as $k =>$v){
										$selected = "";
										foreach($aRow['glossarios'] as $k2 => $v2){
											if($v['glossario_id']==$v2['glossario_id']){
												$selected = ' selected="selected"';
												break;
											}
										}
							?>
										<option value="<?=$v['glossario_id']?>"<?=$selected?>><?=$v['glossario_palavra']?></option>
							<?php	} ;?>
						</select>
					</td>
					<td>
						Download<br />
						<select class="formTxt" name="downloads[]" id="downloads" multiple="yes" style="width:99%;">
							<?php	foreach($aDownloads as $k =>$v){
										$selected = "";
										foreach($aRow['downloads'] as $k2 => $v2){
											if($v['download_id']==$v2['download_id']){
												$selected = ' selected="selected"';
												break;
											}
										}
							?>
										<option value="<?=$v['download_id']?>"<?=$selected?>><?=$v['download_titulo']?></option>
							<?php	} ;?>
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
						<input type="text" class="formTxt datepicker" name="projeto_agenda" id="projeto_agenda" style="width:98%" value="<?=$aRow['projeto_agenda']?>" />
                    </td>
                </tr>
				<?	if(count($aExtras) > 0):?>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Informações Extras</strong>
					</td>
				</tr>
				<?php	
				foreach($aExtras as $k => $v){ ?>
				<tr>
					<td colspan="3">
					<?php echo $v['extra_nome_campo']; ?><br />
					
					<?php
						$value='';
						if(is_array($aRow['extras'])){
							foreach($aRow['extras'] as $k2 => $v2){
								if($v['extra_id']==$v2['extra_id']){
									$value = $v2['projeto_extra_valor'];
									break;
								}
							}
						}
					?>
					<textarea name="extras[<?php echo $v['extra_id'];?>]" id="extras_<?php echo $v['extra_id'];?>" rows="5" style="width:99%"><?php echo $value;?></textarea>					
					</td>
				</tr>
				<?php }	?>
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
									$selected = ($v['galeria_id']==$aProjetoGaleria['galeria_id'])?' selected="selected"':'';
							?>
							<option value="<?=$v['galeria_id']?>"<?=$selected?>><?=$v['galeria_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				
				<tr>
					<td align="right" colspan="3">
						<a href="projetoLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_projetoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
