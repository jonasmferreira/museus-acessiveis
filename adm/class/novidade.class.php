<?php
$path_root_novidadeClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_novidadeClass = "{$path_root_novidadeClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_novidadeClass}adm{$DS}class{$DS}default.class.php";
class novidade extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.novidade_360_titulo'=>array(
			'fieldNameId'=>'t.novidade_360_titulo'
			,'fieldNameLabel'=>'Título'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.novidade_360_titulo_sintese'=>array(
			'fieldNameId'=>'t.novidade_360_titulo_sintese'
			,'fieldNameLabel'=>'Título Síntese'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.novidade_360_resumo'=>array(
			'fieldNameId'=>'t.novidade_360_resumo'
			,'fieldNameLabel'=>'Resumo'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.novidade_360_fonte'=>array(
			'fieldNameId'=>'t.novidade_360_fonte'
			,'fieldNameLabel'=>'Fonte'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		
	);
	
	public function __construct() {
		$path_root_novidadeClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_novidadeClass = "{$path_root_novidadeClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_novidadeClass}images{$DS}";
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
			FROM	tb_novidade_360 t
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
		if(isset($this->values['novidade_360_dt'])&&trim($this->values['novidade_360_dt'])!=''){
			$this->values['novidade_360_dt'] = $this->dateBR2DB($this->values['novidade_360_dt']);
			$sql[] = "AND t.novidade_360_dt_agenda >= '{$this->values['novidade_360_dt']}'";
		}
		if(isset($this->values['novidade_360_dt'])&&trim($this->values['novidade_360_dt'])!=''){
			$this->values['novidade_360_dt'] = $this->dateBR2DB($this->values['novidade_360_dt']);
			$sql[] = "AND t.novidade_360_dt_agenda <= '{$this->values['novidade_360_dt']}'";
		}

		if(isset($this->values['novidade_360_exibir_banner'])&&trim($this->values['novidade_360_exibir_banner'])!=''){
			$this->values['novidade_360_exibir_banner'] = $this->values['novidade_360_exibir_banner'];
			$sql[] = "AND t.novidade_360_exibir_banner = '{$this->values['novidade_360_exibir_banner']}'";
		}
		
		if(isset($this->values['novidade_360_exibir_destaque_home'])&&trim($this->values['novidade_360_exibir_destaque_home'])!=''){
			$this->values['novidade_360_exibir_destaque_home'] = $this->values['novidade_360_exibir_destaque_home'];
			$sql[] = "AND t.novidade_360_exibir_destaque_home = '{$this->values['novidade_360_exibir_destaque_home']}'";
		}

		if(isset($this->values['novidade_360_exibir_listagem'])&&trim($this->values['novidade_360_exibir_listagem'])!=''){
			$this->values['novidade_360_exibir_listagem'] = $this->values['novidade_360_exibir_listagem'];
			$sql[] = "AND t.novidade_360_exibir_listagem = '{$this->values['novidade_360_exibir_listagem']}'";
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
			$sql[] = "ORDER BY t.novidade_360_dt_agenda DESC, t.novidade_360_dt DESC, t.novidade_360_titulo_sintese ASC";
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
					
					$sData = ($rs['novidade_360_dt_agenda']!='0000-00-00') ? $rs['novidade_360_dt_agenda'] : $rs['novidade_360_dt'];
					$rs['data_ordenacao'] = $sData;
					
					$rs['novidade_360_dthr'] = $this->dateDB2BR($rs['novidade_360_dt'])." às ".$rs['novidade_360_hr'];
					$rs['novidade_360_dt_agenda'] = $this->dateDB2BR($rs['novidade_360_dt_agenda']);
					$rs['novidade_360_dt'] = $this->dateDB2BR($rs['novidade_360_dt']);
					$rs['novidade_360_exibir_destaque_home_label'] = $rs['novidade_360_exibir_destaque_home']=='S'?'Sim':'Não';
					$rs['novidade_360_exibir_banner_label'] = $rs['novidade_360_exibir_banner']=='S'?'Sim':'Não';
					$rs['novidade_360_exibir_listagem_label'] = $rs['novidade_360_exibir_listagem']=='S'?'Sim':'Não';
					$rs['tags'] = $this->getTagsCadatradas($rs['novidade_360_id']);
					$rs['tags_list'] = $this->getTagsByNovidades($rs['novidade_360_id']);
					$rs['downloads'] = $this->getDownloadCadastrados($rs['novidade_360_id']);
					$rs['download_list'] = $this->getDownloadByNovidade($rs['novidade_360_id']);
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
		$sql[] = "AND		t.novidade_360_id = '{$this->values['novidade_360_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['novidade_360_dthr'] = $this->dateDB2BR($rs['novidade_360_dt'])." às ".$rs['novidade_360_hr'];
				$rs['novidade_360_dt_agenda'] = $this->dateDB2BR($rs['novidade_360_dt_agenda']);
				$rs['tags'] = $this->getTagsCadatradas($rs['novidade_360_id']);
				$rs['tags_list'] = $this->getTagsByNovidades($rs['novidade_360_id']);
				$rs['downloads'] = $this->getDownloadCadastrados($rs['novidade_360_id']);
				$rs['download_list'] = $this->getDownloadByNovidade($rs['novidade_360_id']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['novidade_360_id'])&&trim($this->values['novidade_360_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['novidade_360_dt_agenda'] = $this->dateBR2DB($this->values['novidade_360_dt_agenda']);
		$this->values['novidade_360_dt'] = date('Y-m-d');
		$this->values['novidade_360_hr'] = date('H:i:s');		
		$this->values['novidade_360col'] = $this->escape_string($this->values['novidade_360col']);
		$this->values['novidade_360_titulo'] = $this->escape_string($this->values['novidade_360_titulo']);
		$this->values['novidade_360_titulo_sintese'] = $this->escape_string($this->values['novidade_360_titulo_sintese']);
		$this->values['novidade_360_resumo'] = $this->escape_string($this->values['novidade_360_resumo']);
		$this->values['novidade_360_conteudo'] = $this->escape_string($this->values['novidade_360_conteudo']);
		$this->values['novidade_360_thumb'] = $this->uploadFile($this->pathImg, $this->files['novidade_360_thumb']);
		$this->values['novidade_360_thumb_desc'] = $this->escape_string($this->values['novidade_360_thumb_desc']);
		$this->values['novidade_360_fonte'] = $this->escape_string($this->values['novidade_360_fonte']);
		$this->values['novidade_360_exibir_banner'] = trim($this->values['novidade_360_exibir_banner'])!=''?$this->values['novidade_360_exibir_banner']:'N';
		$this->values['novidade_360_banner'] = $this->uploadFile($this->pathImg, $this->files['novidade_360_banner']);
		$this->values['novidade_360_banner_desc'] = $this->escape_string($this->values['novidade_360_banner_desc']);
		$this->values['novidade_360_exibir_destaque_home'] = trim($this->values['novidade_360_exibir_destaque_home'])!=''?$this->values['novidade_360_exibir_destaque_home']:'N';
		$this->values['novidade_360_destaque_home'] = $this->uploadFile($this->pathImg, $this->files['novidade_360_destaque_home']);
		$this->values['novidade_360_destaque_home_desc'] = $this->escape_string($this->values['novidade_360_destaque_home_desc']);
		$this->values['novidade_360_destaque_home_frase'] = $this->escape_string($this->values['novidade_360_destaque_home_frase']);
		$this->values['novidade_360_exibir_listagem'] = trim($this->values['novidade_360_exibir_listagem'])!=''?$this->values['novidade_360_exibir_listagem']:'N';

		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_novidade_360 SET
					novidade_360_dt_agenda = '{$this->values['novidade_360_dt_agenda']}'
					,novidade_360_dt = '{$this->values['novidade_360_dt']}'
					,novidade_360_hr = '{$this->values['novidade_360_hr']}'
					,novidade_360_titulo = '{$this->values['novidade_360_titulo']}'
					,novidade_360_titulo_sintese = '{$this->values['novidade_360_titulo_sintese']}'
					,novidade_360_resumo = '{$this->values['novidade_360_resumo']}'
					,novidade_360_thumb_desc = '{$this->values['novidade_360_thumb_desc']}'
					,novidade_360_fonte = '{$this->values['novidade_360_fonte']}'
					,novidade_360_url_fonte = '{$this->values['novidade_360_url_fonte']}'
					,novidade_360_conteudo = '{$this->values['novidade_360_conteudo']}'
					,novidade_360_exibir_banner = '{$this->values['novidade_360_exibir_banner']}'
					,novidade_360_banner_desc = '{$this->values['novidade_360_banner_desc']}'
					,novidade_360_exibir_destaque_home = '{$this->values['novidade_360_exibir_destaque_home']}'
					,novidade_360_destaque_home_desc = '{$this->values['novidade_360_destaque_home_desc']}'
					,novidade_360_destaque_home_frase = '{$this->values['novidade_360_destaque_home_frase']}'
					,novidade_360_exibir_listagem = '{$this->values['novidade_360_exibir_listagem']}'
					
		";
		if(trim($this->values['novidade_360_thumb'])!=""){
			$sql[] = ",novidade_360_thumb = '{$this->values['novidade_360_thumb']}'";
		}
		if(trim($this->values['novidade_360_banner'])!=""){
			$sql[] = ",novidade_360_banner = '{$this->values['novidade_360_banner']}'";
		}
		if(trim($this->values['novidade_360_destaque_home'])!=""){
			$sql[] = ",novidade_360_destaque_home = '{$this->values['novidade_360_destaque_home']}'";
		}
		
		$sql[] = "WHERE	novidade_360_id = '{$this->values['novidade_360_id']}'";
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
		$result = $this->deleteDownload();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}

		$result = $this->deleteGaleria();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$novidade_360_id = $this->values['novidade_360_id'];
		$result = $this->insertTags($this->values['tags'], $novidade_360_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->insertDownload($this->values['downloads'], $novidade_360_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}

		$result = $this->insertGaleria($this->values['galeria_id'], $novidade_360_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$this->dbConn->db_commit();
		return $result;
	}

	private function insert(){
		$this->values['novidade_360_dt_agenda'] = $this->dateBR2DB($this->values['novidade_360_dt_agenda']);
		$this->values['novidade_360_dt'] = date('Y-m-d');
		$this->values['novidade_360_hr'] = date('H:i:s');		
		$this->values['novidade_360col'] = $this->escape_string($this->values['novidade_360col']);
		$this->values['novidade_360_titulo'] = $this->escape_string($this->values['novidade_360_titulo']);
		$this->values['novidade_360_titulo_sintese'] = $this->escape_string($this->values['novidade_360_titulo_sintese']);
		$this->values['novidade_360_resumo'] = $this->escape_string($this->values['novidade_360_resumo']);
		$this->values['novidade_360_conteudo'] = $this->escape_string($this->values['novidade_360_conteudo']);
		$this->values['novidade_360_thumb'] = $this->uploadFile($this->pathImg, $this->files['novidade_360_thumb']);
		$this->values['novidade_360_thumb_desc'] = $this->escape_string($this->values['novidade_360_thumb_desc']);
		$this->values['novidade_360_fonte'] = $this->escape_string($this->values['novidade_360_fonte']);
		$this->values['novidade_360_exibir_banner'] = trim($this->values['novidade_360_exibir_banner'])!=''?$this->values['novidade_360_exibir_banner']:'N';
		$this->values['novidade_360_banner'] = $this->uploadFile($this->pathImg, $this->files['novidade_360_banner']);
		$this->values['novidade_360_banner_desc'] = $this->escape_string($this->values['novidade_360_banner_desc']);
		$this->values['novidade_360_exibir_destaque_home'] = trim($this->values['novidade_360_exibir_destaque_home'])!=''?$this->values['novidade_360_exibir_destaque_home']:'N';
		$this->values['novidade_360_destaque_home'] = $this->uploadFile($this->pathImg, $this->files['novidade_360_destaque_home']);
		$this->values['novidade_360_destaque_home_desc'] = $this->escape_string($this->values['novidade_360_destaque_home_desc']);
		$this->values['novidade_360_destaque_home_frase'] = $this->escape_string($this->values['novidade_360_destaque_home_frase']);
		$this->values['novidade_360_exibir_listagem'] = trim($this->values['novidade_360_exibir_listagem'])!=''?$this->values['novidade_360_exibir_listagem']:'N';
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_novidade_360 SET
					novidade_360_dt_agenda = '{$this->values['novidade_360_dt_agenda']}'
					,novidade_360_dt = CURDATE()
					,novidade_360_hr = CURTIME()
					,novidade_360_titulo = '{$this->values['novidade_360_titulo']}'
					,novidade_360_titulo_sintese = '{$this->values['novidade_360_titulo_sintese']}'
					,novidade_360_resumo = '{$this->values['novidade_360_resumo']}'
					,novidade_360_thumb = '{$this->values['novidade_360_thumb']}'
					,novidade_360_thumb_desc = '{$this->values['novidade_360_thumb_desc']}'
					,novidade_360_fonte = '{$this->values['novidade_360_fonte']}'
					,novidade_360_url_fonte = '{$this->values['novidade_360_url_fonte']}'
					,novidade_360_conteudo = '{$this->values['novidade_360_conteudo']}'
					,novidade_360_exibir_banner = '{$this->values['novidade_360_exibir_banner']}'
					,novidade_360_banner = '{$this->values['novidade_360_banner']}'
					,novidade_360_banner_desc = '{$this->values['novidade_360_banner_desc']}'
					,novidade_360_exibir_destaque_home = '{$this->values['novidade_360_exibir_destaque_home']}'
					,novidade_360_destaque_home = '{$this->values['novidade_360_destaque_home']}'
					,novidade_360_destaque_home_desc = '{$this->values['novidade_360_destaque_home_desc']}'
					,novidade_360_destaque_home_frase = '{$this->values['novidade_360_destaque_home_frase']}'
					,novidade_360_exibir_listagem = '{$this->values['novidade_360_exibir_listagem']}'
					
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$novidade_360_id = $result['last_id'];
		$result = $this->insertTags($this->values['tags'], $novidade_360_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->insertDownload($this->values['downloads'], $novidade_360_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->insertGaleria($this->values['galeria_id'], $novidade_360_id);
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
			DELETE FROM tb_novidade_360_tag
			WHERE	novidade_360_id = '{$this->values['novidade_360_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertTags($tags,$novidade_360_id){
		if(count($tags) > 0){
			foreach($tags AS $tag){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_novidade_360_tag SET
						novidade_360_id = '{$novidade_360_id}'
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
			DELETE FROM tb_novidade_360
			WHERE novidade_360_id = '{$this->values['novidade_360_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	public function getTagsCadatradas($novidade_360_id){
		$sql = array();
		$sql[] = "
			SELECT	tag_id
			FROM	tb_novidade_360_tag
			WHERE	1 = 1
			AND		novidade_360_id = '{$novidade_360_id}'
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

	public function getNovidadeGaleriaItem($id){
		$sql = array();

		$arr = array();
		$aGal = array();
		$arr['galeria']= $this->getNovidadeGaleria($id);
		$galeria_id = $arr['galeria']['galeria_id'];
		
		$sql[] = "
			SELECT    gi.*
			FROM	tb_galeria g
			JOIN  tb_galeria_imagem gi
			ON    gi.galeria_id = g.galeria_id
			WHERE	1 = 1
			AND		g.galeria_id = {$galeria_id}
		";
		
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					array_push($aGal,$this->utf8_array_encode($rs));
				}
			}
		}
		$arr['rows'] = $aGal;
		return $arr;
	}
	
	
	public function getNovidadeGaleria($id){
		$sql = array();
		$sql[] = "
			SELECT	g.*,
					ng.*
			FROM	tb_galeria g
			JOIN	tb_novidade_360_galeria ng
			ON		ng.galeria_id = g.galeria_id
			WHERE	1 = 1
			AND		ng.novidade_360_id = {$id}
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
	
	public function getGaleria(){
		$sql = array();
		$sql[] = "
			SELECT	g.*
			FROM	tb_galeria g
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
			UPDATE tb_novidade_360 SET
				{$this->values['img']} = ''
			WHERE	novidade_360_id = '{$this->values['novidade_360_id']}'
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

	protected function deleteGaleria(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_novidade_360_galeria
			WHERE	novidade_360_id = '{$this->values['novidade_360_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	
	protected function deleteDownload(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_novidade_360_download
			WHERE	novidade_360_id = '{$this->values['novidade_360_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertDownload($downloads,$novidade_360_id){
		if(count($downloads) > 0){
			foreach($downloads AS $download){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_novidade_360_download SET
						novidade_360_id = '{$novidade_360_id}'
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

	protected function insertGaleria($galeria_id,$novidade_360_id){
		
		//if($galeria_id!=0){
			$sql = array();
			$sql[] = "
				INSERT INTO tb_novidade_360_galeria SET
					novidade_360_id = {$novidade_360_id}
					,galeria_id = {$galeria_id}
			";
			$result = $this->dbConn->db_execute(implode("\n",$sql));
			if($result['success']===false){
				return array('success'=>'false');
			}else{
				return array('success'=>'true');
			}
		//}else{
		//	return array('success'=>'true');
		//}
	}
	
	
	public function getDownloadByNovidade($novidade_360_id, $sOrder='', $direction=''){
		$sql = array();
		
		if(trim($direction=='')){
			$direction = 'DESC';
		}
		
		if(trim($sOrder=='')){
			$sOrder = 't.download_dt';
		}
		
		$sql[] = "
			SELECT	pd.novidade_360_id, t.*, tc.download_categoria_titulo
			FROM	tb_novidade_360_download pd
			JOIN	tb_download t
			ON		pd.download_id = t.download_id
			JOIN	tb_download_categoria tc
			ON		t.download_categoria_id = tc.download_categoria_id			
			WHERE	1 = 1
			AND		novidade_360_id = {$novidade_360_id}
			ORDER BY {$sOrder} {$direction}
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$rs['download_dt'] = $this->dateDB2BR($rs['download_dt']);
					$rs['download_tamanho_label'] = $this->getSizeName($rs['download_tamanho']);					
					array_push($arr,$this->utf8_array_encode($rs));					
				}
			}
		}
		return $arr;
	}

	public function getTagsByNovidades($novidade_360_id){
		$sql = array();
		$sql[] = "
			SELECT	tp.tag_id, t.tag_titulo
			FROM	tb_novidade_360_tag tp
			JOIN	tb_tag t
			ON		tp.tag_id = t.tag_id
			WHERE	1 = 1
			AND		novidade_360_id = '{$novidade_360_id}'
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

	public function getDownloadByNovidades($novidade_360_id, $sOrder='', $direction=''){
		$sql = array();
		
		if(trim($direction=='')){
			$direction = 'DESC';
		}
		
		if(trim($sOrder=='')){
			$sOrder = 't.download_dt';
		}
		
		$sql[] = "
			SELECT	pd.novidade_360_id, t.*, tc.download_categoria_titulo
			FROM	tb_novidade_360_download pd
			JOIN	tb_download t
			ON		pd.download_id = t.download_id
			JOIN	tb_download_categoria tc
			ON		t.download_categoria_id = tc.download_categoria_id
			WHERE	1 = 1
			AND		novidade_360_id = {$novidade_360_id}
			ORDER BY {$sOrder} {$direction}
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$rs['download_dt'] = $this->dateDB2BR($rs['download_dt']);
					$rs['download_tamanho_label'] = $this->getSizeName($rs['download_tamanho']);					
					array_push($arr,$this->utf8_array_encode($rs));					
				}
			}
		}
		return $arr;
	}
	
	public function getDownloadCadastrados($novidade_360_id){
		$sql = array();
		$sql[] = "
			SELECT	download_id
			FROM	tb_novidade_360_download
			WHERE	1 = 1
			AND		novidade_360_id = '{$novidade_360_id}'
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
	
}