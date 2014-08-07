<?php
	$path_root_emailmktEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_emailmktEdicao = "{$path_root_emailmktEdicao}{$DS}..{$DS}";
	include_once "{$path_root_emailmktEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_emailmktEdicao}adm{$DS}class{$DS}emailmkt.class.php");
	$obj = new emailmkt();
	$aStatus = $obj->getStatus();
	$aServicoIds = $obj->getServico();
	$aProjetoIds = $obj->getProjeto();
	$aGlossarioIds = $obj->getGlossario();
	$aNovidadeIds = $obj->getNovidade360();
	$aAgendas = $obj->getAgenda();
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
<script type="text/javascript" src="js/emailmkt.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Institucional <strong>/ <?=isset($aRow['emailmkt_id'])?'Editar':'Cadastrar'?> E-mail Marketing</strong>
	</div>
	<form action="controller/emailmkt.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="emailmkt_id" id="emailmkt_id" value="<?=$aRow['emailmkt_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="emailmktEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do E-mail Marketing</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Status<br />
						<select class="formTxt obrigatorio" name="emailmkt_status" id="emailmkt_status">
							<?	foreach($aStatus AS $k=>$v):
									$selected = $aRow['emailmkt_status']==$v['id']?' selected="selected"':'';
							?>
							<option value="<?=$v['id']?>"<?=$selected?>><?=$v['titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Titulo<br />
						<input type="text" class="formTxt obrigatorio" name="emailmkt_titulo" id="emailmkt_titulo" style="width:98%" value="<?=$aRow['emailmkt_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td>
						Data de Agendamento<br />
						<input type="text" class="formTxt datepicker" name="emailmkt_dt_agendada" id="emailmkt_dt_agendada" style="width:98%" value="<?=$aRow['emailmkt_dt_agendada']?>" />
                    </td>
					<td>
						Hora de Agendamento<br />
						<input type="text" class="formTxt hr" name="emailmkt_hr_agendada" id="emailmkt_hr_agendada" style="width:98%" value="<?=$aRow['emailmkt_hr_agendada']?>" />
                    </td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">
						Serviços<br />
						<select class="formTxt obrigatorio" name="emailmkt_servico_ids[]" style="width:98%" multiple="yes" id="emailmkt_servico_ids">
							<?	$aServs = array();
								if(trim($aRow['emailmkt_servico_ids'])!=""){
									$aServs = explode(",",$aRow['emailmkt_servico_ids']);
								}
								foreach($aServicoIds AS $k=>$v):
									$selected = in_array($v['servico_id'], $aServs)!==false?' selected="selected"':'';
							?>
							<option value="<?=$v['servico_id']?>"<?=$selected?>><?=$v['servico_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Projeto<br />
						<select class="formTxt obrigatorio" name="emailmkt_projeto_ids[]" style="width:98%" multiple="yes" id="emailmkt_projeto_ids">
							<?	$aProjs = array();
								if(trim($aRow['emailmkt_projeto_ids'])!=""){
									$aProjs = explode(",",$aRow['emailmkt_projeto_ids']);
								}
								foreach($aProjetoIds AS $k=>$v):
									$selected = in_array($v['projeto_id'], $aProjs)!==false?' selected="selected"':'';
							?>
							<option value="<?=$v['projeto_id']?>"<?=$selected?>><?=$v['projeto_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Glossário<br />
						<select class="formTxt obrigatorio" name="emailmkt_glossario_ids[]" style="width:98%" multiple="yes" id="emailmkt_glossario_ids">
							<?	$aGloss = array();
								if(trim($aRow['emailmkt_glossario_ids'])!=""){
									$aGloss = explode(",",$aRow['emailmkt_glossario_ids']);
								}
								foreach($aGlossarioIds AS $k=>$v):
									$selected = in_array($v['glossario_id'], $aGloss)!==false?' selected="selected"':'';
							?>
							<option value="<?=$v['glossario_id']?>"<?=$selected?>><?=$v['glossario_palavra']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Novidades 360º (Destaque)<br />
						<select class="formTxt obrigatorio" name="emailmkt_novidade360_id" style="width:98%" id="emailmkt_novidade360_id">
							<?	
								foreach($aNovidadeIds AS $k=>$v):
									$selected = ($v['novidade_360_id']==$aRow['emailmkt_novidade360_id'])?' selected="selected"':'';
							?>
							<option value="<?=$v['novidade_360_id']?>"<?=$selected?>><?=$v['novidade_360_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Novidades 360º<br />
						<select class="formTxt obrigatorio" name="emailmkt_novidade360_ids[]" style="width:98%" multiple="yes" id="emailmkt_novidade360_ids">
							<?	$aProjs = array();
								if(trim($aRow['emailmkt_novidade360_ids'])!=""){
									$aProjs = explode(",",$aRow['emailmkt_novidade360_ids']);
								}
								foreach($aNovidadeIds AS $k=>$v):
									$selected = in_array($v['novidade_360_id'], $aProjs)!==false?' selected="selected"':'';
							?>
							<option value="<?=$v['novidade_360_id']?>"<?=$selected?>><?=$v['novidade_360_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Agenda<br />
						<select class="formTxt obrigatorio" name="emailmkt_agenda_ids[]" style="width:98%" multiple="yes" id="emailmkt_agenda_ids">
							<?	$aProjs = array();
								if(trim($aRow['emailmkt_agenda_ids'])!=""){
									$aProjs = explode(",",$aRow['emailmkt_agenda_ids']);
								}
								foreach($aAgendas AS $k=>$v):
									$selected = in_array($v['item_id']."=>".$v['item_tipo'], $aProjs)!==false?' selected="selected"':'';
							?>
							<option value="<?=$v['item_id']."=>".$v['item_tipo']?>"<?=$selected?>><?=$v['item_dt_agenda_label']?> - <?=$v['item_tipo_label']?> - <?=$v['item_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Seção Aqui Tem</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Titulo<br />
						<input type="text" class="formTxt obrigatorio" name="emailmkt_aqui_tem_titulo" id="emailmkt_aqui_tem_titulo" style="width:98%" value="<?=$aRow['emailmkt_aqui_tem_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Resumo<br />
						<textarea class="formTxt obrigatorio" rows="5" name="emailmkt_aqui_tem_resumo" id="emailmkt_aqui_tem_resumo" style="width:98%"><?=$aRow['emailmkt_aqui_tem_resumo']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						URL<br />
						<input type="text" class="formTxt obrigatorio" name="emailmkt_aqui_tem_url" id="emailmkt_aqui_tem_url" style="width:98%" value="<?=$aRow['emailmkt_aqui_tem_url']?>" />
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Thumb<br />
						<?	if(is_file("../imgEmkt/{$aRow['emailmkt_aqui_tem_thumb']}")):?>
						<span>(<a href="javascript:void(0)" rel="emailmkt_aqui_tem_thumb" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
						<input type="file" name="emailmkt_aqui_tem_thumb" id="emailmkt_aqui_tem_thumb" />
						<?	if(is_file("../imgEmkt/{$aRow['emailmkt_aqui_tem_thumb']}")):?>
						<div class="images">
                        	<img src="../imgEmkt/<?=$aRow['emailmkt_aqui_tem_thumb']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>
				<tr>
            		<td colspan="3">
						Propaganda<br />
						<?	if(is_file("../imgEmkt/{$aRow['emailmkt_propaganda_img']}")):?>
						<span>(<a href="javascript:void(0)" rel="emailmkt_propaganda_img" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
						<input type="file" name="emailmkt_propaganda_img" id="emailmkt_propaganda_img" />
						<?	if(is_file("../imgEmkt/{$aRow['emailmkt_propaganda_img']}")):?>
						<div class="images">
                        	<img src="../imgEmkt/<?=$aRow['emailmkt_propaganda_img']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>
				<tr>
					<td align="right" colspan="3">
						<a href="emailmktLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_emailmktEdicao}adm{$DS}includes{$DS}footer.php"; ?>
