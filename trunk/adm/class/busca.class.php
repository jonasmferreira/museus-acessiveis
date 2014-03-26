<?php
$path_root_buscaClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_buscaClass = "{$path_root_buscaClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_buscaClass}adm{$DS}class{$DS}default.class.php";
class busca extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	public function __construct() {
		$path_root_buscaClass= dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_buscaClass= "{$path_root_buscaClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_buscaClass}images{$DS}";
		if(!is_dir($this->pathImg)){
			@mkdir($this->pathImg, 0777,true);
		}
		@chmod($this->pathImg, 0777);
		$this->dbConn = new DataBaseClass();
	}
	
	protected function getSql(){
		$sql = array();

			//novidade 360
			$sql[] = "
				SELECT	
						t.novidade_360_id as item_id
						,'novidade360' as item_tipo_link
						,t.novidade_360_titulo as item_titulo
						,t.novidade_360_resumo as item_resumo
						,t.novidade_360_conteudo as item_conteudo
						,t.novidade_360_thumb as item_thumb
						,t.novidade_360_thumb_desc as item_thumb_desc
						,t.novidade_360_dt as item_dt
						,t.novidade_360_dt_agenda as item_dt_agenda
				FROM	tb_novidade_360 t
				WHERE	1 = 1 
				/*AND		DATE_FORMAT(CONCAT(t.novidade_360_dt,' ',t.novidade_360_hr),'%Y-%m-%d %H:%i:%s') <= NOW()*/
				";

			//Projetos
			$sql[] = "
				SELECT	
						t.projeto_id as item_id
						,'projeto' as item_tipo_link						
						,t.projeto_titulo as item_titulo
						,t.projeto_resumo as item_resumo
						,t.projeto_conteudo as item_conteudo
						,t.projeto_thumb as item_thumb
						,t.projeto_thumb_desc as item_thumb_desc
						,t.projeto_dt_ini as item_dt
						,t.projeto_agenda as item_dt_agenda
				FROM	tb_projeto t
				WHERE	1 = 1 
				/*AND		DATE_FORMAT(t.projeto_dt_ini),'%Y-%m-%d %H:%i:%s') <= NOW()*/
				";
			
			//cursos
			$sql[] = "
				SELECT	
						t.curso_id as item_id
						,'curso' as item_tipo_link
						,t.curso_titulo as item_titulo
						,t.curso_resumo as item_resumo
						,t.curso_conteudo as item_conteudo
						,t.curso_thumb as item_thumb
						,t.curso_thumb_desc as item_thumb_desc
						,t.curso_dt_ini as item_dt
						,t.curso_agenda as item_dt_agenda
				FROM	tb_curso t
				WHERE	1 = 1 
				/*AND		DATE_FORMAT(t.curso_dt_ini,'%Y-%m-%d %H:%i:%s') <= NOW()*/
				";

			//servicos
			$sql[] = "
				SELECT	
						t.servico_id as item_id
						,'servico' as item_tipo_link
						,t.servico_titulo as item_titulo
						,t.servico_resumo as item_resumo
						,t.servico_conteudo as item_conteudo
						,t.servico_thumb as item_thumb
						,t.servico_thumb_desc as item_thumb_desc
						,t.servico_dt_ini as item_dt
						,t.servico_agenda as item_dt_agenda
				FROM	tb_servico t
				WHERE	1 = 1 
				/*AND		DATE_FORMAT(t.servico_dt_ini,'%Y-%m-%d %H:%i:%s') <= NOW()*/
				";
			
		$aSql = Array();
		$aSql[] = "SELECT * FROM (";
		$aSql[] = implode(" UNION \n",$sql);
		$aSql[] = ") AS item_busca ";
		$aSql[] = "WHERE 1 = 1 ";
		return implode("\n",$aSql);
	}
	
	public function getLista(){
		$page = $this->values['page']; 
		// get the requested page 
		$limit = $this->values['rows']; 
		
		$sql = array();
		$sql[] = $this->getSql();
		if(isset($this->values['busca_texto'])&&trim($this->values['busca_texto'])!=''){
			$sql[] = "AND (item_titulo LIKE '%{$this->values['busca_texto']}%'";
			$sql[] = "OR item_resumo LIKE '%{$this->values['busca_texto']}%'";
			$sql[] = "OR item_conteudo LIKE '%{$this->values['busca_texto']}%' )";
		}

		$page = ($page < 1)?1:$page;
		$count = $this->getTotalData(implode("\n",$sql));
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
		$sql[] = "ORDER BY item_dt DESC ";
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

	
}