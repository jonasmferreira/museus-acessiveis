<?php
	$path_root_boxDepoimento = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_boxDepoimento = "{$path_root_boxDepoimento}{$DS}";

	include_once("{$path_root_boxDepoimento}adm{$DS}class{$DS}depoimento.class.php");
	$objDepoimento = new depoimento();

	//itens do outdoor
	$objDepoimento->setValues(array(
		'page'=>'1'
		,'rows'=>'500000'
	));
	$objDepoimento->setAOrderBy(array(
		't.depoimento_dt' => 'DESC'
	));
	$aDepoimento = $objDepoimento->getLista();
	//$objDepoimento->debug($aDepoimento);
	
?>
		<style type='text/css'>
			.hidden{
				display:none !important;
			}
		</style>
		
		<?php if($aDepoimento['records']>0){  ?>
		
		<div id="depoimento">
        	<h1 tabIndex="61">Depoimentos</h1>
            <!--p tabIndex="62" class="description"></p-->
			<div class="depoimento-box">
				<ul>
			<?php
				foreach($aDepoimento['rows'] as $k => $v){
?>
					<li>
						<div><strong tabIndex="104" class="description"><?=substr($v['depoimento_conteudo'],0,300).'...';?></strong></div>
						<div style="height:5px;"></div>
						<div><strong tabIndex="104" class="author"><?=$v['depoimento_autor'];?></strong></div>
						<div><strong tabIndex="104" class="company"><?=$v['depoimento_empresa'];?></strong></div>
					</li>
<?php			
				}
			?>
				</ul>
			</div>
			<div id="link">
				<a href="<?=$linkAbsolute;?>depoimento" class="purple-color">
					<b>Ver todos</b>
				</a>
			</div>
		</div>
		
<?php } ?>