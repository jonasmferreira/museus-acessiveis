<?php
$path_root_cursoClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_cursoClass = "{$path_root_cursoClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_cursoClass}adm{$DS}class{$DS}default.class.php";
class curso extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.curso_titulo'=>array(
			'fieldNameId'=>'t.curso_titulo'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	public function __construct() {
		$path_root_cursoClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_cursoClass = "{$path_root_cursoClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_cursoClass}images{$DS}";
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
			FROM	tb_curso t
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
			$sql[] = "AND t.curso_agenda >= '{$this->values['data_ini']}'";
		}
		if(isset($this->values['data_fim'])&&trim($this->values['data_fim'])!=''){
			$this->values['data_fim'] = $this->dateBR2DB($this->values['data_fim']);
			$sql[] = "AND t.curso_agenda <= '{$this->values['data_fim']}'";
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
		$sql[] = "ORDER BY t.curso_agenda ASC";
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
					$rs['curso_sob_demanda_label'] = $rs['curso_sob_demanda']=='S'?'Sim':'Não';
					$rs['curso_dt_hr'] = $this->dateDB2BR($rs['curso_dt'])." às ".$rs['curso_hr'];
					$rs['curso_dt_ini'] = $this->dateDB2BR($rs['curso_dt_ini']);
					$rs['curso_dt_fim'] = $this->dateDB2BR($rs['curso_dt_fim']);
					$rs['curso_agenda'] = $this->dateDB2BR($rs['curso_agenda']);
					$rs['tags'] = $this->getTagsCadatradas($rs['curso_id']);
					$rs['glossario'] = $this->getGlossarioCadatradas($rs['curso_id']);
					$rs['downloads'] = $this->getDownloadCadastrados($rs['curso_id']);
					$rs['extras'] = $this->getExtraCadastrados($rs['curso_id']);
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
		$sql[] = "AND		t.curso_id = '{$this->values['curso_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['curso_sob_demanda_label'] = $rs['curso_sob_demanda']=='S'?'Sim':'Não';
				$rs['curso_dt_hr'] = $this->dateDB2BR($rs['curso_dt'])." às ".$rs['curso_hr'];
				$rs['curso_dt_ini'] = $this->dateDB2BR($rs['curso_dt_ini']);
				$rs['curso_dt_fim'] = $this->dateDB2BR($rs['curso_dt_fim']);
				$rs['curso_agenda'] = $this->dateDB2BR($rs['curso_agenda']);
				$rs['tags'] = $this->getTagsCadatradas($rs['curso_id']);
				$rs['glossario'] = $this->getGlossarioCadatradas($rs['curso_id']);
				$rs['downloads'] = $this->getDownloadCadastrados($rs['curso_id']);
				$rs['extras'] = $this->getExtraCadastrados($rs['curso_id']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['curso_id'])&&trim($this->values['curso_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['curso_sob_demanda'] = trim($this->values['curso_sob_demanda'])!=''?$this->values['curso_sob_demanda']:'N';
		$this->values['curso_conteudo'] = $this->escape_string($this->values['curso_conteudo']);
		$this->values['curso_resumo'] = $this->escape_string($this->values['curso_resumo']);
		$this->values['curso_thumb_desc'] = $this->escape_string($this->values['curso_resumo']);
		$this->values['curso_thumb'] = $this->uploadFile($this->pathImg, $this->files['curso_thumb']);
		$this->values['curso_dt_ini'] = $this->dateBR2DB($this->values['curso_dt_ini']);
		$this->values['curso_dt_fim'] = $this->dateBR2DB($this->values['curso_dt_fim']);
		$this->values['curso_agenda'] = $this->dateBR2DB($this->values['curso_agenda']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_curso SET
					curso_dt_ini = '{$this->values['curso_dt_ini']}'
					,curso_dt_fim = '{$this->values['curso_dt_fim']}'
					,curso_sob_demanda = '{$this->values['curso_sob_demanda']}'
					,curso_titulo = '{$this->values['curso_titulo']}'
					,curso_resumo = '{$this->values['curso_resumo']}'
					,curso_thumb = '{$this->values['curso_thumb']}'
					,curso_thumb_desc = '{$this->values['curso_thumb_desc']}'
					,curso_fonte = '{$this->values['curso_fonte']}'
					,curso_link_fonte = '{$this->values['curso_link_fonte']}'
					,curso_conteudo = '{$this->values['curso_conteudo']}'
					,curso_agenda = '{$this->values['curso_agenda']}'
					
			WHERE	curso_id = '{$this->values['curso_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteExtras();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->deleteDownload();
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
		$curso_id = $this->values['curso_id'];
		$result = $this->insertExtras($this->values['extras'], $curso_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertDownload($this->values['downloads'], $curso_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertGlossario($this->values['glossarios'], $curso_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertTags($this->values['tags'], $curso_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$this->dbConn->db_commit();
		return $result;
	}

	private function insert(){
		$this->values['curso_sob_demanda'] = trim($this->values['curso_sob_demanda'])!=''?$this->values['curso_sob_demanda']:'N';
		$this->values['curso_conteudo'] = $this->escape_string($this->values['curso_conteudo']);
		$this->values['curso_resumo'] = $this->escape_string($this->values['curso_resumo']);
		$this->values['curso_thumb_desc'] = $this->escape_string($this->values['curso_resumo']);
		$this->values['curso_thumb'] = $this->uploadFile($this->pathImg, $this->files['curso_thumb']);
		$this->values['curso_dt_ini'] = $this->dateBR2DB($this->values['curso_dt_ini']);
		$this->values['curso_dt_fim'] = $this->dateBR2DB($this->values['curso_dt_fim']);
		$this->values['curso_agenda'] = $this->dateBR2DB($this->values['curso_agenda']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_curso SET
				curso_dt_cad = CURDATE()
				,curso_hr_cad = CURTIME()
				,curso_dt_ini = '{$this->values['curso_dt_ini']}'
				,curso_dt_fim = '{$this->values['curso_dt_fim']}'
				,curso_sob_demanda = '{$this->values['curso_sob_demanda']}'
				,curso_titulo = '{$this->values['curso_titulo']}'
				,curso_resumo = '{$this->values['curso_resumo']}'
				,curso_thumb = '{$this->values['curso_thumb']}'
				,curso_thumb_desc = '{$this->values['curso_thumb_desc']}'
				,curso_fonte = '{$this->values['curso_fonte']}'
				,curso_link_fonte = '{$this->values['curso_link_fonte']}'
				,curso_conteudo = '{$this->values['curso_conteudo']}'
				,curso_agenda = '{$this->values['curso_agenda']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$curso_id = $result['last_id'];
		$result = $this->insertExtras($this->values['extras'], $curso_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertDownload($this->values['downloads'], $curso_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertGlossario($this->values['glossarios'], $curso_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertTags($this->values['tags'], $curso_id);
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
			DELETE FROM tb_curso_tag
			WHERE	curso_id = '{$this->values['curso_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertTags($tags,$curso_id){
		if(count($tags) > 0){
			foreach($tags AS $tag){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_curso_tag SET
						curso_id = '{$curso_id}'
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
			DELETE FROM tb_curso_glossario
			WHERE	curso_id = '{$this->values['curso_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertGlossario($glossarios,$curso_id){
		if(count($glossarios) > 0){
			foreach($glossarios AS $glossario){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_curso_glossario SET
						curso_id = '{$curso_id}'
						,glossario_id = '{$glossario}'
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
	protected function deleteDownload(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_curso_download
			WHERE	curso_id = '{$this->values['curso_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertDownload($downloads,$curso_id){
		if(count($downloads) > 0){
			foreach($downloads AS $download){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_curso_download SET
						curso_id = '{$curso_id}'
						,download_id = '{$download}'
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
	protected function deleteExtras(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_curso_extra
			WHERE	curso_id = '{$this->values['curso_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertExtras($extras,$curso_id){
		if(count($extras) > 0){
			foreach($extras AS $k=> $extra){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_curso_extra SET
						curso_id = '{$curso_id}'
						,extra_id = '{$k}'
						,curso_extra_valor = '{$extra}'
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
		$result = $this->deleteExtras();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteDownload();
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
		$sql = array();
		$sql[] = "
			DELETE FROM tb_curso
			WHERE curso_id = '{$this->values['curso_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	public function getTagsCadatradas($curso_id){
		$sql = array();
		$sql[] = "
			SELECT	tag_id
			FROM	tb_curso_tag
			WHERE	1 = 1
			AND		curso_id = '{$curso_id}'
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
	public function getDownloadCadastrados($curso_id){
		$sql = array();
		$sql[] = "
			SELECT	download_id
			FROM	tb_curso_download
			WHERE	1 = 1
			AND		curso_id = '{$curso_id}'
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$arr[] = $rs['download_id'];
				}
			}
		}
		return $arr;
	}
	
	public function getGlossarioCadatradas($curso_id){
		$sql = array();
		$sql[] = "
			SELECT	glossario_id
			FROM	tb_curso_glossario
			WHERE	1 = 1
			AND		curso_id = '{$curso_id}'
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$arr[] = $rs['glossario_id'];
				}
			}
		}
		return $arr;
	}
	
	public function getExtraCadastrados($curso_id){
		$sql = array();
		$sql[] = "
			SELECT	extra_id
					,curso_extra_valor
			FROM	tb_curso_extra
			WHERE	1 = 1
			AND		curso_id = '{$curso_id}'
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$arr[$rs['extra_id']] = $rs['curso_extra_valor'];
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
	
	public function getGlossario(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_glossario t
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
	public function getDownload(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_download t
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
	public function getExtra(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_extra t
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
}