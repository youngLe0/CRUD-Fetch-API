<?php
class Db
{

    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = 'password123';

    private const DBNAME = 'userdb';

    private $dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME . ';dbpassword=' . self::DBPASS;

    protected $conn = null;

    public function __construct()
    {
        try {

            $this->conn = new PDO($this->dsn, self::DBUSER, self::DBPASS);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error' . $e->getMessage());

        }
    }


}

?>