<?php
$path_root_clippingClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_clippingClass = "{$path_root_clippingClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_clippingClass}adm{$DS}class{$DS}default.class.php";
class clipping extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.clipping_titulo'=>array(
			'fieldNameId'=>'t.clipping_titulo'
			,'fieldNameLabel'=>'Título'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.clipping_titulo_sintese'=>array(
			'fieldNameId'=>'t.clipping_titulo_sintese'
			,'fieldNameLabel'=>'Título Síntese'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.clipping_resumo'=>array(
			'fieldNameId'=>'t.clipping_resumo'
			,'fieldNameLabel'=>'Resumo'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.clipping_fonte'=>array(
			'fieldNameId'=>'t.clipping_fonte'
			,'fieldNameLabel'=>'Fonte'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		
	);
	
	public function __construct() {
		$path_root_clippingClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_clippingClass = "{$path_root_clippingClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_clippingClass}images{$DS}";
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
			FROM	tb_clipping t
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
		if(isset($this->values['clipping_dt'])&&trim($this->values['clipping_dt'])!=''){
			$this->values['clipping_dt'] = $this->dateBR2DB($this->values['clipping_dt']);
			$sql[] = "AND t.clipping_dt_agenda >= '{$this->values['clipping_dt']}'";
		}
		if(isset($this->values['clipping_dt'])&&trim($this->values['clipping_dt'])!=''){
			$this->values['clipping_dt'] = $this->dateBR2DB($this->values['clipping_dt']);
			$sql[] = "AND t.clipping_dt_agenda <= '{$this->values['clipping_dt']}'";
		}

		if(isset($this->values['clipping_exibir_banner'])&&trim($this->values['clipping_exibir_banner'])!=''){
			$this->values['clipping_exibir_banner'] = $this->values['clipping_exibir_banner'];
			$sql[] = "AND t.clipping_exibir_banner = '{$this->values['clipping_exibir_banner']}'";
		}
		
		if(isset($this->values['clipping_exibir_destaque_home'])&&trim($this->values['clipping_exibir_destaque_home'])!=''){
			$this->values['clipping_exibir_destaque_home'] = $this->values['clipping_exibir_destaque_home'];
			$sql[] = "AND t.clipping_exibir_destaque_home = '{$this->values['clipping_exibir_destaque_home']}'";
		}

		if(isset($this->values['clipping_exibir_listagem'])&&trim($this->values['clipping_exibir_listagem'])!=''){
			$this->values['clipping_exibir_listagem'] = $this->values['clipping_exibir_listagem'];
			$sql[] = "AND t.clipping_exibir_listagem = '{$this->values['clipping_exibir_listagem']}'";
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
			$sql[] = "ORDER BY t.clipping_dt_agenda ASC";
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
					$rs['clipping_dthr'] = $this->dateDB2BR($rs['clipping_dt'])." às ".$rs['clipping_hr'];
					$rs['clipping_dt_agenda'] = $this->dateDB2BR($rs['clipping_dt_agenda']);
					$rs['clipping_exibir_destaque_home_label'] = $rs['clipping_exibir_destaque_home']=='S'?'Sim':'Não';
					$rs['clipping_exibir_banner_label'] = $rs['clipping_exibir_banner']=='S'?'Sim':'Não';
					$rs['clipping_exibir_listagem_label'] = $rs['clipping_exibir_listagem']=='S'?'Sim':'Não';
					$rs['tags'] = $this->getTagsCadatradas($rs['clipping_id']);
					$rs['tags_list'] = $this->getTagsByClipping($rs['clipping_id']);
					$rs['downloads'] = $this->getDownloadCadastrados($rs['clipping_id']);
					$rs['download_list'] = $this->getDownloadByClipping($rs['clipping_id']);
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
		$sql[] = "AND		t.clipping_id = '{$this->values['clipping_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['clipping_dthr'] = $this->dateDB2BR($rs['clipping_dt'])." às ".$rs['clipping_hr'];
				$rs['clipping_dt_agenda'] = $this->dateDB2BR($rs['clipping_dt_agenda']);
				$rs['tags'] = $this->getTagsCadatradas($rs['clipping_id']);
				$rs['tags_list'] = $this->getTagsByClipping($rs['clipping_id']);
				$rs['downloads'] = $this->getDownloadCadastrados($rs['clipping_id']);
				$rs['download_list'] = $this->getDownloadByClipping($rs['clipping_id']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['clipping_id'])&&trim($this->values['clipping_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['clipping_dt_agenda'] = $this->dateBR2DB($this->values['clipping_dt_agenda']);
		$this->values['clipping_dt'] = $this->dateBR2DB($this->values['clipping_dt']);
		//$this->values['clipping_dt'] = date('Y-m-d');
		$this->values['clipping_hr'] = date('H:i:s');		
		$this->values['clippingcol'] = $this->escape_string($this->values['clippingcol']);
		$this->values['clipping_titulo'] = $this->escape_string($this->values['clipping_titulo']);
		$this->values['clipping_titulo_sintese'] = $this->escape_string($this->values['clipping_titulo_sintese']);
		$this->values['clipping_resumo'] = $this->escape_string($this->values['clipping_resumo']);
		$this->values['clipping_conteudo'] = $this->escape_string($this->values['clipping_conteudo']);
		$this->values['clipping_thumb'] = $this->uploadFile($this->pathImg, $this->files['clipping_thumb']);
		$this->values['clipping_thumb_desc'] = $this->escape_string($this->values['clipping_thumb_desc']);
		$this->values['clipping_fonte'] = $this->escape_string($this->values['clipping_fonte']);
		$this->values['clipping_exibir_banner'] = trim($this->values['clipping_exibir_banner'])!=''?$this->values['clipping_exibir_banner']:'N';
		$this->values['clipping_banner'] = $this->uploadFile($this->pathImg, $this->files['clipping_banner']);
		$this->values['clipping_banner_desc'] = $this->escape_string($this->values['clipping_banner_desc']);
		$this->values['clipping_exibir_destaque_home'] = trim($this->values['clipping_exibir_destaque_home'])!=''?$this->values['clipping_exibir_destaque_home']:'N';
		$this->values['clipping_destaque_home'] = $this->uploadFile($this->pathImg, $this->files['clipping_destaque_home']);
		$this->values['clipping_destaque_home_desc'] = $this->escape_string($this->values['clipping_destaque_home_desc']);
		$this->values['clipping_destaque_home_frase'] = $this->escape_string($this->values['clipping_destaque_home_frase']);
		$this->values['clipping_exibir_listagem'] = trim($this->values['clipping_exibir_listagem'])!=''?$this->values['clipping_exibir_listagem']:'N';
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_clipping SET
					clipping_dt_agenda = '{$this->values['clipping_dt_agenda']}'
					,clipping_dt = '{$this->values['clipping_dt']}'
					,clipping_hr = '{$this->values['clipping_hr']}'
					,clipping_titulo = '{$this->values['clipping_titulo']}'
					,clipping_titulo_sintese = '{$this->values['clipping_titulo_sintese']}'
					,clipping_resumo = '{$this->values['clipping_resumo']}'
					,clipping_thumb_desc = '{$this->values['clipping_thumb_desc']}'
					,clipping_fonte = '{$this->values['clipping_fonte']}'
					,clipping_url_fonte = '{$this->values['clipping_url_fonte']}'
					,clipping_conteudo = '{$this->values['clipping_conteudo']}'
					,clipping_exibir_banner = '{$this->values['clipping_exibir_banner']}'
					,clipping_banner_desc = '{$this->values['clipping_banner_desc']}'
					,clipping_exibir_destaque_home = '{$this->values['clipping_exibir_destaque_home']}'
					,clipping_destaque_home_desc = '{$this->values['clipping_destaque_home_desc']}'
					,clipping_destaque_home_frase = '{$this->values['clipping_destaque_home_frase']}'
					,clipping_exibir_listagem = '{$this->values['clipping_exibir_listagem']}'
					
		";
		if(trim($this->values['clipping_thumb'])!=""){
			$sql[] = ",clipping_thumb = '{$this->values['clipping_thumb']}'";
		}
		if(trim($this->values['clipping_banner'])!=""){
			$sql[] = ",clipping_banner = '{$this->values['clipping_banner']}'";
		}
		if(trim($this->values['clipping_destaque_home'])!=""){
			$sql[] = ",clipping_destaque_home = '{$this->values['clipping_destaque_home']}'";
		}
		
		$sql[] = "WHERE	clipping_id = '{$this->values['clipping_id']}'";
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
		
		$clipping_id = $this->values['clipping_id'];
		$result = $this->insertTags($this->values['tags'], $clipping_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->insertDownload($this->values['downloads'], $clipping_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->insertGaleria($this->values['galeria_id'], $clipping_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$this->dbConn->db_commit();
		return $result;
	}

	private function insert(){
		$this->values['clipping_dt_agenda'] = $this->dateBR2DB($this->values['clipping_dt_agenda']);
		$this->values['clipping_dt'] = $this->dateBR2DB($this->values['clipping_dt']);
		//$this->values['clipping_dt'] = date('Y-m-d');
		$this->values['clipping_hr'] = date('H:i:s');		
		$this->values['clippingcol'] = $this->escape_string($this->values['clippingcol']);
		$this->values['clipping_titulo'] = $this->escape_string($this->values['clipping_titulo']);
		$this->values['clipping_titulo_sintese'] = $this->escape_string($this->values['clipping_titulo_sintese']);
		$this->values['clipping_resumo'] = $this->escape_string($this->values['clipping_resumo']);
		$this->values['clipping_conteudo'] = $this->escape_string($this->values['clipping_conteudo']);
		$this->values['clipping_thumb'] = $this->uploadFile($this->pathImg, $this->files['clipping_thumb']);
		$this->values['clipping_thumb_desc'] = $this->escape_string($this->values['clipping_thumb_desc']);
		$this->values['clipping_fonte'] = $this->escape_string($this->values['clipping_fonte']);
		$this->values['clipping_exibir_banner'] = trim($this->values['clipping_exibir_banner'])!=''?$this->values['clipping_exibir_banner']:'N';
		$this->values['clipping_banner'] = $this->uploadFile($this->pathImg, $this->files['clipping_banner']);
		$this->values['clipping_banner_desc'] = $this->escape_string($this->values['clipping_banner_desc']);
		$this->values['clipping_exibir_destaque_home'] = trim($this->values['clipping_exibir_destaque_home'])!=''?$this->values['clipping_exibir_destaque_home']:'N';
		$this->values['clipping_destaque_home'] = $this->uploadFile($this->pathImg, $this->files['clipping_destaque_home']);
		$this->values['clipping_destaque_home_desc'] = $this->escape_string($this->values['clipping_destaque_home_desc']);
		$this->values['clipping_destaque_home_frase'] = $this->escape_string($this->values['clipping_destaque_home_frase']);
		$this->values['clipping_exibir_listagem'] = trim($this->values['clipping_exibir_listagem'])!=''?$this->values['clipping_exibir_listagem']:'N';
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_clipping SET
					clipping_dt_agenda = '{$this->values['clipping_dt_agenda']}'
					,clipping_dt = '{$this->values['clipping_dt']}'
					,clipping_hr = CURTIME()
					,clipping_titulo = '{$this->values['clipping_titulo']}'
					,clipping_titulo_sintese = '{$this->values['clipping_titulo_sintese']}'
					,clipping_resumo = '{$this->values['clipping_resumo']}'
					,clipping_thumb = '{$this->values['clipping_thumb']}'
					,clipping_thumb_desc = '{$this->values['clipping_thumb_desc']}'
					,clipping_fonte = '{$this->values['clipping_fonte']}'
					,clipping_url_fonte = '{$this->values['clipping_url_fonte']}'
					,clipping_conteudo = '{$this->values['clipping_conteudo']}'
					,clipping_exibir_banner = '{$this->values['clipping_exibir_banner']}'
					,clipping_banner = '{$this->values['clipping_banner']}'
					,clipping_banner_desc = '{$this->values['clipping_banner_desc']}'
					,clipping_exibir_destaque_home = '{$this->values['clipping_exibir_destaque_home']}'
					,clipping_destaque_home = '{$this->values['clipping_destaque_home']}'
					,clipping_destaque_home_desc = '{$this->values['clipping_destaque_home_desc']}'
					,clipping_destaque_home_frase = '{$this->values['clipping_destaque_home_frase']}'
					,clipping_exibir_listagem = '{$this->values['clipping_exibir_listagem']}'
					
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$clipping_id = $result['last_id'];
		$result = $this->insertTags($this->values['tags'], $clipping_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->insertDownload($this->values['downloads'], $clipping_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->insertGaleria($this->values['galeria_id'], $clipping_id);
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
			DELETE FROM tb_clipping_tag
			WHERE	clipping_id = '{$this->values['clipping_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertTags($tags,$clipping_id){
		if(count($tags) > 0){
			foreach($tags AS $tag){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_clipping_tag SET
						clipping_id = '{$clipping_id}'
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
			DELETE FROM tb_clipping
			WHERE clipping_id = '{$this->values['clipping_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}

	public function getClippingGaleriaItem($id){
		$sql = array();

		$arr = array();
		$aGal = array();
		$arr['galeria']= $this->getClippingGaleria($id);
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
	
	public function getClippingGaleria($id){
		$sql = array();
		$sql[] = "
			SELECT	g.*,
					tg.*
			FROM	tb_galeria g
			JOIN	tb_clipping_galeria tg
			ON		tg.galeria_id = g.galeria_id
			WHERE	1 = 1
			AND		tg.clipping_id = {$id}
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
	
	public function getTagsCadatradas($clipping_id){
		$sql = array();
		$sql[] = "
			SELECT	tag_id
			FROM	tb_clipping_tag
			WHERE	1 = 1
			AND		clipping_id = '{$clipping_id}'
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
			UPDATE tb_clipping SET
				{$this->values['img']} = ''
			WHERE	clipping_id = '{$this->values['clipping_id']}'
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
			DELETE FROM tb_clipping_galeria
			WHERE	clipping_id = '{$this->values['clipping_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	
	protected function deleteDownload(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_clipping_download
			WHERE	clipping_id = '{$this->values['clipping_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}

	protected function insertGaleria($galeria_id,$clipping_id){
		
		//if($galeria_id!=0){
			$sql = array();
			$sql[] = "
				INSERT INTO tb_clipping_galeria SET
					clipping_id = {$clipping_id}
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
	
	protected function insertDownload($downloads,$clipping_id){
		if(count($downloads) > 0){
			foreach($downloads AS $download){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_clipping_download SET
						clipping_id = '{$clipping_id}'
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

	public function getDownloadByClipping($clipping_id, $sOrder='', $direction=''){
		$sql = array();
		
		if(trim($direction=='')){
			$direction = 'DESC';
		}
		
		if(trim($sOrder=='')){
			$sOrder = 't.download_dt';
		}
		
		$sql[] = "
			SELECT	pd.clipping_id, t.*, tc.download_categoria_titulo
			FROM	tb_clipping_download pd
			JOIN	tb_download t
			ON		pd.download_id = t.download_id
			JOIN	tb_download_categoria tc
			ON		t.download_categoria_id = tc.download_categoria_id			
			WHERE	1 = 1
			AND		clipping_id = {$clipping_id}
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
	
	public function getDownloadCadastrados($clipping_id){
		$sql = array();
		$sql[] = "
			SELECT	download_id
			FROM	tb_clipping_download
			WHERE	1 = 1
			AND		clipping_id = '{$clipping_id}'
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
	
	public function getTagsByClipping($clipping_id){
		$sql = array();
		$sql[] = "
			SELECT	tp.tag_id, t.tag_titulo
			FROM	tb_clipping_tag tp
			JOIN	tb_tag t
			ON		tp.tag_id = t.tag_id
			WHERE	1 = 1
			AND		clipping_id = '{$clipping_id}'
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

