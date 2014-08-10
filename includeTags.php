						<div>
						<?php
							if(is_array($aTag) && count($aTag)>0){
						?>
								<div class="clear"><br /></div>
								<span class="orange-color">Tags: </span>
								<span>
						<?php	
								foreach($aTag as $k => $v){					
									$aTg[] = $v['tag_titulo'];
								} 

								echo implode(', ',$aTg);
							}

						?>	
							</span>
						</div>
