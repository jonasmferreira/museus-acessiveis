						<div>
						<?php
							if(count($aGloss)>0){
						?>
								<div class="clear"><br /></div>
								<span class="orange-color">Glossário<?php echo ($glossRel==true)?' Relacionado':'';?>:</span>
								<span>
						<?php	
								foreach($aGloss as $k => $v){					
									$aGl[] = $v['glossario_palavra'];
								} 
								echo implode(', ',$aGl);
							}

						?>	
							</span>
						</div>


						<div class="clear"><br /></div>
