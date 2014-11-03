<?php
$path_root_galeriaClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_galeriaClass = "{$path_root_galeriaClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_galeriaClass}adm{$DS}class{$DS}default.class.php";
class galeria extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.galeria_titulo'=>array(
			'fieldNameId'=>'t.galeria_titulo'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'galeria_imagem_titulo'=>array(
			'fieldNameId'=>'galeria_imagem_titulo'
			,'fieldNameLabel'=>'Arquivo'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		
	);
	
	public function __construct() {
		$path_root_galeriaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_galeriaClass = "{$path_root_galeriaClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_galeriaClass}galeriaImagem{$DS}";
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
			FROM	tb_galeria t
			WHERE	1 = 1
		";
		return implode("\n",$sql);
	}
	public function getImagemGaleria($galeria_id){
		$sql = array();
		$sql[] = "
			SELECT	*
			FROM	tb_galeria_imagem
			WHERE	galeria_id = '{$galeria_id}'
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
	public function getImagemGaleriaOne($galeria_imagem_id){
		$sql = array();
		$sql[] = "
			SELECT	*
			FROM	tb_galeria_imagem
			WHERE	galeria_imagem_id = '{$galeria_imagem_id}'
		";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
			}
		}
		return $this->utf8_array_encode($rs);
	}
	public function getLista(){
		$page = $this->values['page']; 
		// get the requested page 
		$limit = $this->values['rows']; 
		
		$sql = array();
		$sql[] = $this->getSql();
		if(isset($this->values['fieldName'])&&trim($this->values['fieldName'])!=''){
			if(isset($this->values['txtPesquisar'])&&trim($this->values['txtPesquisar'])!=''){
				if($this->values['fieldName']=="galeria_imagem_titulo"){
					$sql[] = "AND t.galeria_id IN (
						SELECT	galeria_id
						FROM	galeria_imagem
						WHERE	{$this->values['fieldName']} LIKE '%{$this->values['txtPesquisar']}%'
					)";
				}
				
			}
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
			$sql[] = "ORDER BY t.galeria_titulo ASC ";
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
					$rs['galeriaImagens'] = $this->getImagemGaleria($rs['galeria_id']);
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
		$sql[] = "AND		t.galeria_id = '{$this->values['galeria_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['galeriaImagens'] = $this->getImagemGaleria($rs['galeria_id']);
			}
		}
		return $this->utf8_array_encode($rs);
	}
	
	public function edit(){
		if(isset($this->values['galeria_id'])&&trim($this->values['galeria_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}
	private function updateImagem($aArr){
		$sql = array();
		$sql[] = "
			UPDATE tb_galeria_imagem SET
				galeria_id = '{$aArr['galeria_id']}'
				,galeria_imagem_titulo = '{$aArr['galeria_imagem_titulo']}'
				,galeria_imagem_descricao = '{$aArr['galeria_imagem_descricao']}'
		";
		if(isset($aArr['galeria_imagem_arq'])&&trim($aArr['galeria_imagem_arq'])!=''){
			$sql[] = ",galeria_imagem_arq = '{$aArr['galeria_imagem_arq']}'";
		}
		$sql[] = "WHERE galeria_imagem_id = '{$aArr['galeria_imagem_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	private function insertImagem($aArr){
		$sql = array();
		$sql[] = "
			INSERT INTO tb_galeria_imagem SET
				galeria_id = '{$aArr['galeria_id']}'
				,galeria_imagem_titulo = '{$aArr['galeria_imagem_titulo']}'
				,galeria_imagem_descricao = '{$aArr['galeria_imagem_descricao']}'
		";
		if(isset($aArr['galeria_imagem_arq'])&&trim($aArr['galeria_imagem_arq'])!=''){
			$sql[] = ",galeria_imagem_arq = '{$aArr['galeria_imagem_arq']}'";
		}
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	private function processarImagens($galeria_id){
		if(is_array($this->values['galeria_imagem_id'])){
			foreach($this->values['galeria_imagem_id'] AS $k=>$v){
				$aArr = array();
				$aArr['galeria_imagem_id'] = $v;
				$aArr['galeria_id'] = $galeria_id;
				$aArr2 = array();;
				$aArr2['name'] = $this->files['galeria_imagem_arq']['name'][$k];
				$aArr2['tmp_name'] = $this->files['galeria_imagem_arq']['tmp_name'][$k];
				//$this->debug($aArr2);
				//die();
				$aArr['galeria_imagem_arq'] = $this->uploadFile($this->pathImg, $aArr2);
				$aArr['galeria_imagem_titulo'] = $this->escape_string($this->values['galeria_imagem_titulo'][$k]);
				$aArr['galeria_imagem_descricao'] = $this->escape_string($this->values['galeria_imagem_descricao'][$k]);
				if(isset($aArr['galeria_imagem_id'])&&trim($aArr['galeria_imagem_id'])!=''){
					$this->updateImagem($aArr);
				}else{
					$this->insertImagem($aArr);
				}
			}
		}
	}
	private function update(){
		$this->values['galeria_titulo'] = $this->escape_string($this->values['galeria_titulo']);
		$this->values['galeria_descricao'] = $this->escape_string($this->values['galeria_descricao']);
		$this->values['galeria_resumo'] = $this->escape_string($this->values['galeria_resumo']);
				
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_galeria SET
				galeria_titulo = '{$this->values['galeria_titulo']}'
				,galeria_descricao = '{$this->values['galeria_descricao']}'
				,galeria_resumo = '{$this->values['galeria_resumo']}'
			WHERE	galeria_id = '{$this->values['galeria_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->processarImagens($this->values['galeria_id']);
			$this->dbConn->db_commit();
		}
		return $result;
	}

	private function insert(){
		$this->values['galeria_titulo'] = $this->escape_string($this->values['galeria_titulo']);
		$this->values['galeria_descricao'] = $this->escape_string($this->values['galeria_descricao']);
		$this->values['galeria_resumo'] = $this->escape_string($this->values['galeria_resumo']);
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT	INTO tb_galeria SET
				galeria_titulo = '{$this->values['galeria_titulo']}'
				,galeria_descricao = '{$this->values['galeria_descricao']}'
				,galeria_resumo = '{$this->values['galeria_resumo']}'
					
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->processarImagens($result['last_id']);
			$this->dbConn->db_commit();
		}
		return $result;
	}
	protected function deleteImages($galeria_id){
		$aImg = $this->getImagemGaleria($galeria_id);
		
		$sql = array();
		$sql[] = "
			DELETE FROM	tb_galeria_imagem WHERE galeria_id = '{$this->values['galeria_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']!==false){
			if(count($aImg)){
				foreach($aImg AS $v){
					@unlink("{$this->pathImg}{$v['galeria_imagem_arq']}");
				}
			}
		}
		return $result;
	}	
	public function deleteItem(){
		$this->dbConn->db_start_transaction();
		$result = $this->deleteImages($this->values['galeria_id']);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$sql = array();
		$sql[] = "
			DELETE FROM tb_galeria
			WHERE galeria_id = '{$this->values['galeria_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		
		return $result;
	}
	
	public function deleteImagem($galeria_imagem_id){
		$img = getImagemGaleriaOne($galeria_imagem_id);
		$sql = array();
		$sql[] = "
			DELETE FROM tb_galeria_imagem
			WHERE galeria_imagem_id = '{$galeria_imagem_id}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		@unlink("{$this->pathImg}{$img['galeria_imagem_arq']}");
		return $result;
	}
	
}