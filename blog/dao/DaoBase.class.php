<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-03-21 17:19:33
 */

class DaoBase {
    protected $table_name; 
    private $mysqli;
    public function __construct()
    {
        if(empty($this->table_name)){
            die('table_name is null');
        }
        $this->getDbConnect();
    }

    public function __destruct(){
        $this->mysqli->close();
    }

    public function getDbConnect(){
        $this->mysqli = new mysqli('localhost','root','','blog');
        $this->mysqli->set_charset("utf8");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }

    protected function select($filed,$where = false,$endWith = false){

        if(empty($filed)){
            return false;
        }
        $filed = self::createFiled($filed);
        $where = self::createWhere($where);

        $sql .= "select " . $filed . " from ". $this->table_name ." ". $where ." ".$endWith;
        $result = $this->mysqli->query($sql);
        $result = self::fomatSqlResult($result);

        return $result;
    }

    protected function getCount($where){
   
        $where = self::createWhere($where);

        $sql .= "select count(*) as total from ". $this->table_name ." ". $where;
        
        $result = $this->mysqli->query($sql);
        $result = self::fomatSqlResult($result);

        return $result[0]['total'];
    }
    public function insert($data){
        $filed = "(";
        $values = "(";

        foreach ($data as $k => $v) {
            $filed .= "`$k`,";
            $values .= "'$v',";
        }
        $filed = trim($filed,',') . ")";
        $values = trim($values,',') . ")";
        
        $insert = "insert into " . $this->table_name  . $filed  . "values" . $values;
        
        //返回boolean
        $result = $this->mysqli->query($insert);
        return $result;
    }

    public function update($data,$where = false){
        $filed = "";
        foreach ($data as $k => $v) {
            $filed .= " $k = '$v',";
        }
        $filed = trim($filed,',') ;
        
        $where = self::createWhere($where);

        $update = "update " . $this->table_name . " set " . $filed . " " . $where;
        
        //返回boolean
        $result = $this->mysqli->query($update);
        return $result;
    }

    public function delete($where){
        $data = array('is_deleted' => 1);
        return $this->update($data,$where);
    }
    private static function fomatSqlResult($result){
        $ret = array();

        while($row = $result->fetch_assoc() ){ 
            $ret[]  = $row; 
        }
        return $ret;
    }
    private static function createFiled($filed){
        $sql = "";
        foreach ($filed as $key => $value) {
            $sql .= "`$value`,";
        }
        
        return trim($sql,',');;
    }
    private static function createWhere($where){
        if(empty($where)){
            return false;
        }
        $sql = " where ";
        foreach ($where as $key => $value) {
            $sql .= $key  . "'$value'" ." and ";
        }
        return trim($sql,' and');;
    }

}