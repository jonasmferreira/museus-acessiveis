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
}