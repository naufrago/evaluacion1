<?php 

class Conect_Postgres {
     var $obj = array ( "dbname"	=>	"eva_oa",
                       "dbuser"		=>	"postgres"		,
                       "dbpwd"		=>	"root"		,
                       "dbhost"		=>	"localhost"	);


     var $q_id	="";
     var $ExeBit	="";
     var $db_connect_id = "";
     var $query_count   = 0;
    private function connect(){
		$this->db_connect_id = pg_connect('host=localhost dbname=eva_oa user=postgres password=root');
             if (!$this->db_connect_id)
              {
                echo (" Error no se puede conectar al servidor:".pg_last_error());
    	  }
  }

function execute($query) {       
        $this->q_id = pg_query($query);
        if(!$this->q_id ) {
            $error1 = pg_last_error($this->db_connect_id);
            die ("ERROR: error DB.<br> No Se Puede Ejecutar La Consulta:<br> $query <br>MySql Tipo De Error: $error1");
            exit;
        }         
	$this->query_count++; 
	return $this->q_id;    
    }


  public function fetch_row($q_id = "") {
    	if ($q_id == "") {
    		$q_id = $this->q_id;
   	 	}
        $result = pg_fetch_array($q_id);
        return $result;
    }	

 public function get_num_rows() {
        return pg_num_rows($this->q_id);
    }

public function get_row_affected(){
    return pg_affected_rows($this->db_connect_id);
}

public	function get_insert_id() {
    return pg_last_oid($this->db_connect_id);
}

public  function free_result($q_id) {
   		if($q_id == ""){
    		$q_id = $this->q_id;
		}
	pg_free_result($q_id);
    }	

public function close_db(){
        return pg_close($this->db_connect_id);
    }



  public function __construct(){
        $this->connect();
    }
  
}
?>