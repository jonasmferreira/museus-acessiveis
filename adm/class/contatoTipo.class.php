<?php
$path_root_contatoTipoClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_contatoTipoClass = "{$path_root_contatoTipoClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_contatoTipoClass}adm{$DS}class{$DS}default.class.php";
class contatoTipo extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.contato_tipo'=>array(
			'fieldNameId'=>'t.contato_tipo'
			,'fieldNameLabel'=>'Tipo'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	public function __construct() {
		$path_root_contatoTipoClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_contatoTipoClass = "{$path_root_contatoTipoClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_contatoTipoClass}images{$DS}";
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
			FROM	tb_contato_tipo t
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
		if(isset($this->values['contato_tipo_status'])&&trim($this->values['contato_tipo_status'])!=''){
			$sql[] = "AND t.contato_tipo_status IN ('{$this->values['contato_tipo_status']}')";
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
		$sql[] = "ORDER BY t.contato_tipo ASC";
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
		$sql[] = "AND		t.contato_tipo_id = '{$this->values['contato_tipo_id']}'";
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
		if(isset($this->values['contato_tipo_id'])&&trim($this->values['contato_tipo_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['contato_tipo'] = $this->escape_string($this->values['contato_tipo']);
		$this->values['contato_tipo_icone'] = $this->uploadFile($this->pathImg, $this->files['contato_tipo_icone']);
		$this->values['contato_tipo_icone_contraste'] = $this->uploadFile($this->pathImg, $this->files['contato_tipo_icone_contraste']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_contato_tipo SET
					contato_tipo = '{$this->values['contato_tipo']}'
					,contato_tipo_status = '{$this->values['contato_tipo_status']}'
			
		";
        if(isset($this->values['contato_tipo_icone'])&&trim($this->values['contato_tipo_icone'])!=''){
          $sql[] = ",contato_tipo_icone = '{$this->values['contato_tipo_icone']}'";
        }
        if(isset($this->values['contato_tipo_icone_contraste'])&&trim($this->values['contato_tipo_icone_contraste'])!=''){
          $sql[] = ",contato_tipo_icone_contraste = '{$this->values['contato_tipo_icone_contraste']}'";
        }
        $sql[] = "WHERE	contato_tipo_id = '{$this->values['contato_tipo_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}

	private function insert(){
		$this->values['contato_tipo'] = $this->escape_string($this->values['contato_tipo']);
		$this->values['contato_tipo_icone'] = $this->uploadFile($this->pathImg, $this->files['contato_tipo_icone']);
		$this->values['contato_tipo_icone_contraste'] = $this->uploadFile($this->pathImg, $this->files['contato_tipo_icone_contraste']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_contato_tipo SET
				contato_tipo = '{$this->values['contato_tipo']}'
				,contato_tipo_status = '{$this->values['contato_tipo_status']}'
		";
        if(isset($this->values['contato_tipo_icone'])&&trim($this->values['contato_tipo_icone'])!=''){
          $sql[] = ",contato_tipo_icone = '{$this->values['contato_tipo_icone']}'";
        }
        if(isset($this->values['contato_tipo_icone_contraste'])&&trim($this->values['contato_tipo_icone_contraste'])!=''){
          $sql[] = ",contato_tipo_icone_contraste = '{$this->values['contato_tipo_icone_contraste']}'";
        }
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
			DELETE FROM tb_contato_tipo
			WHERE contato_tipo_id = '{$this->values['contato_tipo_id']}'
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