<?php

/**
 * Created by PhpStorm.
 * User: andre
 * Date: 23/09/15
 * Time: 01:18 PM
 */
class Utils
{
    /** @var MysqliDb  */
    protected $db_instance;
    private $db_config;
    protected $errors = array();

    public function __construct()
    {
        /** @var array $db */
        require_once 'config.php';
        require_once 'PHP-MySQLi-Database-Class-master/MysqliDb.php';

        new MysqliDb ($db);

        $this->db_instance = MysqliDb::getInstance();
        $this->db_config = $db;

    }

    /**
     * @return MysqliDb
     */
    public function getDB()
    {
        return $this->db_instance;
    }

    public function getDbConfig()
    {
        return $this->db_config;
    }

    public function reportError($error)
    {
        echo "
            <p>Hubo un error al insertar una entrada a la base de datos:</p>
            <span>$error</span>
        ";
    }

    public function cleanInput($variable)
    {
        $variable = htmlentities(strip_tags($this->getDB()->escape(trim($variable))));
        return $variable;
    }

    public function addError($string)
    {
        $this->errors[] = $string;
        return $this;
    }

    public function showErrors()
    {
        if(!empty($this->errors)) {
            foreach($this->errors as $error) {
                $this->reportError($error);
            }
        }
    }
}

$utils = new Utils();