<?php
include_once __SITE_PATH.'/config/database.php';

class sys_db {
    /* * * Declare instance ** */

    private $instance = NULL;
    private $dbconn = null;
    private $host = DB_HOST;
    private $dbname = DB_DBNAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $type = DB_TYPE;
    private $sqlpath = DB_SQLITE_PATH;

    public function __construct() {
        /*         * * maybe set the db name here later ** */
        try {
            //echo "-".$this->type."-".$this->host."-".$this->dbname."-".$this->user;
            switch ($this->type) {
                case 'sqlsrv':
                    $this->dbconn = new PDO("sqlsrv:Server=$this->host;Database=$this->dbname", $this->user, $this->pass);
                    break;
                case 'mssql':
                    $this->dbconn = new PDO("mssql:host=$this->host;dbname=$this->dbname;charset=UTF-8", $this->user, $this->pass);
                    break;
                case 'sybase':
                    $this->dbconn = new PDO("sybase:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
                    break;
                case 'mysql':                    
                    $this->dbconn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                    break;
                case 'sqlite':
                    $this->dbconn = new PDO("sqlite:" . $this->sqlpath);
                    break;
                default :
                    $this->dbconn = new PDO("mssql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
                    break;
            }

            $this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            if (DEBUG_MODE == 1)
                echo "<strong style='color:#ff0000'>" . $ex->getMessage() . ".</strong><br/> " . $ex->getTraceAsString();
            else
                echo "<strong style='color:#ff0000'>Query Exception!</strong> ";
        }
        return $this->dbconn;
    }

    /* GetById */

    public function GetById($table, $where="id='0'") {
        $result = null;
        try {
            $stmt = $this->dbconn->query("SELECT * FROM $table WHERE $where; ");
            $result = $stmt->fetch();
        } catch (PDOException $ex) {
            if (DEBUG_MODE == 1)
                echo "<strong style='color:#ff0000'>" . $ex->getMessage() . ".</strong><br/> " . $ex->getTraceAsString();
            else
                echo "<strong style='color:#ff0000'>Query Exception!</strong> ";
        }
        return $result;
    }

    /* GetById */

    public function GetByIdPre($arr_pr=array('tbl1', '0=0')) {
        $result = null;
        try {
            $stmt = $this->dbconn->prepare("SELECT * FROM ? WHERE ? ; ");
            $stmt->execute($arr_pr); //su dung cho param ? ?
            $result = $stmt->fetch();
        } catch (PDOException $ex) {
            if (DEBUG_MODE == 1)
                echo "<strong style='color:#ff0000'>" . $ex->getMessage() . ".</strong><br/> " . $ex->getTraceAsString();
            else
                echo "<strong style='color:#ff0000'>Query Exception!</strong> ";
        }
        return $result;
    }

    /* GetById */

    public function GetLastInsert() {
        return $this->dbconn->lastInsertId();
    }

    /* ExecNonQuery */

    public function ExecNonQuery($query) {
        $result = null;
        try {
            $result = $this->dbconn->exec($query);
        } catch (PDOException $ex) {
            if (DEBUG_MODE == 1)
                echo "<strong style='color:#ff0000'>" . $ex->getMessage() . ".</strong><br/> " . $ex->getTraceAsString();
            else
                echo "<strong style='color:#ff0000'>Query Exception!</strong> ";
        }
        return $result;
    }

    /* ExecNonQueryPre */

    public function ExecNonQueryPre($query, $arr_pr) {
        $result = null;
        try {
            $stmt = $this->dbconn->prepare($query);
            $result = $stmt->execute($arr_pr); //su dung cho param ? ?
        } catch (PDOException $ex) {
            if (DEBUG_MODE == 1)
                echo "<strong style='color:#ff0000'>" . $ex->getMessage() . ".</strong><br/> " . $ex->getTraceAsString();
            else
                echo "<strong style='color:#ff0000'>Query Exception!</strong> ";
        }
        return $result;
    }

    /* ExecQuery */

    public function ExecQuery($query) {
        $result = null;
        try {
            $stmt = $this->dbconn->query($query);
            $result = $stmt->fetchAll();
        } catch (PDOException $ex) {
            if (DEBUG_MODE == 1)
                echo "<strong style='color:#ff0000'>" . $ex->getMessage() . ".</strong><br/> " . $ex->getTraceAsString();
            else
                echo "<strong style='color:#ff0000'>Query Exception!</strong> ";
        }
        return $result;
    }

    /* ExecQueryPre */

    public function ExecQueryPre($query, $arr_pr) {
        $result = null;
        try {
            $stmt = $this->dbconn->prepare($query);
            $stmt->execute($arr_pr); //su dung cho param ? ?
            $result = $stmt->fetchAll();
        } catch (PDOException $ex) {
            if (DEBUG_MODE == 1)
                echo "<strong style='color:#ff0000'>" . $ex->getMessage() . ".</strong><br/> " . $ex->getTraceAsString();
            else
                echo "<strong style='color:#ff0000'>Query Exception!</strong> ";
        }
        return $result;
    }

    /* ExecScalar */

    public function ExecScalar($query) {
        $result = null;
        try {
            $stmt = $this->dbconn->query($query);
            $result = $stmt->fetch();
        } catch (PDOException $ex) {
            echo $ex;
        }
        return $result;
    }

    /* ExecScalarPre */

    public function ExecScalarPre($query, $arr_pr) {
        $result = null;
        try {
            $stmt = $this->dbconn->prepare($query);
            $stmt->execute($arr_pr); //su dung cho param ? ?
            $result = $stmt->fetch();
        } catch (PDOException $ex) {
            if (DEBUG_MODE == 1)
                echo "<strong style='color:#ff0000'>" . $ex->getMessage() . ".</strong><br/> " . $ex->getTraceAsString();
            else
                echo "<strong style='color:#ff0000'>Query Exception!</strong> ";
        }
        return $result;
    }

    public function __destruct() {
        $this->dbconn = NULL;
    }

    /* ================================== property ========================================== */

    private function set_host($host) {
        $this->host = $host;
    }

    private function set_user($user) {
        $this->user = $user;
    }

    private function set_pass($pass) {
        $this->pass = $pass;
    }

    private function set_dbname($dbname) {
        $this->dbname = $dbname;
    }

    private function set_type($type) {
        $this->type = $type;
    }

}

/* * * end of class ** */
?>
