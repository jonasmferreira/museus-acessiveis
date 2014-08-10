<?php
	$path_root_quemSomosEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_quemSomosEdicao = "{$path_root_quemSomosEdicao}{$DS}..{$DS}";
	include_once "{$path_root_quemSomosEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_quemSomosEdicao}adm{$DS}class{$DS}quemSomos.class.php");
	$obj = new quemSomos();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	$readOnly = ' readonly="yes"';
	$class = '';
	
	//$obj->debug($aRow);
	
?>
<script type="text/javascript" src="js/quemSomos.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Institucional / Quem Somos <strong>/ Editar</strong>
	</div>
	<form action="controller/quemSomos.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="texto_id" id="post_id" value="<?=$aRow['texto_id']?>" />
		<input type="hidden" name="volta" id="volta" value="quemSomosEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Institucional - Quem Somos</strong>
					</td>
				</tr>
				<tr>
            		<td colspan="3">
                    	Data (dd/mm/yyyy)<br />
                        <input <?=$readOnly?> value="<?=$obj->dateDB2BR($aRow['texto_dt'])?>" type="text" class="formTxt <?=$class?> dt" name="texto_dt" id="texto_dt" />
                    </td>
                </tr>
            	<tr>
            		<td colspan="3">
                    	Conteúdo<br />
                    	<div class="formTxt" style="width:926px;">
							<textarea name="texto_conteudo" id="texto_conteudo" class="editor obrigatorio" rows="6" style="width:926px"><?=$aRow['texto_conteudo']?></textarea>
                        </div>
                    </td>
                </tr>
            	<tr>
                    <td colspan="3" align="right">
    	        		<a href="home.php" class="butVoltar">Voltar</a>&nbsp;
                    	<input type="button" value="Salvar" id="salvar" class="butSalvar" />
                    </td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_quemSomosEdicao}adm{$DS}includes{$DS}footer.php"; ?>
