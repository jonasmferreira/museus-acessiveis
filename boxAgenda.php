<?php
	$path_root_boxAgenda = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_boxAgenda = "{$path_root_boxAgenda}{$DS}";
	require_once "{$path_root_boxAgenda}adm{$DS}class{$DS}agenda.class.php";
	$objBoxAgenda = new agenda();
	$aArrAgenda = $objBoxAgenda->getAgendaGeral(date("m"), date("Y"));
	
?>
		<style type='text/css'>
			.hidden{
				display:none !important;
			}
		</style>
		<div id="diary">
        	<h1 tabIndex="61">Agenda Brasil de Acessibilidade</h1>
            <p tabIndex="62" class="description">
				Clique e saiba mais sobreos principais eventosda área de acessibilidade!!!
			</p>
			<div id="calendar">
				<div id="month-info">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td><a tabIndex="63" href="javascript:void(0);" id="mes_anterior" mes="<?=$aArrAgenda['mes']?>" ano="<?=$aArrAgenda['ano']?>" class="arrow-l"><strong>&lt;&lt;</strong></a></td>
							<td><a tabIndex="64" href=""><strong><?=$aArrAgenda['mesExtenso']?></strong></a></td>
							<td><span>|</span></td>
							<td><a tabIndex="65" href=""><strong><?=$aArrAgenda['ano']?></strong></a></td>
							<td><a tabIndex="66" href="javascript:void(0);" id="mes_posterior" mes="<?=$aArrAgenda['mes']?>" ano="<?=$aArrAgenda['ano']?>" class="arrow-r"><strong>&gt;&gt;</strong></a></td>
						</tr>
					</table>
				</div>
				<div id="month-days">
				   <table id='calendas' cellpadding="0" cellspacing="0" width="100%">
					   <thead>
						   <tr>
							   <td align="center" valign="middle">D</td>
							   <td align="center" valign="middle">S</td>
							   <td align="center" valign="middle">T</td>
							   <td align="center" valign="middle">Q</td>
							   <td align="center" valign="middle">Q</td>
							   <td align="center" valign="middle">S</td>
							   <td align="center" valign="middle">S</td>
						   </tr>
					   </thead>
					   <tbody>
						   <?	$tabIndex = 67;
							   foreach($aArrAgenda['dias'] AS $row):?>
						   <tr>
							   <?	foreach($row AS $dia):?>
							   <td tabIndex="<?=$tabIndex?>" align="center" valign="middle"><?=$dia?></td>
							   <?		$tabIndex++;
								   endforeach;?>
						   </tr>
						   <?	endforeach;?>
						   <!--tr>
							   <td tabIndex="67" align="center" valign="middle"></td>
							   <td tabIndex="68" align="center" valign="middle"></td>
							   <td tabIndex="69" align="center" valign="middle"></td>
							   <td tabIndex="70" align="center" valign="middle"><span>1</span></td>
							   <td tabIndex="71" align="center" valign="middle"><span>2</span></td>
							   <td tabIndex="72" align="center" valign="middle"><span class="event-day">3</span></td>
							   <td tabIndex="73" align="center" valign="middle"><span>4</span></td>
						   </tr>
						   <tr>
							   <td align="center" valign="middle"><span>5</span></td>
							   <td align="center" valign="middle"><span>6</span></td>
							   <td align="center" valign="middle">
								   <span class="event-day">7<span class="event-info">Início da Reatec<br />Início da Reatec<br />Início da Reatec<br /></span></span>
							   </td>
							   <td align="center" valign="middle"><span>8</span></td>
							   <td align="center" valign="middle"><span>9</span></td>
							   <td align="center" valign="middle"><span>10</span></td>
							   <td align="center" valign="middle"><span>11</span></td>
						   </tr>
						   <tr>
						   <tr>
							   <td align="center" valign="middle"><span>12</span></td>
							   <td align="center" valign="middle"><span>13</span></td>
							   <td align="center" valign="middle"><span>14</span></td>
							   <td align="center" valign="middle"><span>15</span></td>
							   <td align="center" valign="middle"><span>16</span></td>
							   <td align="center" valign="middle"><span>17</span></td>
							   <td align="center" valign="middle"><span class="event-day">18</span><span class="event-info">Início da Reatec<br /></span></td>
						   </tr>
						   </tr>
						   <tr>
						   <tr>
							   <td align="center" valign="middle"><span>19</span></td>
							   <td align="center" valign="middle"><span>20</span></td>
							   <td align="center" valign="middle"><span>21</span></td>
							   <td align="center" valign="middle"><span>22</span></td>
							   <td align="center" valign="middle"><span>23</span></td>
							   <td align="center" valign="middle"><span>24</span></td>
							   <td align="center" valign="middle"><span>25</span></td>
						   </tr>
						   </tr>
						   <tr>
						   <tr>
							   <td align="center" valign="middle"><span>26</span></td>
							   <td align="center" valign="middle"><span>27</span></td>
							   <td align="center" valign="middle"><span>28</span></td>
							   <td align="center" valign="middle"><span class="event-day">29</span></td>
							   <td align="center" valign="middle"><span>30</span></td>
							   <td align="center" valign="middle"></td>
							   <td align="center" valign="middle"></td>
						   </tr>
						   </tr -->
					   </tbody>
				   </table>
			   </div>
			</div>
		</div>
		<div id="atento">
			<h1 tabIndex="102">Fique atento!</h1>
			<div tabIndex="103" id="day">15</div>
			<h3 tabIndex="104" id="month">Agosto</h3>
			<span tabIndex="105" id="event">Início da Reatec</span>
		</div>
