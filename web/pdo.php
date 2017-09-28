<?php
/*
class PDO {
public function __construct ( string $dsn [, string $username [, string $password [, array $driver_options ]]] )
bool beginTransaction ( void )
bool commit ( void )
mixed errorCode ( void )
public array errorInfo ( void )
int exec ( string $statement )
mixed getAttribute ( int $attribute )
static array getAvailableDrivers ( void )
bool inTransaction ( void )
string lastInsertId ([ string $name = NULL ] )
public PDOStatement prepare ( string $statement [, array $driver_options = array() ] )
public PDOStatement query ( string $statement )
public string quote ( string $string [, int $parameter_type = PDO::PARAM_STR ] )
bool rollBack ( void )
bool setAttribute ( int $attribute , mixed $value )
}
*/

$pdo = new PDO();