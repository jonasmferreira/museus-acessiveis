<?php
$path_root_depoimentoClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_depoimentoClass = "{$path_root_depoimentoClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_depoimentoClass}adm{$DS}class{$DS}default.class.php";
class depoimento extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.depoimento_autor'=>array(
			'fieldNameId'=>'t.depoimento_autor'
			,'fieldNameLabel'=>'Autor'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.depoimento_empresa'=>array(
			'fieldNameId'=>'t.depoimento_empresa'
			,'fieldNameLabel'=>'Empresa'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		
	);
	public function __construct() {
		$path_root_depoimentoClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_depoimentoClass = "{$path_root_depoimentoClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_depoimentoClass}images{$DS}";
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
			FROM	tb_depoimento t
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

		if(isset($this->values['depoimento_autor'])&&trim($this->values['depoimento_autor'])!=''){
			$sql[] = "AND t.depoimento_autor = '{$this->values['depoimento_autor']}'";
		}

		if(isset($this->values['depoimento_empresa'])&&trim($this->values['depoimento_empresa'])!=''){
			$sql[] = "AND t.depoimento_empresa = '{$this->values['depoimento_empresa']}'";
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
		$sql[] = "ORDER BY t.depoimento_dt DESC";
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
					$rs['depoimento_dt'] = $this->dateDB2BR($rs['depoimento_dt']);
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
		$sql[] = "AND		t.depoimento_id = '{$this->values['depoimento_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['depoimento_id'])&&trim($this->values['depoimento_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['depoimento_conteudo'] = $this->escape_string($this->values['depoimento_conteudo']);
		$this->values['depoimento_dt'] = $this->dateBR2DB($this->values['depoimento_dt']);

		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_depoimento SET
					depoimento_conteudo = '{$this->values['depoimento_conteudo']}'
					,depoimento_autor = '{$this->values['depoimento_autor']}'
					,depoimento_empresa = '{$this->values['depoimento_empresa']}'
					,depoimento_dt = '{$this->values['depoimento_dt']}'
			WHERE	depoimento_id = '{$this->values['depoimento_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}

	private function insert(){
		$this->values['depoimento_conteudo'] = $this->escape_string($this->values['depoimento_conteudo']);
		$this->values['depoimento_dt'] = $this->dateBR2DB($this->values['depoimento_dt']);

		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_depoimento SET
					depoimento_conteudo = '{$this->values['depoimento_conteudo']}'
					,depoimento_autor = '{$this->values['depoimento_autor']}'
					,depoimento_empresa = '{$this->values['depoimento_empresa']}'
					,depoimento_dt = '{$this->values['depoimento_dt']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	public function deleteItem(){
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			DELETE FROM tb_depoimento
			WHERE depoimento_id = '{$this->values['depoimento_id']}'
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

