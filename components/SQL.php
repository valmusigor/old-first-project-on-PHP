<?php

class SQL{
	private static $instance;
	private $db;
	public static function Instance()
	{
		if(self::$instance==null)
		{
			self::$instance=new SQL();
		}
		return self::$instance;
	}
	public function __construct(){
	setlocale(LC_ALL,'ru_RU.UTF8');//установка локали (страны, языка, даты, времени, языка вывода )
        $dsn= include(ROOT.'/config/SQL_P.php');
	$this->db=new PDO('mysql:host='.$dsn['host'].';dbname='.$dsn['dbname'],$dsn['user'],$dsn['password']);
	$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
	}
	public function select($query,$mask=null){
		$q=$this->db->prepare($query);
            if($mask===null){
              $q->execute();  
                }
		else $q->execute($mask);
		if($q->errorCode()!=PDO::ERR_NONE)
		{
			$info=$q->errorInfo();
			die($info[2]);
		}
		return $q->fetchAll();
	}
    public function insert($table, $array)
	{
		$columns=array();
		foreach($array as $key=> $value)
		{
			$columns[]=$key;
			$masks[]=":$key";
			if($value==null)
			{
				$array[$key]='NULL';
			}
		}
		$column_s=implode(',',$columns);
		$masks_s=implode(',',$masks);
		$query="INSERT INTO $table ($column_s) VALUES ($masks_s)";
		$q = $this->db->prepare($query);
		$q->execute($array);
		if($q->errorCode()!=PDO::ERR_NONE)
		{$info=$q->errorInfo();
	    echo $info[2];
		}
		return $this->db->lastInsertId();//последний вставленный элемент
	}
	public function Update($table,$object,$where)
	{
		$sets=array();
		foreach($object as $key=> $value)
		{
			$sets[]="$key=:$key";
			if($value==null)
			{
				$object[$key]='NULL';
			}
		}
		$sets_s=implode(',',$sets);
		$query="UPDATE $table SET $sets_s WHERE $where";
		$q=$this->db->prepare($query);
		$q->execute($object);
		
                if($q->errorCode()!=PDO::ERR_NONE)
		{echo "<pre>";
                   print_r($object);
                   echo $where;
                   echo "</pre>";
                   $info=$q->errorInfo();
	           echo($info[2]);
		}
                
		return $q->rowCount();//Возвращает количество строк, затронутых последним SQL-запросом
	}
	public function delete($table,$where){
		$query="DELETE FROM $table WHERE id=:id";
		$q=$this->db->prepare($query);
		$q->execute($where);
		
                if($q->errorCode()!=PDO::ERR_NONE)
		{
			$info=$q->errorInfo();
			die($info[2]);
		}
		return $q->rowCount();//Возвращает количество строк, затронутых последним SQL-запросом
	}
	
}