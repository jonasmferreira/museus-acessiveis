<?php
$path_root_agendaClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_agendaClass = "{$path_root_agendaClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_agendaClass}adm{$DS}class{$DS}default.class.php";
class agenda extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.agenda_titulo'=>array(
			'fieldNameId'=>'t.agenda_titulo'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	public function __construct() {
		$path_root_agendaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_agendaClass = "{$path_root_agendaClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_agendaClass}images{$DS}";
		if(!is_dir($this->pathImg)){
			@mkdir($this->pathImg, 0777,true);
		}
		@chmod($this->pathImg, 0777);
		$this->dbConn = new DataBaseClass();
	}
		
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_agenda t
			WHERE	1 = 1
		";
		return implode("\n",$sql);
	}
	public function getLista(){
		$page = $this->values['page']; 
		// get the requested page 
		$limit = $this->values['rows']; 
		
		$sql = array();
		$sql[] = $this->getSql();
		if(isset($this->values['fieldName'])&&trim($this->values['fieldName'])!=''){
			if(isset($this->values['txtPesquisar'])&&trim($this->values['txtPesquisar'])!=''){
				$sql[] = "AND {$this->values['fieldName']} LIKE '%{$this->values['txtPesquisar']}%'";
			}
		}
		if(isset($this->values['data_ini'])&&trim($this->values['data_ini'])!=''){
			$this->values['data_ini'] = $this->dateBR2DB($this->values['data_ini']);
			$sql[] = "AND t.agenda_dt >= '{$this->values['data_ini']}'";
		}
		if(isset($this->values['data_fim'])&&trim($this->values['data_fim'])!=''){
			$this->values['data_fim'] = $this->dateBR2DB($this->values['data_fim']);
			$sql[] = "AND t.agenda_dt <= '{$this->values['data_fim']}'";
		}
		$count = $this->getTotalData(implode("\n",$sql));
		$page = ($page < 1)?1:$page;
		if($count>0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page=$total_pages; 
		}
		$start = ($limit * $page) - $limit;
		$start = ($start < 0)?0:$start;
		$sql[] = "ORDER BY t.agenda_dt ASC";
		$sql[] = "LIMIT {$start},{$limit}";
		
		$aRet = array(
			'page'=>$page
			,'total'=>$total_pages	
			,'records'=>$count
			,'rows'=>$limit
		);
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$rs['agenda_exibir_label'] = $rs['agenda_exibir']=='S'?'Sim':'Não';
					$rs['agenda_dt_hr'] = $this->dateDB2BR($rs['agenda_dt_cad'])." às ".$rs['agenda_hr_cad'];
					$rs['agenda_dt'] = $this->dateDB2BR($rs['agenda_dt']);
					$rs['tags'] = $this->getTagsCadatradas($rs['agenda_id']);
					array_push($arr,$this->utf8_array_encode($rs));
				}
			}
		}
		$aRet['rows'] = $arr;
		return $aRet;
	}

	public function getOne(){
		$sql = array();
		$sql[] = $this->getSql();
		$sql[] = "AND		t.agenda_id = '{$this->values['agenda_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['agenda_exibir'] = $rs['agenda_exibir']=='S'?'Sim':'Não';
				$rs['agenda_dt_hr'] = $this->dateDB2BR($rs['agenda_dt_cad'])." às ".$rs['agenda_hr_cad'];
				$rs['agenda_dt'] = $this->dateDB2BR($rs['agenda_dt']);
				$rs['tags'] = $this->getTagsCadatradas($rs['agenda_id']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['agenda_id'])&&trim($this->values['agenda_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['agenda_exibir'] = trim($this->values['agenda_exibir'])!=''?$this->values['agenda_exibir']:'N';
		$this->values['agenda_conteudo'] = $this->escape_string($this->values['agenda_conteudo']);
		$this->values['agenda_resumo'] = $this->escape_string($this->values['agenda_resumo']);
		$this->values['agenda_img'] = $this->uploadFile($this->pathImg, $this->files['agenda_img']);
		$this->values['agenda_img_desc'] = $this->escape_string($this->values['agenda_img_desc']);
		$this->values['agenda_dt'] = $this->dateBR2DB($this->values['agenda_dt']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_agenda SET
					agenda_titulo = '{$this->values['agenda_titulo']}'
					,agenda_resumo = '{$this->values['agenda_resumo']}'
					,agenda_dt = '{$this->values['agenda_dt']}'
					,agenda_img_desc = '{$this->values['agenda_img_desc']}'
					,agenda_fonte = '{$this->values['agenda_fonte']}'
					,agenda_link_fonte = '{$this->values['agenda_link_fonte']}'
					,agenda_conteudo = '{$this->values['agenda_conteudo']}'
					,agenda_exibir = '{$this->values['agenda_exibir']}'
		";
		if(trim($this->values['agenda_img'])){
			$sql[] = ",agenda_img = '{$this->values['agenda_img']}'";
		}
		
		$sql[] = "WHERE	agenda_id = '{$this->values['agenda_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteTags();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$agenda_id = $this->values['agenda_id'];
		
		$result = $this->insertTags($this->values['tags'], $agenda_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$this->dbConn->db_commit();
		return $result;
	}

	private function insert(){
		$this->values['agenda_exibir'] = trim($this->values['agenda_exibir'])!=''?$this->values['agenda_exibir']:'N';
		$this->values['agenda_conteudo'] = $this->escape_string($this->values['agenda_conteudo']);
		$this->values['agenda_resumo'] = $this->escape_string($this->values['agenda_resumo']);
		$this->values['agenda_img'] = $this->uploadFile($this->pathImg, $this->files['agenda_img']);
		$this->values['agenda_img_desc'] = $this->escape_string($this->values['agenda_img_desc']);
		$this->values['agenda_dt'] = $this->dateBR2DB($this->values['agenda_dt']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_agenda SET
				agenda_dt_cad = CURDATE()
				,agenda_hr_cad = CURTIME()
				,agenda_titulo = '{$this->values['agenda_titulo']}'
				,agenda_resumo = '{$this->values['agenda_resumo']}'
				,agenda_dt = '{$this->values['agenda_dt']}'
				,agenda_img = '{$this->values['agenda_img']}'
				,agenda_img_desc = '{$this->values['agenda_img_desc']}'
				,agenda_fonte = '{$this->values['agenda_fonte']}'
				,agenda_link_fonte = '{$this->values['agenda_link_fonte']}'
				,agenda_conteudo = '{$this->values['agenda_conteudo']}'
				,agenda_exibir = '{$this->values['agenda_exibir']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$agenda_id = $result['last_id'];
		$result = $this->insertTags($this->values['tags'], $agenda_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$this->dbConn->db_commit();
		return $result;
	}
	
	protected function deleteTags(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_agenda_tag
			WHERE	agenda_id = '{$this->values['agenda_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertTags($tags,$agenda_id){
		if(count($tags) > 0){
			foreach($tags AS $tag){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_agenda_tag SET
						agenda_id = '{$agenda_id}'
						,tag_id = '{$tag}'
				";
				$result = $this->dbConn->db_execute(implode("\n",$sql));
				if($result['success']===false){
					return $result; 
				}
			}
			return $result;
		}
		return array('success'=>'true');
	}
	public function deleteItem(){
		$this->dbConn->db_start_transaction();
		$result = $this->deleteTags();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$sql = array();
		$sql[] = "
			DELETE FROM tb_agenda
			WHERE agenda_id = '{$this->values['agenda_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	public function getTagsCadatradas($agenda_id){
		$sql = array();
		$sql[] = "
			SELECT	tag_id
			FROM	tb_agenda_tag
			WHERE	1 = 1
			AND		agenda_id = '{$agenda_id}'
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$arr[] = $rs['tag_id'];
				}
			}
		}
		return $arr;
	}
	public function getTags(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_tag t
			WHERE	1 = 1
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					array_push($arr,$this->utf8_array_encode($rs));
				}
			}
		}
		return $arr;
	}
	public function removeImage(){
		$aReg = $this->getOne();
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE tb_agenda SET
				{$this->values['img']} = ''
			WHERE	agenda_id = '{$this->values['agenda_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			@unlink("{$this->pathImg}{$aReg[$this->values['img']]}");
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	public function getAgendaGeral($month,$year){
		$path_root_agendaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_agendaClass = "{$path_root_agendaClass}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_agendaClass}adm{$DS}class{$DS}configuracao.class.php");
		$objConfig = new configuracao();
		$aConfig = $objConfig->getOne();

		//$objConfig->debug($aConfig);
		$linkAbsolute=$aConfig['configuracao_baseurl'];
		$sql = array();
		$month = trim($month!="")?$month:date("m");
		$year = trim($year!="")?$year:date("Y");

		//novidade 360
		$sql[] = "
			SELECT	
					t.novidade_360_id as item_id
					,'novidade360' as item_tipo_link
					,t.novidade_360_titulo as item_titulo
					,t.novidade_360_dt_agenda as item_dt_agenda
					,DAY(t.novidade_360_dt_agenda) as item_dt_agenda_dia
			FROM	tb_novidade_360 t
			WHERE	1 = 1 
			AND		MONTH(t.novidade_360_dt_agenda) = '{$month}'
			AND		YEAR(t.novidade_360_dt_agenda) = '{$year}'
			";

		//Projetos
		$sql[] = "
			SELECT	
					t.projeto_id as item_id
					,'projeto' as item_tipo_link
					,t.projeto_titulo as item_titulo
					,t.projeto_agenda as item_dt_agenda
					,DAY(t.projeto_agenda) as item_dt_agenda_dia
			FROM	tb_projeto t
			WHERE	1 = 1 
			AND		MONTH(t.projeto_agenda) = '{$month}'
			AND		YEAR(t.projeto_agenda) = '{$year}'
			";

		//cursos
		$sql[] = "
			SELECT	
					t.curso_id as item_id
					,'curso' as item_tipo_link
					,t.curso_titulo as item_titulo
					,t.curso_agenda as item_dt_agenda
					,DAY(t.curso_agenda) as item_dt_agenda_dia
			FROM	tb_curso t
			WHERE	1 = 1 
			AND		MONTH(t.curso_agenda) = '{$month}'
			AND		YEAR(t.curso_agenda) = '{$year}'
			";

		//servicos
		$sql[] = "
			SELECT	
					t.servico_id as item_id
					,'servico' as item_tipo_link
					,t.servico_titulo as item_titulo
					,t.servico_agenda as item_dt_agenda
					,DAY(t.servico_agenda) as item_dt_agenda_dia
			FROM	tb_servico t
			WHERE	1 = 1 
			AND		MONTH(t.servico_agenda) = '{$month}'
			AND		YEAR(t.servico_agenda) = '{$year}'
			";
			
		$aSql = Array();
		$aSql[] = "SELECT * FROM (";
		$aSql[] = implode(" UNION \n",$sql);
		$aSql[] = ") AS item_busca ";
		$aSql[] = "WHERE 1 = 1 ";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$aSql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$sLink = "{$linkAbsolute}{$rs['item_tipo_link']}/{$rs['item_id']}/{$rs['item_titulo']}";
					$arr[$rs['item_dt_agenda_dia']][] = "<a href='{$sLink}'>{$rs['item_titulo']}</a>";
				}
			}
		}
		$aArr = array(
			'mesExtenso'=>$this->meses[$month]
			,'mes'=>$month
			,'ano'=>$year
			,'dias'=>array()
		);
		
		$dtFinal = date("t",  mktime(0, 0, 0, $month, 1, $year));
		$dtFinalNumSemana = date("t",  mktime(0, 0, 0, $month, 1, $year));
		$dtInicialNumSemana = date("w",  mktime(0, 0, 0, $month, 1, $year));
		$w = 0;
		for($j=0;$j<$dtInicialNumSemana;$j++){
			$aArr['dias'][0][$j] = "&nbsp;";
		}
		for($i=1;$i<=$dtFinal;$i++){
			$sNumSemana = date("w",  mktime(0, 0, 0, $month, $i, $year));
			if($sNumSemana < 1){
				$w++;
			}
			if(isset($arr[$i])&&count($arr[$i]) > 0){
				$diaCal = '<span class="event-day">'.$i.'<span class="event-info hidden">'.implode("<br />",$arr[$i]).'</span></span>';
			}else{
				$diaCal = '<span>'.$i.'</span>';
			}
			$aArr['dias'][$w][$sNumSemana] = $diaCal;
		}
		$sNumSemana++;
		for($j=$sNumSemana;$j<=6;$j++){
			$aArr['dias'][$w][$j] = "&nbsp;";
		}
		return $aArr;
	}
	
	
	public function getAgendaLista(){
		$path_root_agendaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_agendaClass = "{$path_root_agendaClass}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_agendaClass}adm{$DS}class{$DS}configuracao.class.php");
		$objConfig = new configuracao();
		$aConfig = $objConfig->getOne();

		//$objConfig->debug($aConfig);
		$linkAbsolute=$aConfig['configuracao_baseurl'];
		$sql = array();

/*
		$month = trim($month!="")?$month:date("m");
		$year = trim($year!="")?$year:date("Y");
*/
		//novidade 360
		$sQuery = "
			SELECT	
					t.novidade_360_id as item_id
					,'novidade360' as item_tipo_link
					,t.novidade_360_titulo as item_titulo
					,t.novidade_360_resumo as item_resumo
					,t.novidade_360_dt_agenda as item_dt_agenda
					,DAY(t.novidade_360_dt_agenda) as item_dt_agenda_dia
					,novidade_360_thumb as item_thumb
					,novidade_360_thumb_desc as item_thumb_desc					
			FROM	tb_novidade_360 t
			WHERE	1 = 1 ";
/*
			if(trim($month)!='' && trim($year)!=''){		

				$sQuery .= 	"
						AND		MONTH(t.novidade_360_dt_agenda) = '{$month}'
						AND		YEAR(t.novidade_360_dt_agenda) = '{$year}'
					";
			}
*/		
		$sql[] = $sQuery;
			
		//Projetos
		$sQuery = "
			SELECT	
					t.projeto_id as item_id
					,'projeto' as item_tipo_link
					,t.projeto_titulo as item_titulo
					,t.projeto_resumo as item_resumo
					,t.projeto_agenda as item_dt_agenda
					,DAY(t.projeto_agenda) as item_dt_agenda_dia
					,projeto_thumb as item_thumb
					,projeto_thumb_desc as item_thumb_desc					
			FROM	tb_projeto t
			WHERE	1 = 1 ";
/*
			if(trim($month)!='' && trim($year)!=''){		

				$sQuery .= 	"
						AND		MONTH(t.projeto_agenda) = '{$month}'
						AND		YEAR(t.projeto_agenda) = '{$year}'
					";
			}
*/
			$sql[] = $sQuery;
			
			
		//cursos
		$sQuery = "
			SELECT	
					t.curso_id as item_id
					,'curso' as item_tipo_link
					,t.curso_titulo as item_titulo
					,t.curso_resumo as item_resumo
					,t.curso_agenda as item_dt_agenda
					,DAY(t.curso_agenda) as item_dt_agenda_dia
					,curso_thumb as item_thumb
					,curso_thumb_desc as item_thumb_desc					
			FROM	tb_curso t
			WHERE	1 = 1 ";
/*
			if(trim($month)!='' && trim($year)!=''){		

				$sQuery .= 	"
					AND		MONTH(t.curso_agenda) = '{$month}'
					AND		YEAR(t.curso_agenda) = '{$year}'
				";
			}
*/
			$sql[] = $sQuery;

		//servicos
		$sQuery = "
			SELECT	
					t.servico_id as item_id
					,'servico' as item_tipo_link
					,t.servico_titulo as item_titulo
					,t.servico_resumo as item_resumo
					,t.servico_agenda as item_dt_agenda
					,DAY(t.servico_agenda) as item_dt_agenda_dia
					,servico_thumb as item_thumb
					,servico_thumb_desc as item_thumb_desc					
			FROM	tb_servico t
			WHERE	1 = 1 ";
/*
			if(trim($month)!='' && trim($year)!=''){		

				$sQuery .= 	"
					AND		MONTH(t.servico_agenda) = '{$month}'
					AND		YEAR(t.servico_agenda) = '{$year}'
				";
			}
*/
			$sql[] = $sQuery;
			
		$aSql = Array();
		$aSql[] = "SELECT * FROM (";
		$aSql[] = implode(" UNION \n",$sql);
		$aSql[] = ") AS item_busca ";
		$aSql[] = "WHERE 1 = 1 ";
		$aSql[] = "AND item_dt_agenda_dia > 0 ";

		$count = $this->getTotalData(implode("\n",$aSql));
		
		$sOrder = $this->getAOrderBy();
		if(isset($sOrder)&&trim($sOrder)!=''){
			$aSql[] = $sOrder;
		}else{
			$aSql[] = "ORDER BY item_dt_agenda DESC";
		}
		
		$aRet = array(
			'records'=>$count
		);
		$arr = array();
		
		$result = $this->dbConn->db_query(implode("\n",$aSql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$sLink = "{$linkAbsolute}{$rs['item_tipo_link']}/{$rs['item_id']}/{$rs['item_titulo']}";
					$rs['item_dt_agenda_dia'] = "<a href='{$sLink}'>{$rs['item_titulo']}</a>";
					array_push($arr,$this->utf8_array_encode($rs));
				}
			}
		}
		$aRet['rows'] = $arr;
		return $aRet;
		
	}
	
	
	public function getFiqueAtento($month,$year){
		$path_root_agendaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_agendaClass = "{$path_root_agendaClass}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_agendaClass}adm{$DS}class{$DS}configuracao.class.php");
		$objConfig = new configuracao();
		$aConfig = $objConfig->getOne();

		//$objConfig->debug($aConfig);
		$linkAbsolute=$aConfig['configuracao_baseurl'];
		$sql = array();
		$month = trim($month!="")?$month:date("m");
		$year = trim($year!="")?$year:date("Y");

		//novidade 360
		$sql[] = "
			SELECT	
					t.novidade_360_id as item_id
					,'novidade360' as item_tipo_link
					,t.novidade_360_titulo as item_titulo
					,t.novidade_360_dt_agenda as item_dt_agenda
					,DAY(t.novidade_360_dt_agenda) as item_dt_agenda_dia
					,MONTH(t.novidade_360_dt_agenda) as item_dt_agenda_mes
					,YEAR(t.novidade_360_dt_agenda) as item_dt_agenda_ano
		
			FROM	tb_novidade_360 t
			WHERE	1 = 1 
			AND		MONTH(t.novidade_360_dt_agenda) = '{$month}'
			AND		YEAR(t.novidade_360_dt_agenda) = '{$year}'
			";

		//Projetos
		$sql[] = "
			SELECT	
					t.projeto_id as item_id
					,'projeto' as item_tipo_link
					,t.projeto_titulo as item_titulo
					,t.projeto_agenda as item_dt_agenda
					,DAY(t.projeto_agenda) as item_dt_agenda_dia
					,MONTH(t.projeto_agenda) as item_dt_agenda_mes
					,YEAR(t.projeto_agenda) as item_dt_agenda_ano
			
			FROM	tb_projeto t
			WHERE	1 = 1 
			AND		MONTH(t.projeto_agenda) = '{$month}'
			AND		YEAR(t.projeto_agenda) = '{$year}'
			";

		//cursos
		$sql[] = "
			SELECT	
					t.curso_id as item_id
					,'curso' as item_tipo_link
					,t.curso_titulo as item_titulo
					,t.curso_agenda as item_dt_agenda
					,DAY(t.curso_agenda) as item_dt_agenda_dia
					,MONTH(t.curso_agenda) as item_dt_agenda_mes
					,YEAR(t.curso_agenda) as item_dt_agenda_ano
			
			FROM	tb_curso t
			WHERE	1 = 1 
			AND		MONTH(t.curso_agenda) = '{$month}'
			AND		YEAR(t.curso_agenda) = '{$year}'
			";

		//servicos
		$sql[] = "
			SELECT	
					t.servico_id as item_id
					,'servico' as item_tipo_link
					,t.servico_titulo as item_titulo
					,t.servico_agenda as item_dt_agenda
					,DAY(t.servico_agenda) as item_dt_agenda_dia
					,MONTH(t.servico_agenda) as item_dt_agenda_mes
					,YEAR(t.servico_agenda) as item_dt_agenda_ano
			
			FROM	tb_servico t
			WHERE	1 = 1 
			AND		MONTH(t.servico_agenda) = '{$month}'
			AND		YEAR(t.servico_agenda) = '{$year}'
			";
			
		$aSql = Array();
		$aSql[] = "SELECT * FROM (";
		$aSql[] = implode(" UNION \n",$sql);
		$aSql[] = ") AS item_busca ";
		$aSql[] = "WHERE 1 = 1 ";
		$aSql[] = "ORDER BY	item_dt_agenda_ano ASC,
							item_dt_agenda_mes ASC,
							item_dt_agenda_dia ASC		
				";

		
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$aSql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					array_push($arr,$this->utf8_array_encode($rs));
				}
			}
		}
		
		$count = $this->getTotalData(implode("\n",$aSql));
		$aRet = array(
			'records'=>$count
			,'mesExtenso'=>$this->meses[$month]
			,'mes'=>$month
			,'ano'=>$year
			,'rows'=>$arr
		);
		
		return $aRet;
		
	}
	
	
	
}