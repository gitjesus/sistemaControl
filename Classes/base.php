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
		private $conexion;		
		
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
						$this->conexion=mysql_connect("$this->host","$this->user","$this->pass") or die("No se pudo conectar a la base de datos");
						mysql_select_db("$this->schema",$this->conexion);
					break;
				case 'mssql':
						$this->conexion=mssql_connect("$this->host","$this->user","$this->pass");
					
						mssql_select_db("$this->schema",$this->conexion);
					break;	
				
			}
		}
		
		public function consultar($sentencia)
		{
			$arr=array();
			$this->conectar();
			
			switch($this->db)
			{
			case 'mysql':
				$resultado=mysql_query($sentencia);
				while($fila=mysql_fetch_object($resultado))
				{
					$arr[]=$fila;
				}
				
			break;	
			case 'mssql':
					$resultado=mssql_query($sentencia);
				while($fila=mssql_fetch_object($resultado))
				{
					$arr[]=$fila;
				}
				
			break;
			}
			return $arr;
		}
		
		public function ejecutar($sentencia)
		{
			switch($this->db)
			{
				case 'mysql':
					$this->conectar();
			mysql_query($sentencia);
			$num=mysql_affected_rows($this->conexion);
			if($num>0)
			{
				return true;
			}
			else {
				return false;
			}
					break;
				case 'mssql':
					$this->conectar();
			mssql_query($sentencia);
			$num=mssql_rows_affected($this->conexion);
			if($num>0)
			{
				return true;
			}
			else {
				return false;
			}
					break;	
			}
			
			
			
		}
		
		public function ahora()
		{
			switch($this->db)
			{
				case 'mysql':
						return "now()";
					break;
				case 'mssql':
						return "getdate()";
					break;	
			}
		}
		
		public function diferenciaFechas($ahora,$anterior)
		{
			switch($this->db)
			{
				case 'mysql':
						return "$ahora-$anterior";
					break;
				case 'mssql':
						return "datediff(dd,$ahora,$anterior)";
					break;	
			}
		}
	}
?>