<?php
	$path_root_downloadEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_downloadEdicao = "{$path_root_downloadEdicao}{$DS}..{$DS}";
	include_once "{$path_root_downloadEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_downloadEdicao}adm{$DS}class{$DS}download.class.php");
	$obj = new download();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	$aTipoDownload = $obj->getTipoDownload();
	//$obj->debug($aRow);
?>
<script type="text/javascript" src="js/download.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Institucional / Downloads <strong>/ <?=isset($aRow['download_id'])?'Editar':'Cadastrar'?> Download</strong>
	</div>
	<form action="controller/download.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="download_id" id="autor_id" value="<?=$aRow['download_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="downloadEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Download</strong>
					</td>
				</tr>
				
				<tr>
					<td colspan="2">
						Tipo Download<br />
						<select class="formTxt obrigatorio" name="download_tipo" id="download_tipo">
							<?	foreach($aTipoDownload AS $k=>$v):
									$selected = $aRow['download_tipo']==$v['tipo_download_id']?' selected="selected"':'';
							?>
							<option value="<?=$v['tipo_download_id']?>"<?=$selected?>><?=$v['tipo_download_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
					<td align="right">
						<!-- campo de 1pixel não mudar -->
						<input type="text" name="download_tipo_desc" id="download_tipo_desc" style="width:1px; height: 1px;" value="<?=$aRow['download_tipo_desc']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Titulo<br />
						<input type="text" class="formTxt obrigatorio" name="download_titulo" id="download_titulo" style="width:98%" value="<?=$aRow['download_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Link Internet<br />
						<input type="text" class="formTxt" name="download_link" id="download_link" style="width:98%" value="<?=$aRow['download_arquivo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Arquivo<br />
						<input type="file" name="download_arquivo" id="download_arquivo" />
						<?	if(is_file("../arquivosDown/{$aRow['download_arquivo']}")):?>
						<br />
						<a href="<?="../arquivosDown/{$aRow['download_arquivo']}"?>" target="_blank" />Download</a>
						<?	endif;?>
					</td>
				</tr>
				<tr>
					<td align="right" colspan="3">
						<a href="downloadLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_downloadEdicao}adm{$DS}includes{$DS}footer.php"; ?>
