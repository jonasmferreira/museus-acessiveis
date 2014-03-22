<?php
$path_root_glossarioClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_glossarioClass = "{$path_root_glossarioClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_glossarioClass}adm{$DS}class{$DS}default.class.php";
class glossario extends defaultClass{
	protected $dbConn;
	protected $filterFieldName = array(
		't.glossario_palavra'=>array(
			'fieldNameId'=>'t.glossario_palavra'
			,'fieldNameLabel'=>'Palavra'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.glossario_definicao'=>array(
			'fieldNameId'=>'t.glossario_definicao'
			,'fieldNameLabel'=>'Definição'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.glossario_fonte'=>array(
			'fieldNameId'=>'t.glossario_fonte'
			,'fieldNameLabel'=>'Fonte'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		
	);
	public function __construct() {
		$this->dbConn = new DataBaseClass();
	}
		
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_glossario t
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
			$sql[] = "AND t.glossario_dt >= '{$this->values['data_ini']}'";
		}
		if(isset($this->values['data_fim'])&&trim($this->values['data_fim'])!=''){
			$this->values['data_fim'] = $this->dateBR2DB($this->values['data_fim']);
			$sql[] = "AND t.glossario_dt <= '{$this->values['data_fim']}'";
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
		$sql[] = "ORDER BY t.glossario_palavra ASC";
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
					$rs['glossario_exibir_label'] = $rs['glossario_exibir']=='S'?'Sim':'Não';
					$rs['glossario_dt_hr'] = $this->dateDB2BR($rs['glossario_dt'])." às ".$rs['glossario_hr'];
					$rs['tags'] = $this->getTagsCadatradas($rs['glossario_id']);
					$rs['glossarios'] = $this->getGlossarioCadatradas($rs['glossario_id']);
					
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
		$sql[] = "AND		t.glossario_id = '{$this->values['glossario_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['tags'] = $this->getTagsCadatradas($rs['glossario_id']);
				$rs['glossarios'] = $this->getGlossarioCadatradas($rs['glossario_id']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['glossario_id'])&&trim($this->values['glossario_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['glossario_exibir'] = trim($this->values['glossario_exibir'])!=''?$this->values['glossario_exibir']:'N';
		$this->values['glossario_conteudo'] = $this->escape_string($this->values['glossario_conteudo']);
		$this->values['glossario_definicao'] = $this->escape_string($this->values['glossario_definicao']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_glossario SET
					glossario_palavra = '{$this->values['glossario_palavra']}'
					,glossario_definicao = '{$this->values['glossario_definicao']}'
					,glossario_fonte = '{$this->values['glossario_fonte']}'
					,glossario_link_fonte = '{$this->values['glossario_link_fonte']}'
					,glossario_conteudo = '{$this->values['glossario_conteudo']}'
					,glossario_exibir = '{$this->values['glossario_exibir']}'
					
			WHERE	glossario_id = '{$this->values['glossario_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteGlossario();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteTags();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$glossario_id = $this->values['glossario_id'];
		$result = $this->insertGlossario($this->values['glossarios'], $glossario_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertTags($this->values['tags'], $glossario_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$this->dbConn->db_commit();
		return $result;
	}

	private function insert(){
		$this->values['glossario_exibir'] = trim($this->values['glossario_exibir'])!=''?$this->values['glossario_exibir']:'N';
		$this->values['glossario_conteudo'] = $this->escape_string($this->values['glossario_conteudo']);
		$this->values['glossario_definicao'] = $this->escape_string($this->values['glossario_definicao']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_glossario SET
				glossario_palavra = '{$this->values['glossario_palavra']}'
				,glossario_dt = CURDATE()
				,glossario_hr = CURTIME()
				,glossario_definicao = '{$this->values['glossario_definicao']}'
				,glossario_fonte = '{$this->values['glossario_fonte']}'
				,glossario_link_fonte = '{$this->values['glossario_link_fonte']}'
				,glossario_conteudo = '{$this->values['glossario_conteudo']}'
				,glossario_exibir = '{$this->values['glossario_exibir']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$glossario_id = $result['last_id'];
		$result = $this->insertGlossario($this->values['glossarios'], $glossario_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertTags($this->values['tags'], $glossario_id);
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
			DELETE FROM tb_glossario_tag
			WHERE	glossario_id = '{$this->values['glossario_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertTags($tags,$glossario_id){
		if(count($tags) > 0){
			foreach($tags AS $tag){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_glossario_tag SET
						glossario_id = '{$glossario_id}'
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
	protected function deleteGlossario(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_glossario_relacionado
			WHERE	glossario_id = '{$this->values['glossario_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertGlossario($glossarios,$glossario_id){
		if(count($glossarios) > 0){
			foreach($glossarios AS $glossario){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_glossario_relacionado SET
						glossario_id = '{$glossario_id}'
						,glossario_id1 = '{$glossario}'
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
		$result = $this->deleteGlossario();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteTags();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$sql = array();
		$sql[] = "
			DELETE FROM tb_glossario
			WHERE glossario_id = '{$this->values['glossario_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	public function getTagsCadatradas($glossario_id){
		$sql = array();
		$sql[] = "
			SELECT	tag_id
			FROM	tb_glossario_tag
			WHERE	1 = 1
			AND		glossario_id = '{$glossario_id}'
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
	public function getGlossarioCadatradas($glossario_id){
		$sql = array();
		$sql[] = "
			SELECT	glossario_id1
			FROM	tb_glossario_relacionado
			WHERE	1 = 1
			AND		glossario_id = '{$glossario_id}'
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$arr[] = $rs['glossario_id1'];
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
	
	public function getGlossario($glossario_id){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_glossario t
			WHERE	1 = 1
			AND		glossario_id != '{$glossario_id}'
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
}