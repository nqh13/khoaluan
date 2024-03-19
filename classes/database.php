<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "db_khoaluan");

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh;
    private $error;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function prepare($sql)
    {
        return $this->dbh->prepare($sql);
    }

    public function select($query)
    {
        $stmt = $this->dbh->query($query);
        return $stmt;
    }

    public function insert($query)
    {
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update($query)
    {
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function delete($query)
    {
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function last_id()
    {
        return $this->dbh->lastInsertId();
    }

    public function get_Numrow($query)
    {
        $stmt = $this->dbh->query($query);
        return $stmt->rowCount();
    }
}
