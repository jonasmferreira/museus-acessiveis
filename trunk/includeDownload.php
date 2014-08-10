						<!-- AQUI FICAM OS DOWNLOADS QUANDO EXISTIREM -->			  
						<?php 
							if(count($aDown)>0){
						?>	

							<div id="download-box" style="padding-left:0 !important;">
								<h3 tabIndex="31" class="orange-color">Downloads</h2>
								<table id="list" width="100%" cellpading="0" cellspacing="0">
										<thead>
											<tr>
												<td tabIndex="">
													<span>Data</span>
												</td>
												<td tabIndex="7">
													Descrição
												</td>
												<td tabIndex="">
													Formato
												</td>
												<td tabIndex="19">
													Tamanho
												</td>
											</tr>
										</thead>
										<tbody>
					<?php 
										foreach($aDown as $k => $v){
											$sLinkFile='';
											if($v['download_tipo']!=7){
												$sLinkFile = '<?=$linkAbsolute;?>arquivosDown/';
											}
					?>
											<tr>
												<td>
													<span><?=$v['download_dt'];?></span>
												</td>
												<td>
													<span>
														<a target="_BLANK" href="<?=$sLinkFile;?><?=$v['download_arquivo'];?>">
															<?=$v['download_titulo'];?>
														</a>
													</span>
												</td>
												<td>
													<span><?=$v['download_tipo_label'];?></span>
												</td>
												<td>
													<span><?=$v['download_tamanho_label'];?></span>
												</td>
											</tr>
					<?php
							}
					?>						
										</tbody>
								</table>
								</div>
					<?php } ?>
								<div class="clear"></div>
					<!-- FIM DOWNLOADS -->
