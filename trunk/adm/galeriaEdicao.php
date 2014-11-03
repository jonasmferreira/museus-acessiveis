<?php
	$path_root_galeriaEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_galeriaEdicao = "{$path_root_galeriaEdicao}{$DS}..{$DS}";
	include_once "{$path_root_galeriaEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_galeriaEdicao}adm{$DS}class{$DS}galeria.class.php");

	$obj = new galeria();
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
<script type="text/javascript" src="js/galeria.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Institucional / Galerias <strong>/ <?=isset($aRow['galeria_id'])?'Editar':'Cadastrar'?> Download</strong>
	</div>
	<form action="controller/galeria.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="galeria_id" id="autor_id" value="<?=$aRow['galeria_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="galeriaEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados da galeria</strong>
					</td>
				</tr>
				
				<tr>
					<td colspan="3">
						Titulo<br />
						<input type="text" class="formTxt obrigatorio" name="galeria_titulo" id="galeria_titulo" style="width:98%" value="<?=$aRow['galeria_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição<br />
						<input type="text" class="formTxt" name="galeria_descricao" id="galeria_descricao" style="width:98%" value="<?=$aRow['galeria_descricao']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Resumo<br />
						<input type="text" class="formTxt" name="galeria_resumo" id="galeria_resumo" style="width:98%" value="<?=$aRow['galeria_resumo']?>" />
					</td>
				</tr>
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" id="formCadastroImagem" class="formTable">
			<thead>
				<tr class="tableHead">
					<td colspan="5">
						<strong>Imagens da galeria</strong>
					</td>
				</tr>
				<tr>
					<th style="text-align:left;"><a href="javascript:void(0);" class="butCadastro" id="butAddImg">Adicionar</a></th>
					<th>Titulo</th>
					<th>Descrição</th>
					<th>Imagem</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				<?	if(count($aRow['galeriaImagens']) >0):?>
				<?		foreach($aRow['galeriaImagens'] AS $v):?>
				<tr>
					<td>
						<input class="formTxt" type="hidden" name="galeria_imagem_id[<?=$v['galeria_imagem_id']?>]" value="<?=$v['galeria_imagem_id']?>" class="galeria_imagem_id" />
					</td>
					<td>
						<input class="formTxt" type="text" name="galeria_imagem_titulo[<?=$v['galeria_imagem_id']?>]" value="<?=$v['galeria_imagem_titulo']?>" />
					</td>
					<td>
						<?	if(is_file("../galeriaImagem/{$v['galeria_imagem_arq']}")):?>
						<div class="images">
                        	<img src="../galeriaImagem/<?=$v['galeria_imagem_arq']?>" width="50" />
                        </div>
						<?	endif;?>
						<input class="formTxt" type="file" name="galeria_imagem_arq[<?=$v['galeria_imagem_id']?>]" value="" />
					</td>
					<td>
						<input class="formTxt" type="text" name="galeria_imagem_descricao[<?=$v['galeria_imagem_id']?>]" value="<?=$v['galeria_imagem_descricao']?>" />
					</td>
					<td>
						<a href="javascript:void(0);" class="btDel notDelImg">Excluir</a>
					</td>
				</tr>
				<?		endforeach;?>
				<?	endif;?>
			</tbody>
			<tfoot>
				<tr>
					<td align="right" colspan="5">
						<a href="galeriaLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tfoot>
		</table>
	</form>
</div>
<?php include_once "{$path_root_galeriaEdicao}adm{$DS}includes{$DS}footer.php"; ?>
