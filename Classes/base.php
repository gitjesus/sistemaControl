<?php
include $_SERVER['DOCUMENT_ROOT']."/sistemaControl/config/config.php";
	 class base
	{
		private $db;
		private $host;
		private $port;
		private $user;
		private $pass;
		private $schema;		
		
		public function __construct()
		{
			$this->db=constant('db');
			$this->host=constant('host');
			$this->port=constant('port');
			$this->user=constant('user');
			$this->pass=constant('pass');
			$this->schema=constant('schema');
		}
		
		private function conectar()
		{
			switch($this->db)
			{
				case 'mysql':
						$conexion=mysql_connect("$this->host","$this->user","$this->pass") or die("No se pudo conectar a la base de datos");
						mysql_select_db("$this->schema",$conexion);
					break;
				case 'mssql':
					break;	
				
			}
		}
		
		public function consultar($sentencia)
		{
			$arr=array();
			$this->conectar();
			
			$resultado=mysql_query($sentencia);
			while($fila=mysql_fetch_object($resultado))
			{
				$arr[]=$fila;
			}
			return $arr;
		}
		
		public function ejecutar($sentencia)
		{
			$this->conectar();
			mysql_query($sentencia);
			$num=mysql_affected_rows($conexion);
			if($num>0)
			{
				return true;
			}
			else {
				return false;
			}
			
			
		}
	}
?>