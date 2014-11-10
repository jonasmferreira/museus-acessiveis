<?php
$path_root_emailmktClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_emailmktClass = "{$path_root_emailmktClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_emailmktClass}adm{$DS}class{$DS}default.class.php";
require_once "{$path_root_emailmktClass}lib{$DS}EmailClass.php";
class emailmkt extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		'a.emailmkt_titulo'=>array(
			'fieldNameId'=>'a.emailmkt_titulo'
			,'fieldNameLabel'=>'Titulo'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	protected $status = array(
		'P'=>array(
			'id'=>'P'
			,'titulo'=>'Pendente'
		)
		,'X'=>array(
			'id'=>'X'
			,'titulo'=>'Enviando'
		)
		,'E'=>array(
			'id'=>'E'
			,'titulo'=>'Enviado'
		)
		,'C'=>array(
			'id'=>'L'
			,'titulo'=>'Liberado para disparo'
		)
		,'L'=>array(
			'id'=>'C'
			,'titulo'=>'Cancelado'
		)
	);
	public function __construct() {
		$path_root_emailmktClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_emailmktClass = "{$path_root_emailmktClass}{$DS}..{$DS}..{$DS}";
		
		$this->pathImg = "{$path_root_emailmktClass}imgEmkt{$DS}";
		if(!is_dir($this->pathImg)){
			@mkdir($this->pathImg,0777,true);
		}
		@chmod($this->pathImg,0777);
		$this->dbConn = new DataBaseClass();
	}
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}	
	
	public function getStatus() {
		return $this->status;
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	a.*
			FROM	tb_emailmkt a
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
		if(isset($this->values['emailmkt_status'])&&trim($this->values['emailmkt_status'])!=''){
			$sql[] = "AND a.emailmkt_status IN ('{$this->values['emailmkt_status']}')";
		}
		if(isset($this->values['data_ini'])&&trim($this->values['data_ini'])!=''){
			$this->values['data_ini'] = $this->dateBR2DB($this->values['data_ini']);
			$sql[] = "AND a.emailmkt_dt_agendada >= '{$this->values['data_ini']}'";
		}
		if(isset($this->values['data_fim'])&&trim($this->values['data_fim'])!=''){
			$this->values['data_fim'] = $this->dateBR2DB($this->values['data_fim']);
			$sql[] = "AND a.emailmkt_dt_agendada <= '{$this->values['data_fim']}'";
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
		$sql[] = "ORDER BY a.emailmkt_titulo ASC";
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
					//$rs['emailmkt_status_label'] = $rs['emailmkt_status']=='A'?'Ativo':'Inativo';
					$rs['emailmkt_status_label'] = $this->status[$rs['emailmkt_status']]['titulo'];
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
		$sql[] = "AND		a.emailmkt_id = '{$this->values['emailmkt_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['emailmkt_status_label'] = $this->status[$rs['emailmkt_status']]['titulo'];
			}
		}
		return $this->utf8_array_encode($rs);
	}
	
	public function getServico(){
		$path_root_servicoLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoLista = "{$path_root_servicoLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_servicoLista}adm{$DS}class{$DS}servico.class.php");
		$obj = new servico();
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}
	
	public function getProjeto(){
		$path_root_servicoLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoLista = "{$path_root_servicoLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_servicoLista}adm{$DS}class{$DS}projeto.class.php");
		$obj = new projeto();
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}

	public function getNovidade360(){
		$path_root_servicoLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoLista = "{$path_root_servicoLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_servicoLista}adm{$DS}class{$DS}novidade.class.php");
		$obj = new novidade();
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}
	
	public function getGlossario(){
		$path_root_servicoLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoLista = "{$path_root_servicoLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_servicoLista}adm{$DS}class{$DS}glossario.class.php");
		$obj = new glossario();
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}
	
	public function getContatos(){
		$path_root_servicoLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoLista = "{$path_root_servicoLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_servicoLista}adm{$DS}class{$DS}contato.class.php");
		$obj = new contato();
		
		if(isset($this->values['contato_exibir'])&&trim($this->values['contato_exibir'])!=''){
			$obj->setValues(array(
				'contato_exibir'=>$this->values['contato_exibir']
			));
		}
	
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}
	
	public function getMailing(){
		$path_root_servicoLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoLista = "{$path_root_servicoLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_servicoLista}adm{$DS}class{$DS}mailing.class.php");
		$obj = new mailing();
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}

	public function getProjetosByIds($list_id){
		$sql = array();
		$sql[] = "
			SELECT	*
			FROM	tb_projeto t
			WHERE	1 = 1
			AND		projeto_id IN ({$list_id})
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
	
	public function getGlossariosByIds($list_id){
		$sql = array();
		$sql[] = "
			SELECT	*
			FROM	tb_glossario t
			WHERE	1 = 1
			AND		glossario_id IN ({$list_id})
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
	
	public function getNovidadesByIds($list_id){
		$sql = array();
		$sql[] = "
			SELECT	*
			FROM	tb_novidade_360 t
			WHERE	1 = 1
			AND		novidade_360_id IN ({$list_id})
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
	
	public function getEmktNoticia(){
		$path_root_emktNoticiaLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_emktNoticiaLista = "{$path_root_emktNoticiaLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_emktNoticiaLista}adm{$DS}class{$DS}emktNoticia.class.php");
		$obj = new emktNoticia();
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}

	public function getEmktNoticiaByIds($list_id){
		$sql = array();
		$sql[] = "
			SELECT	*
			FROM	tb_emkt_noticia t
			WHERE	1 = 1
			AND		emkt_noticia_id IN ({$list_id})
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
	
	
	public function edit(){
		if(isset($this->values['emailmkt_id'])&&trim($this->values['emailmkt_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){

		//Verificando se devemos ou não salvar os blocos de dados do Newsletter
		
		$this->values['emailmkt_noticia_ids'] = @implode(",",$this->values['emailmkt_noticia_ids']);
		if($this->values['emailmkt_exibe_noticia']!='S'){
			$this->values['emailmkt_noticia_ids']='';
		}
		
		$this->values['emailmkt_glossario_ids'] = @implode(",",$this->values['emailmkt_glossario_ids']);
		if($this->values['emailmkt_exibe_glossario']!='S'){
			$this->values['emailmkt_glossario_ids'] = '';
		}
		
		$this->values['emailmkt_novidade360_ids'] = @implode(",",$this->values['emailmkt_novidade360_ids']);
		if($this->values['emailmkt_exibe_novidade360']!='S'){
			$this->values['emailmkt_novidade360_ids'] = '';
			$this->values['emailmkt_novidade360_id'] = '';
		}

		$this->values['emailmkt_agenda_ids'] = @implode(",",$this->values['emailmkt_agenda_ids']);
		if($this->values['emailmkt_exibe_agenda']!='S'){
			$this->values['emailmkt_agenda_ids'] = '';
		}

		if($this->values['emailmkt_exibe_arquivo']!='S'){
			$this->values['emailmkt_arq_fisico'] = '';
		}

		$this->values['emailmkt_aqui_tem_thumb'] = $this->uploadFile($this->pathImg, $this->files['emailmkt_aqui_tem_thumb']);
		if($this->values['emailmkt_exibe_aquitem']!='S'){
			$this->values['emailmkt_aqui_tem_titulo'] = '';
			$this->values['emailmkt_aqui_tem_resumo'] = '';
			$this->values['emailmkt_aqui_tem_url'] = '';
			$this->values['emailmkt_aqui_tem_thumb']='';
		}

		$this->values['emailmkt_contato_img'] = $this->uploadFile($this->pathImg, $this->files['emailmkt_contato_img']);
		if($this->values['emailmkt_contato_img']==''){
			$this->values['emailmkt_contato_img']='emkt_contact_bt.png';
		}
		
		$this->values['emailmkt_propaganda_img'] = $this->uploadFile($this->pathImg, $this->files['emailmkt_propaganda_img']);
		if($this->values['emailmkt_exibe_propaganda']!='S'){
			$this->values['emailmkt_propaganda_img']='';
			$this->values['emailmkt_propaganda_url']='';
		}

		$this->values['emailmkt_dt_agendada'] = $this->dateBR2DB($this->values['emailmkt_dt_agendada']);
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_emailmkt SET
					emailmkt_titulo = '{$this->values['emailmkt_titulo']}'
					,emailmkt_dt_agendada = '{$this->values['emailmkt_dt_agendada']}'
					,emailmkt_hr_agendada = '{$this->values['emailmkt_hr_agendada']}'
					,emailmkt_status = '{$this->values['emailmkt_status']}'
					,emailmkt_exibe_noticia = '{$this->values['emailmkt_exibe_noticia']}'
					,emailmkt_noticia_ids = '{$this->values['emailmkt_noticia_ids']}'
					,emailmkt_exibe_glossario = '{$this->values['emailmkt_exibe_glossario']}'
					,emailmkt_glossario_ids = '{$this->values['emailmkt_glossario_ids']}'
					,emailmkt_exibe_novidade360 = '{$this->values['emailmkt_exibe_novidade360']}'
					,emailmkt_novidade360_id = '{$this->values['emailmkt_novidade360_id']}'
					,emailmkt_novidade360_ids = '{$this->values['emailmkt_novidade360_ids']}'
					,emailmkt_exibe_agenda = '{$this->values['emailmkt_exibe_agenda']}'
					,emailmkt_agenda_ids = '{$this->values['emailmkt_agenda_ids']}'
					,emailmkt_exibe_arquivo = '{$this->values['emailmkt_exibe_arquivo']}'
					,emailmkt_arq_fisico = '{$this->values['emailmkt_arq_fisico']}'
					,emailmkt_exibe_aquitem = '{$this->values['emailmkt_exibe_aquitem']}'
					,emailmkt_aqui_tem_titulo = '{$this->values['emailmkt_aqui_tem_titulo']}'
					,emailmkt_aqui_tem_resumo = '{$this->values['emailmkt_aqui_tem_resumo']}'
					,emailmkt_aqui_tem_url = '{$this->values['emailmkt_aqui_tem_url']}'
					,emailmkt_contato_img = '{$this->values['emailmkt_contato_img']}'
					,emailmkt_contato_email = '{$this->values['emailmkt_contato_email']}'
					,emailmkt_propaganda_url = '{$this->values['emailmkt_propaganda_url']}'
					,emailmkt_exibe_propaganda = '{$this->values['emailmkt_exibe_propaganda']}'
		";

		if(trim($this->values['emailmkt_aqui_tem_thumb'])!=''){
			$sql[] = ",emailmkt_aqui_tem_thumb = '{$this->values['emailmkt_aqui_tem_thumb']}'";
		}
		if(trim($this->values['emailmkt_propaganda_img'])!=''){
			$sql[] = ",emailmkt_propaganda_img = '{$this->values['emailmkt_propaganda_img']}'	";
		}
					
		$sql[] = " WHERE	emailmkt_id = '{$this->values['emailmkt_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}

	private function insert(){

		//Verificando se devemos ou não salvar os blocos de dados do Newsletter
		
		$this->values['emailmkt_noticia_ids'] = @implode(",",$this->values['emailmkt_noticia_ids']);
		if($this->values['emailmkt_exibe_noticia']!='S'){
			$this->values['emailmkt_noticia_ids']='';
		}
		
		$this->values['emailmkt_glossario_ids'] = @implode(",",$this->values['emailmkt_glossario_ids']);
		if($this->values['emailmkt_exibe_glossario']!='S'){
			$this->values['emailmkt_glossario_ids'] = '';
		}
		
		$this->values['emailmkt_novidade360_ids'] = @implode(",",$this->values['emailmkt_novidade360_ids']);
		if($this->values['emailmkt_exibe_novidade360']!='S'){
			$this->values['emailmkt_novidade360_ids'] = '';
			$this->values['emailmkt_novidade360_id'] = '';
		}

		$this->values['emailmkt_agenda_ids'] = @implode(",",$this->values['emailmkt_agenda_ids']);
		if($this->values['emailmkt_exibe_agenda']!='S'){
			$this->values['emailmkt_agenda_ids'] = '';
		}

		if($this->values['emailmkt_exibe_arquivo']!='S'){
			$this->values['emailmkt_arq_fisico'] = '';
		}

		$this->values['emailmkt_aqui_tem_thumb'] = $this->uploadFile($this->pathImg, $this->files['emailmkt_aqui_tem_thumb']);
		if($this->values['emailmkt_exibe_aquitem']!='S'){
			$this->values['emailmkt_aqui_tem_titulo'] = '';
			$this->values['emailmkt_aqui_tem_resumo'] = '';
			$this->values['emailmkt_aqui_tem_url'] = '';
			$this->values['emailmkt_aqui_tem_thumb']='';
		}

		$this->values['emailmkt_contato_img'] = $this->uploadFile($this->pathImg, $this->files['emailmkt_contato_img']);
		if($this->values['emailmkt_contato_img']==''){
			$this->values['emailmkt_contato_img']='emkt_contact_bt.png';
		}
		
		$this->values['emailmkt_propaganda_img'] = $this->uploadFile($this->pathImg, $this->files['emailmkt_propaganda_img']);
		if($this->values['emailmkt_exibe_propaganda']!='S'){
			$this->values['emailmkt_propaganda_img']='';
			$this->values['emailmkt_propaganda_url']='';
		}

		$this->values['emailmkt_dt_agendada'] = $this->dateBR2DB($this->values['emailmkt_dt_agendada']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_emailmkt SET
				emailmkt_titulo = '{$this->values['emailmkt_titulo']}'
				,emailmkt_dt_agendada = '{$this->values['emailmkt_dt_agendada']}'
				,emailmkt_hr_agendada = '{$this->values['emailmkt_hr_agendada']}'
				,emailmkt_status = '{$this->values['emailmkt_status']}'
				,emailmkt_exibe_noticia = '{$this->values['emailmkt_exibe_noticia']}'
				,emailmkt_noticia_ids = '{$this->values['emailmkt_noticia_ids']}'
				,emailmkt_exibe_glossario = '{$this->values['emailmkt_exibe_glossario']}'
				,emailmkt_glossario_ids = '{$this->values['emailmkt_glossario_ids']}'
				,emailmkt_exibe_novidade360 = '{$this->values['emailmkt_exibe_novidade360']}'
				,emailmkt_novidade360_id = '{$this->values['emailmkt_novidade360_id']}'
				,emailmkt_novidade360_ids = '{$this->values['emailmkt_novidade360_ids']}'
				,emailmkt_exibe_agenda = '{$this->values['emailmkt_exibe_agenda']}'
				,emailmkt_agenda_ids = '{$this->values['emailmkt_agenda_ids']}'
				,emailmkt_exibe_arquivo = '{$this->values['emailmkt_exibe_arquivo']}'
				,emailmkt_arq_fisico = '{$this->values['emailmkt_arq_fisico']}'
				,emailmkt_exibe_aquitem = '{$this->values['emailmkt_exibe_aquitem']}'
				,emailmkt_aqui_tem_titulo = '{$this->values['emailmkt_aqui_tem_titulo']}'
				,emailmkt_aqui_tem_resumo = '{$this->values['emailmkt_aqui_tem_resumo']}'
				,emailmkt_aqui_tem_url = '{$this->values['emailmkt_aqui_tem_url']}'
				,emailmkt_contato_img = '{$this->values['emailmkt_contato_img']}'
				,emailmkt_contato_email = '{$this->values['emailmkt_contato_email']}'
				,emailmkt_propaganda_url = '{$this->values['emailmkt_propaganda_url']}'
				,emailmkt_exibe_propaganda = '{$this->values['emailmkt_exibe_propaganda']}'
				
		";

		if(trim($this->values['emailmkt_aqui_tem_thumb'])!=''){
			$sql[] = ",emailmkt_aqui_tem_thumb = '{$this->values['emailmkt_aqui_tem_thumb']}'";
		}
		if(trim($this->values['emailmkt_propaganda_img'])!=''){
			$sql[] = ",emailmkt_propaganda_img = '{$this->values['emailmkt_propaganda_img']}'	";
		}
				
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	protected function deleteParentItem(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_emailmkt_conferencia
			WHERE emailmkt_id = '{$this->values['emailmkt_id']}'
		";
		
		return $this->dbConn->db_execute(implode("\n",$sql));
	}
	public function deleteItem(){
		$this->dbConn->db_start_transaction();
		$result = $this->deleteParentItem();
		if(!$result['success']){
			$this->dbConn->db_rollback();
			return $result;
		}
		$sql = array();
		$sql[] = "
			DELETE FROM tb_emailmkt
			WHERE emailmkt_id = '{$this->values['emailmkt_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	public function getAgenda(){
		$path_root_agendaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_agendaClass = "{$path_root_agendaClass}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_agendaClass}adm{$DS}class{$DS}configuracao.class.php");
		$objConfig = new configuracao();
		$aConfig = $objConfig->getOne();

		//$objConfig->debug($aConfig);
		$linkAbsolute=$aConfig['configuracao_baseurl'];
		$sql = array();
		$dataPadrao = date("Y-m-01");
		//novidade 360
		$sql[] = "
			SELECT	
					t.novidade_360_id as item_id
					,'novidade360' as item_tipo_link
					,t.novidade_360_titulo as item_titulo
					,t.novidade_360_dt_agenda as item_dt_agenda
					,DAY(t.novidade_360_dt_agenda) as item_dt_agenda_dia
					,'N' AS item_tipo
					,'Novidade 360º' AS item_tipo_label
			FROM	tb_novidade_360 t
			WHERE	1 = 1 
			#AND		t.novidade_360_dt_agenda >= '{$dataPadrao}'
			AND		t.novidade_360_dt_agenda IS NOT NULL
			AND		t.novidade_360_dt_agenda !='0000-00-00'
		";
		//Projetos
		$sql[] = "
			SELECT	
					t.projeto_id as item_id
					,'projeto' as item_tipo_link
					,t.projeto_titulo as item_titulo
					,t.projeto_agenda as item_dt_agenda
					,DAY(t.projeto_agenda) as item_dt_agenda_dia
					,'P' AS item_tipo
					,'Projeto' AS item_tipo_label
			FROM	tb_projeto t
			WHERE	1 = 1 
			#AND		t.projeto_agenda >= '{$dataPadrao}'
			AND		t.projeto_agenda IS NOT NULL
			AND		t.projeto_agenda !='0000-00-00'
		";

		//cursos
		$sql[] = "
			SELECT	
					t.curso_id as item_id
					,'curso' as item_tipo_link
					,t.curso_titulo as item_titulo
					,t.curso_agenda as item_dt_agenda
					,DAY(t.curso_agenda) as item_dt_agenda_dia
					,'C' AS item_tipo
					,'Curso' AS item_tipo_label
			FROM	tb_curso t
			WHERE	1 = 1 
			#AND		t.curso_agenda >= '{$dataPadrao}'
			AND		t.curso_agenda IS NOT NULL
			AND		t.curso_agenda !='0000-00-00'
		";

		//servicos
		$sql[] = "
			SELECT	
					t.servico_id as item_id
					,'servico' as item_tipo_link
					,t.servico_titulo as item_titulo
					,t.servico_agenda as item_dt_agenda
					,DAY(t.servico_agenda) as item_dt_agenda_dia
					,'S' AS item_tipo
					,'Serviço' AS item_tipo_label
			FROM	tb_servico t
			WHERE	1 = 1 
			#AND		t.servico_agenda >= '{$dataPadrao}'
			AND		t.servico_agenda IS NOT NULL
			AND		t.servico_agenda !='0000-00-00'
		";
			
		$aSql = Array();
		$aSql[] = "SELECT * FROM (";
		$aSql[] = implode(" UNION \n",$sql);
		$aSql[] = ") AS item_busca ";
		$aSql[] = "
			WHERE 1 = 1 
			ORDER BY item_dt_agenda ASC, item_titulo ASC
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$aSql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$sLink = "{$linkAbsolute}{$rs['item_tipo_link']}/{$rs['item_id']}/{$rs['item_titulo']}";
					$rs['item_link'] = $sLink;
					$rs['item_dt_agenda_label'] = $this->dateDB2BR($rs['item_dt_agenda']);
					$rs = $this->utf8_array_encode($rs);
					array_push($arr,$rs);
				}
			}
		}
		return $arr;
	}
	
	public function getAgendaByIds($aN,$aP,$aC,$aS){
		$path_root_agendaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_agendaClass = "{$path_root_agendaClass}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_agendaClass}adm{$DS}class{$DS}configuracao.class.php");
		$objConfig = new configuracao();
		$aConfig = $objConfig->getOne();

		//$objConfig->debug($aConfig);
		$linkAbsolute=$aConfig['configuracao_baseurl'];
		$sql = array();
		$dataPadrao = date("Y-m-01");
		//novidade 360
		$sql[] = "
			SELECT	
					t.novidade_360_id as item_id
					,'novidade360' as item_tipo_link
					,t.novidade_360_titulo as item_titulo
					,t.novidade_360_dt_agenda as item_dt_agenda
					,DAY(t.novidade_360_dt_agenda) as item_dt_agenda_dia
					,MONTH(t.novidade_360_dt_agenda) as item_dt_agenda_mes
					,'N' AS item_tipo
					,'Novidade 360º' AS item_tipo_label
			FROM	tb_novidade_360 t
			WHERE	1 = 1 
			AND		t.novidade_360_id IN ({$aN})
		";
		//Projetos
		$sql[] = "
			SELECT	
					t.projeto_id as item_id
					,'projeto' as item_tipo_link
					,t.projeto_titulo as item_titulo
					,t.projeto_agenda as item_dt_agenda
					,DAY(t.projeto_agenda) as item_dt_agenda_dia
					,MONTH(t.projeto_agenda) as item_dt_agenda_mes
					,'P' AS item_tipo
					,'Projeto' AS item_tipo_label
			FROM	tb_projeto t
			WHERE	1 = 1 
			AND		t.projeto_id IN ({$aP})
		";

		//cursos
		$sql[] = "
			SELECT	
					t.curso_id as item_id
					,'curso' as item_tipo_link
					,t.curso_titulo as item_titulo
					,t.curso_agenda as item_dt_agenda
					,DAY(t.curso_agenda) as item_dt_agenda_dia
					,MONTH(t.curso_agenda) as item_dt_agenda_mes
					,'C' AS item_tipo
					,'Curso' AS item_tipo_label
			FROM	tb_curso t
			WHERE	1 = 1 
			AND		t.curso_id IN ({$aC})
		";

		//servicos
		$sql[] = "
			SELECT	
					t.servico_id as item_id
					,'servico' as item_tipo_link
					,t.servico_titulo as item_titulo
					,t.servico_agenda as item_dt_agenda
					,DAY(t.servico_agenda) as item_dt_agenda_dia
					,MONTH(t.servico_agenda) as item_dt_agenda_mes
					,'S' AS item_tipo
					,'Serviço' AS item_tipo_label
			FROM	tb_servico t
			WHERE	1 = 1 
			AND		t.servico_id IN ({$aS})
		";
			
		$aSql = Array();
		$aSql[] = "SELECT * FROM (";
		$aSql[] = implode(" UNION \n",$sql);
		$aSql[] = ") AS item_busca ";
		$aSql[] = "
			WHERE 1 = 1 
			ORDER BY item_dt_agenda ASC, item_titulo ASC
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$aSql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$sLink = "{$linkAbsolute}{$rs['item_tipo_link']}/{$rs['item_id']}/{$rs['item_titulo']}";
					$rs['item_link'] = $sLink;
					$rs['item_dt_agenda_label'] = $this->dateDB2BR($rs['item_dt_agenda']);
					$rs['item_dt_agenda_mes'] = str_pad($rs['item_dt_agenda_mes'], 2,"0",STR_PAD_LEFT);
					$rs['item_dt_agenda_mes_label'] = strtolower($this->meses[$rs['item_dt_agenda_mes']]);
					$rs = $this->utf8_array_encode($rs);
					array_push($arr,$rs);
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
			UPDATE tb_emailmkt SET
				{$this->values['img']} = ''
			WHERE	emailmkt_id = '{$this->values['emailmkt_id']}'
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
	public function disparoEmailTeste(){
		$emailmkt_id = $this->values['emailmkt_id'];
		$email = $this->values['email'];
		$nome = $this->values['nome'];
		$aEmails = array(
			array(
				'email'=>$email
				,'nome'=>$nome
			)
		);
		return $this->disparoEmail($aEmails,$emailmkt_id);
	}
	protected function disparoEmail($aEmails,$emailmkt_id){
		$path_root_emailmktClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_emailmktClass = "{$path_root_emailmktClass}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_emailmktClass}adm{$DS}class{$DS}configuracao.class.php");
		
		
		$objConfig = new configuracao();
		$aConfig = $objConfig->getOne();
		$linkAbsolute=$aConfig['configuracao_baseurl'];
		$this->values['emailmkt_id'] = $emailmkt_id;
		$aNewsletter = $this->getOne();
		$objEmail = new emailClass();
		$objEmail->setAssunto("Museus Acessíveis - {$aNewsletter['emailmkt_titulo']}");
		$objEmail->conteudo = file_get_contents("{$linkAbsolute}newsletterItem.php?emailmkt_id={$emailmkt_id}");
		return $objEmail->enviaEmail($aEmails);
	}
	protected function updateStatus($emailmkt_id,$emailmkt_status){
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE tb_emailmkt SET
				emailmkt_status = '{$emailmkt_status}'
			WHERE	emailmkt_id = '{$emailmkt_id}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	protected function updateDtDisparo($emailmkt_id){
		$this->dbConn->db_start_transaction();
		$sql = array();
		
		$sql[] = "
			UPDATE tb_emailmkt SET
				emailmkt_dt_disparo = CURDATE()
				,emailmkt_hr_disparo = CURTIME()
			WHERE	emailmkt_id = '{$emailmkt_id}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	protected function insertEmailConferencia($aArr){
		$sql = array();
		$sql[] = "
			INSERT INTO tb_emailmkt_conferencia SET
				emailmkt_id = '{$aArr['emailmkt_id']}'
				,mailing_id = '{$aArr['mailing_id']}'
				,mailing_email = '{$aArr['mailing_email']}'
				,emailmkt_conferencia_dt_disparo = '{$aArr['emailmkt_conferencia_dt_disparo']}'
				,emailmkt_conferencia_hr_disparo = '{$aArr['emailmkt_conferencia_hr_disparo']}'
		";
		return $this->dbConn->db_execute(implode("\n",$sql));
	}
	protected function updateEmailConferencia($aArr){
		$sql = array();
		$sql[] = "
			UPDATE tb_emailmkt_conferencia SET
				emailmkt_id = '{$aArr['emailmkt_id']}'
				,mailing_id = '{$aArr['mailing_id']}'
				,mailing_email = '{$aArr['mailing_email']}'
				,emailmkt_conferencia_dt_disparo = '{$aArr['emailmkt_conferencia_dt_disparo']}'
				,emailmkt_conferencia_hr_disparo = '{$aArr['emailmkt_conferencia_hr_disparo']}'
			WHERE emailmkt_conferencia_id = '{$aArr['emailmkt_conferencia_id']}'
		";
		return $this->dbConn->db_execute(implode("\n",$sql));
	}
	protected function verifyEmailConferencia($aArr){
		$sql = array();
		$sql[] = "
			SELECT	*
			FROM	tb_emailmkt_conferencia
			WHERE	mailing_email = '{$aArr['mailing_email']}'
		";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs = $this->utf8_array_encode($rs);
				return $rs['emailmkt_conferencia_id'];
			}
		}
		return "";
	}
	public function disparo(){
		$this->values['emailmkt_status'] = "L";
		$aEmailMkt = $this->getLista();
		$aEmailMkt = $aEmailMkt['rows'];
		if(count($aEmailMkt) > 0){
			$aMailing = $this->getMailing();
			foreach($aEmailMkt AS $v){
				$this->updateStatus($v['emailmkt_id'],"X");
				foreach($aMailing AS $mail){
					$emailmkt_id = $v['emailmkt_id'];
					$email = $mail['mailing_email'];
					$nome = $mail['mailing_nome'];
					$aEmails = array(
						array(
							'email'=>$email
							,'nome'=>$nome
						)
					);
					$this->disparoEmail($aEmails,$emailmkt_id);
					$aArr = array();
					$aArr['emailmkt_id'] = $emailmkt_id;
					$aArr['mailing_id'] = $mail['mailing_id'];
					$aArr['mailing_email'] = $email;
					$aArr['emailmkt_conferencia_dt_disparo'] = date("Y-m-d");
					$aArr['emailmkt_conferencia_hr_disparo'] = date("H:i:s");
					$aArr['emailmkt_conferencia_id'] = $this->verifyEmailConferencia($aArr);
					if(trim($aArr['emailmkt_conferencia_id'])!=""){
						$this->updateEmailConferencia($aArr);
					}else{
						$this->insertEmailConferencia($aArr);
					}
				}
				$this->updateDtDisparo($v['emailmkt_id']);
				$this->updateStatus($v['emailmkt_id'],"E");
			}
		}
	}
	
	public function sendTofriend(){
		$path_root_emailmktClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_emailmktClass = "{$path_root_emailmktClass}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_emailmktClass}adm{$DS}class{$DS}configuracao.class.php");
		$objConfig = new configuracao();
		$aConfig = $objConfig->getOne();
		$linkAbsolute=$aConfig['configuracao_baseurl'];
		$objEmail = new emailClass();
		$objEmail->setAssunto("Museus Acessíveis - Seu Amigo {$this->values['nome']} enviou essa notícia");
		$objEmail->conteudo = file_get_contents("{$linkAbsolute}sendToAFriend.php?ids={$this->values['ids']}");
		//
		$objEmail->conteudo = str_replace("@@NOME_AMIGO@@",$this->values['nome'],$objEmail->conteudo);
		
		$aEmails = array(
			array(
				'nome'=>$this->values['nome_amigo']
				,'email'=>$this->values['email_amigo']
			)
		);
		return $objEmail->enviaEmail($aEmails);
	}
}