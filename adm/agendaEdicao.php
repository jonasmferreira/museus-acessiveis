<?php
	$path_root_agendaEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_agendaEdicao = "{$path_root_agendaEdicao}{$DS}..{$DS}";
	include_once "{$path_root_agendaEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_agendaEdicao}adm{$DS}class{$DS}agenda.class.php");
	$obj = new agenda();
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
?>
<script type="text/javascript" src="js/agenda.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Agendas <strong>/ <?=isset($aRow['agenda_id'])?'Editar':'Cadastrar'?> Agenda</strong>
	</div>
	<form action="controller/agenda.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="agenda_id" id="agenda_id" value="<?=$aRow['agenda_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="agendaEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Agenda</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Titulo<br />
						<input type="text" class="formTxt obrigatorio" name="agenda_titulo" id="agenda_titulo" style="width:98%" value="<?=$aRow['agenda_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Resumo<br />
						<textarea name="agenda_resumo" id="agenda_resumo" rows="5" style="width:99%"><?=$aRow['agenda_resumo']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Imagem(517x227)<br />
						<?	if(is_file("../images/{$aRow['agenda_img']}")):?>
						<span>(<a href="javascript:void(0)" rel="agenda_img" class="delImg">Remover Imagem</a>)</span>
						<br />
						<?	endif;?>
						<input type="file" name="agenda_img" id="agenda_img" />
						<?	if(is_file("../images/{$aRow['agenda_img']}")):?>
						<br />
						<div class="images">
                        	<img src="../images/<?=$aRow['agenda_img']?>" />
                        </div>
						<?	endif;?>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição do Imagem<br />
						<textarea name="agenda_img_desc" id="agenda_img_desc" rows="5" style="width:99%"><?=$aRow['agenda_img_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="agenda_conteudo" id="agenda_conteudo" class="editor" rows="5" style="width:99%"><?=$aRow['agenda_conteudo']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
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
				</tr>
				<tr>
					<td>
						Fonte<br />
						<input type="text" class="formTxt" name="agenda_fonte" id="agenda_fonte" style="width:98%" value="<?=$aRow['agenda_fonte']?>" />
					</td>
					<td colspan="2">
						Link da Fonte<br />
						<input type="text" class="formTxt" name="agenda_link_fonte" id="agenda_link_fonte" style="width:98%" value="<?=$aRow['agenda_link_fonte']?>" />
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Exibir?<br />
						<input value="S" type="checkbox" <?=$aRow['agenda_exibir']=='S'?'checked="checked"':''?> name="agenda_exibir" id="agenda_exibir"/>&nbsp; Sim
                    </td>
                </tr>
				<tr>
					<td>
						Agenda<br />
						<input type="text" class="formTxt obrigatorio datepicker" name="agenda_dt" id="agenda_dt" style="width:98%" value="<?=$aRow['agenda_dt']?>" />
                    </td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
                </tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="agendaLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_agendaEdicao}adm{$DS}includes{$DS}footer.php"; ?>
