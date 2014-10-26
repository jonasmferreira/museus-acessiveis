<?php
	$path_root_emktNoticiaEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_emktNoticiaEdicao = "{$path_root_emktNoticiaEdicao}{$DS}..{$DS}";
	include_once "{$path_root_emktNoticiaEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_emktNoticiaEdicao}adm{$DS}class{$DS}emktNoticia.class.php");
	$obj = new emktNoticia();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	
?>
<script type="text/javascript" src="js/emktNoticia.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Newsletter <strong>/ <?=isset($aRow['emkt_noticia_id'])?'Editar':'Cadastrar'?> Notícias</strong>
	</div>
	<form action="controller/emktNoticia.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="emkt_noticia_id" id="emkt_noticia_id" value="<?=$aRow['emkt_noticia_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="emkt_noticiaEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Newsletter / Notícias</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
                    	Data (dd/mm/yyyy)<br />
                        <input type="text" class="formTxt datepicker" value="<?=$obj->dateDB2BR($aRow['emkt_noticia_dt'])?>" name="emkt_noticia_dt" id="emkt_noticia_dt" style="width:250px" />
                    </td>
                </tr>
				<tr>
					<td colspan="3">
						Título<br />
						<input type="text" class="formTxt obrigatorio" name="emkt_noticia_titulo" id="emkt_noticia_titulo" style="width:98%" value="<?=$aRow['emkt_noticia_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Título Síntese<br />
						<input type="text" class="formTxt obrigatorio" name="emkt_noticia_titulo_sintese" id="emkt_noticia_titulo_sintese" style="width:98%" value="<?=$aRow['emkt_noticia_titulo_sintese']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Resumo<br />
						<textarea name="emkt_noticia_resumo" id="emkt_noticia_resumo" rows="5" style="width:99%"><?=$aRow['emkt_noticia_resumo']?></textarea>
					</td>
				</tr>
				<tr>
            		<td colspan="3">
						Thumb(150x115)<br />
						<?	if(is_file("../images/{$aRow['emkt_noticia_thumb']}")):?>
						<span>(<a href="javascript:void(0)" rel="emkt_noticia_thumb" class="delImg">Remover Imagem</a>)</span>
						<?	endif;?>
						<br />
						<input type="file" name="emkt_noticia_thumb" id="emkt_noticia_thumb" />
						<?	if(is_file("../images/{$aRow['emkt_noticia_thumb']}")):?>
						<div class="images">
                        	<img src="../images/<?=$aRow['emkt_noticia_thumb']?>" />
                        </div>
						<?	endif;?>
                    </td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição do Thumb<br />
						<textarea name="emkt_noticia_thumb_desc" id="emkt_noticia_thumb_desc" rows="5" style="width:99%"><?=$aRow['emkt_noticia_thumb_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Fonte<br />
						<input type="text" class="formTxt" name="emkt_noticia_fonte" id="emkt_noticia_fonte" style="width:98%" value="<?=$aRow['emkt_noticia_fonte']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Link da Fonte<br />
						<input type="text" class="formTxt" name="emkt_noticia_url_fonte" id="emkt_noticia_url_fonte" style="width:98%" value="<?=$aRow['emkt_noticia_url_fonte']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Conteúdo<br />
						<textarea name="emkt_noticia_conteudo" id="emkt_noticia_conteudo" class="editor" rows="5" style="width:99%"><?=$aRow['emkt_noticia_conteudo']?></textarea>
					</td>
				</tr>
				<tr>
					<td align="right" colspan="3">
						<a href="emktNoticiaLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_emktNoticiaEdicao}adm{$DS}includes{$DS}footer.php"; ?>
