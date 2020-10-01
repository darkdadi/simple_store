<?php
class dbQuery
{
    private $dbconn;
    var $stmt;
    var $connected;
    var $dbname;

    public function __construct()
    {
        $this->dbconn = null;
        $this->stmt = null;
        $this->connected = false;
    }

    function connect($config)
    {
        $this->connected = false;
        $host = $config['host'];
        $db = $config['db'];
        $user = $config['user'];
        $pass = $config['pass'];

        try
        {
            $this->dbconn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this
                ->dbconn
                ->exec("set names utf8");
            $this->dbname = $config['db'];
            $this->connected = true;
        }
        catch(PDOException $e)
        {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    } //end of function
    function beginTransaction()
    {
        $this
            ->dbconn
            ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this
            ->dbconn
            ->beginTransaction();
    }

    function commitTransaction()
    {
        $this
            ->dbconn
            ->commit();
    }

    function rollBack()
    {
        $this
            ->dbconn
            ->rollBack();
    }

    function setStatement($sql = "")
    {
        $this->stmt = $this
            ->dbconn
            ->prepare($sql);
    }

    function execSQL($values = array())
    {
        $paramCount = count($values);

        if ($paramCount > 0)
        {
            for ($i = 0;$i < $paramCount;$i++)
            {
                $this
                    ->stmt
                    ->bindParam($i + 1, $values[$i]);
            }
        }

        $this
            ->stmt
            ->execute();

    }

    function querySQL($values = array())
    {
        $paramCount = count($values);
        $this
            ->dbconn
            ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this
            ->dbconn
            ->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

        if ($paramCount > 0)
        {
            for ($i = 0;$i < $paramCount;$i++)
            {
                $this
                    ->stmt
                    ->bindParam($i + 1, $values[$i]);
            }
        }
        $this
            ->stmt
            ->execute();

    }

    function getRowCount()
    {
        return $this
            ->stmt
            ->rowCount();
    }

    function lastInsertId($name = null)
    {
        return $this
            ->dbconn
            ->lastInsertId($name);
    }

    function closeConnection()
    {
        $this->dbconn = null;
    }

    function inTransaction()
    {
        return $this->dbconn->inTransaction();
    }
}
?>