<?php
$path_root_emktNoticiaClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_emktNoticiaClass = "{$path_root_emktNoticiaClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_emktNoticiaClass}adm{$DS}class{$DS}default.class.php";
class emktNoticia extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.emkt_noticia_titulo'=>array(
			'fieldNameId'=>'t.emkt_noticia_titulo'
			,'fieldNameLabel'=>'Título'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.emkt_noticia_titulo_sintese'=>array(
			'fieldNameId'=>'t.emkt_noticia_titulo_sintese'
			,'fieldNameLabel'=>'Título Síntese'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.emkt_noticia_resumo'=>array(
			'fieldNameId'=>'t.emkt_noticia_resumo'
			,'fieldNameLabel'=>'Resumo'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.emkt_noticia_fonte'=>array(
			'fieldNameId'=>'t.emkt_noticia_fonte'
			,'fieldNameLabel'=>'Fonte'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		
	);
	
	public function __construct() {
		$path_root_emktNoticiaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_emktNoticiaClass = "{$path_root_emktNoticiaClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_emktNoticiaClass}images{$DS}";
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
			FROM	tb_emkt_noticia t
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
		if(isset($this->values['emkt_noticia_dt'])&&trim($this->values['emkt_noticia_dt'])!=''){
			$this->values['emkt_noticia_dt'] = $this->dateBR2DB($this->values['emkt_noticia_dt']);
			$sql[] = "AND t.emkt_noticia_dt >= '{$this->values['emkt_noticia_dt']}'";
		}
		if(isset($this->values['emkt_noticia_dt'])&&trim($this->values['emkt_noticia_dt'])!=''){
			$this->values['emkt_noticia_dt'] = $this->dateBR2DB($this->values['emkt_noticia_dt']);
			$sql[] = "AND t.emkt_noticia_dt <= '{$this->values['emkt_noticia_dt']}'";
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
			$sql[] = "ORDER BY t.emkt_noticia_dt DESC, t.emkt_noticia_titulo_sintese ASC";
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
					$rs['emkt_noticia_dthr'] = $this->dateDB2BR($rs['emkt_noticia_dt'])." às ".$rs['emkt_noticia_hr'];
					$rs['emkt_noticia_dt'] = $this->dateDB2BR($rs['emkt_noticia_dt']);
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
		$sql[] = "AND		t.emkt_noticia_id = '{$this->values['emkt_noticia_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['emkt_noticia_dthr'] = $this->dateDB2BR($rs['emkt_noticia_dt'])." às ".$rs['emkt_noticia_hr'];
				$rs['emkt_noticia_dt'] = $this->dateDB2BR($rs['emkt_noticia_dt']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['emkt_noticia_id'])&&trim($this->values['emkt_noticia_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['emkt_noticia_dt'] = ($this->values['emkt_noticia_dt'])? $this->dateBR2DB($this->values['emkt_noticia_dt']) : date('Y-m-d');
		$this->values['emkt_noticia_hr'] = date('H:i:s');		
		$this->values['emkt_noticia_titulo'] = $this->escape_string($this->values['emkt_noticia_titulo']);
		$this->values['emkt_noticia_titulo_sintese'] = $this->escape_string($this->values['emkt_noticia_titulo_sintese']);
		$this->values['emkt_noticia_resumo'] = $this->escape_string($this->values['emkt_noticia_resumo']);
		$this->values['emkt_noticia_conteudo'] = $this->escape_string($this->values['emkt_noticia_conteudo']);
		$this->values['emkt_noticia_thumb'] = $this->uploadFile($this->pathImg, $this->files['emkt_noticia_thumb']);
		$this->values['emkt_noticia_thumb_desc'] = $this->escape_string($this->values['emkt_noticia_thumb_desc']);
		$this->values['emkt_noticia_fonte'] = $this->escape_string($this->values['emkt_noticia_fonte']);
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_emkt_noticia SET
					emkt_noticia_dt = '{$this->values['emkt_noticia_dt']}'
					,emkt_noticia_hr = '{$this->values['emkt_noticia_hr']}'
					,emkt_noticia_titulo = '{$this->values['emkt_noticia_titulo']}'
					,emkt_noticia_titulo_sintese = '{$this->values['emkt_noticia_titulo_sintese']}'
					,emkt_noticia_resumo = '{$this->values['emkt_noticia_resumo']}'
					,emkt_noticia_thumb_desc = '{$this->values['emkt_noticia_thumb_desc']}'
					,emkt_noticia_fonte = '{$this->values['emkt_noticia_fonte']}'
					,emkt_noticia_url_fonte = '{$this->values['emkt_noticia_url_fonte']}'
					,emkt_noticia_conteudo = '{$this->values['emkt_noticia_conteudo']}'
					
		";
		if(trim($this->values['emkt_noticia_thumb'])!=""){
			$sql[] = ",emkt_noticia_thumb = '{$this->values['emkt_noticia_thumb']}'";
		}
		
		$sql[] = "WHERE	emkt_noticia_id = '{$this->values['emkt_noticia_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$this->dbConn->db_commit();
		return $result;
	}

	private function insert(){
		$this->values['emkt_noticia_dt'] = ($this->values['emkt_noticia_dt'])? $this->dateBR2DB($this->values['emkt_noticia_dt']) : date('Y-m-d');
		$this->values['emkt_noticia_hr'] = date('H:i:s');		
		$this->values['emkt_noticia_titulo'] = $this->escape_string($this->values['emkt_noticia_titulo']);
		$this->values['emkt_noticia_titulo_sintese'] = $this->escape_string($this->values['emkt_noticia_titulo_sintese']);
		$this->values['emkt_noticia_resumo'] = $this->escape_string($this->values['emkt_noticia_resumo']);
		$this->values['emkt_noticia_conteudo'] = $this->escape_string($this->values['emkt_noticia_conteudo']);
		$this->values['emkt_noticia_thumb'] = $this->uploadFile($this->pathImg, $this->files['emkt_noticia_thumb']);
		$this->values['emkt_noticia_thumb_desc'] = $this->escape_string($this->values['emkt_noticia_thumb_desc']);
		$this->values['emkt_noticia_fonte'] = $this->escape_string($this->values['emkt_noticia_fonte']);
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_emkt_noticia SET
					emkt_noticia_dt = '{$this->values['emkt_noticia_dt']}'
					,emkt_noticia_hr = CURTIME()
					,emkt_noticia_titulo = '{$this->values['emkt_noticia_titulo']}'
					,emkt_noticia_titulo_sintese = '{$this->values['emkt_noticia_titulo_sintese']}'
					,emkt_noticia_resumo = '{$this->values['emkt_noticia_resumo']}'
					,emkt_noticia_thumb = '{$this->values['emkt_noticia_thumb']}'
					,emkt_noticia_thumb_desc = '{$this->values['emkt_noticia_thumb_desc']}'
					,emkt_noticia_fonte = '{$this->values['emkt_noticia_fonte']}'
					,emkt_noticia_url_fonte = '{$this->values['emkt_noticia_url_fonte']}'
					,emkt_noticia_conteudo = '{$this->values['emkt_noticia_conteudo']}'
					
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$this->dbConn->db_commit();
		return $result;
	}
	
	public function removeImage(){
		$aReg = $this->getOne();
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE tb_emkt_noticia SET
				{$this->values['img']} = ''
			WHERE	emkt_noticia_id = '{$this->values['emkt_noticia_id']}'
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

	public function deleteItem(){
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			DELETE FROM tb_emkt_noticia
			WHERE emkt_noticia_id = '{$this->values['emkt_noticia_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	
}

