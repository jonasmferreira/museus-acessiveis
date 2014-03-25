<?php
$path_root_anuncianteClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_anuncianteClass = "{$path_root_anuncianteClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_anuncianteClass}adm{$DS}class{$DS}default.class.php";
class anunciante extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.anunciante_nome'=>array(
			'fieldNameId'=>'t.anunciante_nome'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	public function __construct() {
		$path_root_anuncianteClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_anuncianteClass = "{$path_root_anuncianteClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_anuncianteClass}images{$DS}";
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
			FROM	tb_anunciante t
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
			$sql[] = "AND t.anunciante_dt_agenda >= '{$this->values['data_ini']}'";
		}
		if(isset($this->values['data_fim'])&&trim($this->values['data_fim'])!=''){
			$this->values['data_fim'] = $this->dateBR2DB($this->values['data_fim']);
			$sql[] = "AND t.anunciante_dt_agenda <= '{$this->values['data_fim']}'";
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
		
		$sOrder = $this->getAOrderBy();
		if(isset($sOrder)&&trim($sOrder)!=''){
			$sql[] = $sOrder;
		}else{
			$sql[] = "ORDER BY t.anunciante_dt_agenda ASC";
		}
		
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
					$rs['anunciante_dt_hr'] = $this->dateDB2BR($rs['anunciante_dt'])." às ".$rs['anunciante_hr'];
					$rs['anunciante_dt_agenda'] = $this->dateDB2BR($rs['anunciante_dt_agenda']);
					$rs['anunciante_tipo_banner_label'] = trim($rs['anunciante_tipo_banner'])=='FB'?'Full Banner':'Retângulo';
					$rs['tags'] = $this->getTagsCadatradas($rs['anunciante_id']);
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
		$sql[] = "AND		t.anunciante_id = '{$this->values['anunciante_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['anunciante_dt_hr'] = $this->dateDB2BR($rs['anunciante_dt'])." às ".$rs['anunciante_hr'];
					$rs['anunciante_dt_agenda'] = $this->dateDB2BR($rs['anunciante_dt_agenda']);
					$rs['tags'] = $this->getTagsCadatradas($rs['anunciante_id']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['anunciante_id'])&&trim($this->values['anunciante_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['anunciante_banner_desc'] = $this->escape_string($this->values['anunciante_banner_desc']);
		$this->values['anunciante_banner'] = $this->uploadFile($this->pathImg, $this->files['anunciante_banner']);
		$this->values['anunciante_dt_agenda'] = $this->dateBR2DB($this->values['anunciante_dt_agenda']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_anunciante SET
					anunciante_nome = '{$this->values['anunciante_nome']}'
					,anunciante_tipo_banner = '{$this->values['anunciante_tipo_banner']}'
					,anunciante_banner_desc = '{$this->values['anunciante_banner_desc']}'
					,anuncianete_banner_link = '{$this->values['anuncianete_banner_link']}'
					,anunciante_dt_agenda = '{$this->values['anunciante_dt_agenda']}'
		";
		if(trim($this->values['anunciante_banner'])!=''){
			$sql[] = ",anunciante_banner = '{$this->values['anunciante_banner']}'";
		}
		
		$sql[] = "WHERE	anunciante_id = '{$this->values['anunciante_id']}'";
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
		$anunciante_id = $this->values['anunciante_id'];
		$result = $this->insertTags($this->values['tags'], $anunciante_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$this->dbConn->db_commit();
		return $result;
	}

	private function insert(){
		$this->values['anunciante_banner_desc'] = $this->escape_string($this->values['anunciante_banner_desc']);
		$this->values['anunciante_banner'] = $this->uploadFile($this->pathImg, $this->files['anunciante_banner']);
		$this->values['anunciante_dt_agenda'] = $this->dateBR2DB($this->values['anunciante_dt_agenda']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_anunciante SET
				anunciante_dt = CURDATE()
				,anunciante_hr = CURTIME()
				,anunciante_nome = '{$this->values['anunciante_nome']}'
				,anunciante_tipo_banner = '{$this->values['anunciante_tipo_banner']}'
				,anunciante_banner_desc = '{$this->values['anunciante_banner_desc']}'
				,anuncianete_banner_link = '{$this->values['anuncianete_banner_link']}'
				,anunciante_dt_agenda = '{$this->values['anunciante_dt_agenda']}'
		";

		if(trim($this->values['anunciante_banner'])!=''){
			$sql[] = ",anunciante_banner = '{$this->values['anunciante_banner']}'";
		}

		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$anunciante_id = $result['last_id'];
		$result = $this->insertTags($this->values['tags'], $anunciante_id);
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
			DELETE FROM tb_anunciante_tag
			WHERE	anunciante_id = '{$this->values['anunciante_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertTags($tags,$anunciante_id){
		if(count($tags) > 0){
			foreach($tags AS $tag){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_anunciante_tag SET
						anunciante_id = '{$anunciante_id}'
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
			DELETE FROM tb_anunciante
			WHERE anunciante_id = '{$this->values['anunciante_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	public function getTagsCadatradas($anunciante_id){
		$sql = array();
		$sql[] = "
			SELECT	tag_id
			FROM	tb_anunciante_tag
			WHERE	1 = 1
			AND		anunciante_id = '{$anunciante_id}'
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
			UPDATE tb_anunciante SET
				{$this->values['img']} = ''
			WHERE	anunciante_id = '{$this->values['anunciante_id']}'
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