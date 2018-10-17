<?php
namespace app\index\controller;
use think\Db;

class Index extends \think\Controller
{
	
	//使用原生oci 的方式连接Oracle 
    public function index()
    {
       
	   //$DB = new Db;
	   //$data = $DB::query(" select * from lp_bi_shop ");
	   $sql = " select * from lp_bi_shop ";
	   
	   $dbstr ="(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.5.70)(PORT = 1521)) ) (CONNECT_DATA = (SID = wg85) ) )";
        
       $conn = oci_connect('bhbi','bhbi',$dbstr,'utf8');
	   
	   $statement = oci_parse( $conn, $sql );
        oci_execute($statement);
        
        $res = [];
        while ($row = oci_fetch_array($statement, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $res[] = $row;
        }
        
        oci_free_statement($statement);
        oci_close($conn);
	   dump($res);
	   return 1;   
   }
   
    public function indexTwo()
    {
       
	    $DB = new Db;
	    $data = $DB::query(" select * from lp_bi_shop ");
		dump($data);
	   return 1;   
   }
}
