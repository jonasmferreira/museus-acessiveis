<?php
	$path_root_boxAgenda = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_boxAgenda = "{$path_root_boxAgenda}{$DS}";
	require_once "{$path_root_boxAgenda}adm{$DS}class{$DS}agenda.class.php";
	$objBoxAgenda = new agenda();
	$aArrAgenda = $objBoxAgenda->getAgendaGeral(date("m"), date("Y"));

	$aFiqueAtento = $objBoxAgenda->getFiqueAtento(date("m"), date("Y"));
	//$objBoxAgenda->debug($aFiqueAtento);
	
?>
		<style type='text/css'>
			.hidden{
				display:none !important;
			}
		</style>
		<div id="diary" style="background:none !important; padding-bottom: 0px;">
			<h1 tabIndex="61">Agenda Brasil de Acessibilidade</h1>
			<p tabIndex="62" class="description">
				Clique e saiba mais sobreos principais eventos&nbsp;da área de acessibilidade!!!
			</p>
			<div id="calendar">
				<div id="month-info">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td><a title="Mês Anterior" tabIndex="63" href="javascript:void(0);" id="mes_anterior" mes="<?=$aArrAgenda['mes']?>" ano="<?=$aArrAgenda['ano']?>" class="arrow-l"><strong>&lt;&lt;</strong></a></td>
							<td><a title="Mês de <?=$aArrAgenda['mesExtenso']?>" tabIndex="64" href=""><strong><?=$aArrAgenda['mesExtenso']?></strong></a></td>
							<td><span>|</span></td>
							<td><a title="Ano de <?=$aArrAgenda['ano']?>" tabIndex="65" href=""><strong><?=$aArrAgenda['ano']?></strong></a></td>
							<td><a title="Próximo Mês" tabIndex="66" href="javascript:void(0);" id="mes_posterior" mes="<?=$aArrAgenda['mes']?>" ano="<?=$aArrAgenda['ano']?>" class="arrow-r"><strong>&gt;&gt;</strong></a></td>
						</tr>
					</table>
				</div>
				<div id="month-days">
				   <table id='calendas' cellpadding="0" cellspacing="0" width="100%">
					   <thead>
						   <tr>
							   <td tabIndex="67" title="Domingo" align="center" valign="middle">D</td>
							   <td tabIndex="67" title="Segunda" align="center" valign="middle">S</td>
							   <td tabIndex="67" title="Terça" align="center" valign="middle">T</td>
							   <td tabIndex="67" title="Quarta" align="center" valign="middle">Q</td>
							   <td tabIndex="67" title="Quinta" align="center" valign="middle">Q</td>
							   <td tabIndex="67" title="Sexta" align="center" valign="middle">S</td>
							   <td tabIndex="67" title="Sábado" align="center" valign="middle">S</td>
						   </tr>
					   </thead>
					   <tbody>
						   <?	$tabIndex = 68;
							   foreach($aArrAgenda['dias'] AS $row):?>
						   <tr>
							   <?	foreach($row AS $dia):?>
									
								 <?php
										//encontrando o dia na string
										$pos = strpos($dia,'>');
										$msgDia = substr($dia,$pos+1,strlen($dia));
										$pos = strpos($msgDia,'<');
										$msgDia = substr($msgDia,0,$pos);
								 ?>
								 
							   <td tabIndex="<?=$tabIndex?>" align="center" valign="middle" title="Dia <?=$msgDia?>"><?=$dia?></td>
							   <?		$tabIndex++;
								   endforeach;?>
						   </tr>
						   <?	endforeach;?>
					   </tbody>
				   </table>
			   </div>
			</div>
		</div>
		
		
		<?php if($aFiqueAtento['records']>0){  ?>
		
		<div id="atento">
			<h1 tabIndex="102">Fique atento!</h1>
			<div class="atento-item">
				<ul title="Datas importantes do mês">
			<?php
				foreach($aFiqueAtento['rows'] as $k => $v){
?>
					<li>
						<div tabIndex="103" id="day"><?=$v['item_dt_agenda_dia'];?></div>
						<h3 tabIndex="104" id="month"><?=$aFiqueAtento['mesExtenso'];?></h3>
						<div style="height:10px;"></div>
						<span tabIndex="105" id="event"><a href="<?=$linkAbsolute;?><?=$v['item_tipo_link'];?>/<?=$v['item_id'];?>/<?=$v['item_titulo'];?>"><?=$v['item_titulo'];?></a></span>
					</li>
<?php			
				}
			?>
				</ul>
			</div>
			<div id="agenda-link">
				<a href="<?=$linkAbsolute;?>agenda" class="purple-color">
					<b>Fique por dentro da<br />
					Agenda Brasil de Acessibilidade</b>
				</a>
			</div>
			
		</div>
		
<?php } ?>


		
		