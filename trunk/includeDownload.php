						<!-- AQUI FICAM OS DOWNLOADS QUANDO EXISTIREM -->			  
						<?php 
							if(count($aDown)>0){
						?>	

							<div id="download-box" style="padding-left:0 !important;">
								<h3 tabIndex="31" class="orange-color">Downloads</h2>
								<table id="list" width="100%" cellpading="0" cellspacing="0" downPage="<?=$downPage;?>" downId="<?=$downId;?>">
										<thead>
											<tr>
												<td tabIndex="" id="DT">
													<a class="down_ordem" href="javascript:void(0);">
														<span>Data</span>
													</a>
												</td>
												<td tabIndex="" id="CT">
													<a class="down_ordem" href="javascript:void(0);">Categoria</a>
												</td>
												<td tabIndex="7" id="D">
													<a class="down_ordem" href="javascript:void(0);">Descrição</a>
												</td>
												<td tabIndex="" id="F">
													<a class="down_ordem" href="javascript:void(0);">Formato</a>
												</td>
												<td tabIndex="19" id="S">
													<a class="down_ordem" href="javascript:void(0);">Tamanho</a>
												</td>
											</tr>
										</thead>
										<tbody>
					<?php 
										foreach($aDown as $k => $v){
											$sLinkFile='';
											if($v['download_tipo']!=7){
												$sLinkFile = $linkAbsolute .'arquivosDown/';
											}
					?>
											<tr>
												<td>
													<span><?=$v['download_dt'];?></span>
												</td>
												<td>
													<span><?=$v['download_categoria_titulo'];?></span>
												</td>
												<td>
													<span>
														<a target="_BLANK" href="<?=$sLinkFile;?><?=$v['download_arquivo'];?>">
															<?=$v['download_titulo'];?>
														</a>
													</span>
												</td>
												<td>
													<span><?=$v['download_tipo_desc'];?></span>
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
