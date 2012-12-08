<?php
namespace Database;

class PgSQLi extends \aDatabase implements \iDatabase{
	private $stmts								= array();
	public function Connect(){
		$dsn							 = empty($this->conf['host'])	? '' : "host={$this->conf['host']} ";
		$dsn							.= empty($this->conf['port'])	? '' : "port={$this->conf['port']} ";
		$dsn							.= empty($this->conf['dbname'])	? '' : "dbname={$this->conf['dbname']} ";
		$dsn							.= empty($this->conf['user'])	? '' : "user={$this->conf['user']} ";
		$dsn							.= empty($this->conf['pass'])	? '' : "password={$this->conf['pass']} ";
		$this->connection				 = pg_connect($dsn);
		$this->ClientEncoding('UTF8');
		return $this->connection;
	}

	public function __destruct()				{	/*$this->Close();*/													}
	public function ClientEncoding($enc)	{
		return (
			is_null($enc)
			? pg_client_encoding($this->connection)
			: pg_set_client_encoding($this->connection, $enc)
		);
	}
	public function Call(){
		$rs								 = call_user_func_array( array($this, "Execute"), func_get_args() );
		$val						 	 = $rs->FetchResult();
		if($val && $rs->FieldType(0) == 'bool'){
			return ('f' == $val ? false : true);
		}
		return $val;
	}
	public function Close()						{	return pg_close($this->connection);								}
	public function DbName()					{	return pg_dbname($this->connection);							}
	public function DecodeBlob($data)			{	return pg_unescape_bytea($data);								}
	public function EncodeBlob($data)			{	return pg_escape_bytea($data);									}
	public function EscapeStr($str)				{	return pg_escape_string($str);									}
	public function Execute($fName){
		$params							 = func_get_args();
		$sql							 = array_shift($params);
		if( !isset($this->stmts[$fName]) ){
			$this->stmts[$fName]		 = count($params);
			$sArgs						 = array();
			for($i = 1 ; $i <= $this->stmts[$fName] ; $i++){
				$sArgs[]				 = '$' . $i;
			}
			$sql						 = "SELECT * FROM {$fName}(" . implode(", ", $sArgs) . ");";
			pg_prepare($this->connection, $fName, $sql);
		}
		return ( new PgSQLiDataSet( pg_execute($this->connection, $fName, $params) ) );
	}
	public function Host()						{	return pg_host($this->connection);								}
	public function IsBusy()					{	return pg_connection_busy($this->connection);					}
	public function MetaData($tableName)		{	return pg_meta_data($this->connection, $tableName);				}
	public function Options()					{	return pg_options($this->connection);							}
	public function Port()						{	return pg_port($this->connection);								}
	public function Query($sql){
		$params							 = func_get_args();
		$sql							 = array_shift($params);
		$stmtName						 = 'php_' . md5( $sql );
		if( !isset($this->stmts[$stmtName]) ){
			$this->stmts[$stmtName]		 = count($params);
			pg_prepare($this->connection, $stmtName, $sql);
		}
		return ( new PgSQLiDataSet( pg_execute($this->connection, $stmtName, $params) ) );
	}
	public function QueryValue($sql){
		$val							 = pg_fetch_result( call_user_func_array( array($this, "Query"), func_get_args() ), 0, 0);
		return $val;
	}
	public function Reset()						{	return pg_connection_reset($this->connection);					}
	public function Status()					{	return pg_connection_status($this->connection);					}
	public function Trace($file, $mode = "w")	{	return pg_trace($file, $mode, $this->connection);				}
	public function UnTrace()					{	return pg_trace($this->connection);								}
	public function Version()					{	return pg_version($this->connection);							}
}

class PgSQLiDataSet{
	private $ds;
	public function __construct($dset)			{	$this->ds	= $dset;											}
	public function __destruct()				{	return $this->Free();											}
	public function AffectedRows()				{	return pg_affected_rows($this->ds);								}
	public function Error()						{	return pg_result_error($this->ds);								}
	public function Fetch()						{	return pg_fetch_assoc($this->ds);								}
	public function FetchAll(int $column = NULL){
		return (is_null($column)
					? pg_fetch_all($this->ds)
					: pg_fetch_all_columns($this->ds, $column)
				);
	}
	public function FetchArray()				{	return pg_fetch_array($this->ds);								}
	public function FetchAssoc()				{	return $this->Fetch();											}
	public function FetchObject()				{	return pg_fetch_object($this->ds);								}
	public function FetchResult($row=0, $col=0)	{	return pg_fetch_result($this->ds, $row, $col);					}
	public function FetchRow()					{	return pg_fetch_row($this->ds);									}
	public function FieldName($fieldNo)			{	return pg_field_num($this->ds, $fieldNo);						}
	public function FieldNum($fieldName)		{	return pg_field_num($this->ds, $fieldName);						}
	public function FieldSize($fieldNo)			{	return pg_field_size($this->ds, $fieldNo);						}
	public function FieldTable($fNo, $o = false){	return pg_field_table($this->ds, $fNo, $o);						}
	public function FieldType($fieldNo)			{	return pg_field_type($this->ds, $fieldNo);						}
	public function FieldTypeOID($fieldNo)		{	return pg_field_type_oid($this->ds, $fieldNo);					}
	public function Free()						{	return pg_free_result($this->ds);								}
	public function Value()						{	return pg_fetch_result($this->ds, 0, 0);						}
	public function NumRows()					{	return pg_num_rows($this->ds);									}
	public function Seek($index)				{	return pg_result_seek($this->ds, $index);						}
}
?>