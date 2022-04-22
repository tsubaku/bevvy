<?php

namespace Vine;

use PDO;

/**
 * Task2 General logic
 */
class Vine
{
    /**
     * @var int
     */
    private $pageSize;

    public function __construct()
    {
        $this->pageSize = 4; //Number of lines per page
    }

    /**
     * Create connection to DB
     * @return PDO
     */
    function connectToBase()
    {
        #Config
        $hostname = "127.0.0.1"; //In a real project this data is taken from the config, which is not included in the git.
        $username = 'user46406_misa';
        $password = 'holik';
        $dbName = 'bevvy';
        $charset = 'utf8';

        $dsn = "mysql:host=$hostname;dbname=$dbName;charset=$charset";
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        $pdo = new PDO($dsn, $username, $password, $opt);

        return $pdo;
    }

    public function getAllData()
    {
        $con = $this->connectToBase();
        #Check connection
        if (!$con) {
            echo "Unable to connect to database server!";
            exit;
        }

        #Pagination
        if (isset($_POST['paginate'])) {
            $paginate = $_POST['paginate'];
        } else {
            $paginate = 1;
        }

        #Search
        if (!empty($_POST['choice']) && !empty($_POST['search'])) {
            $search = $_POST['search'];
            $str = "AND " . $_POST['choice'] . " LIKE '%" . $search . "%'";
        } else {
            $str = '';
        }

        $offset = (($paginate - 1) * $this->pageSize); //start line
        
        $stmt = $con->prepare(
            "SELECT  id,
                           name,
                           strength,
                           @Substr := substring(name, POSITION('.' IN name) + 1 )                                                 AS substr,
                           @FirstResult := REGEXP_REPLACE(SUBSTRING(name, POSITION('.' IN name) - 3, 7), '[a-fi-qs-zA-FI-QS-Z)(]+', '') AS first_result,
                           IF(
                               (@FirstResult) != '',
                               @FirstResult,
                               REGEXP_REPLACE(SUBSTRING(@Substr, POSITION('.' IN @Substr) - 3, 7), '[a-fi-qs-zA-FI-QS-Z)(]+', '')
                               )                                                                                                  AS similar_number
                            FROM whisky
                            WHERE name REGEXP '[0-9][.][0-9]'
                              AND name like '%SMWS%'
                        " . $str . "      
                            ORDER BY similar_number 
                            LIMIT :start, :rows
                        ");
        $stmt->bindParam(':start', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':rows', $this->pageSize, PDO::PARAM_INT);
        $stmt->execute();
        $dataArray = $stmt->fetchAll();

        return json_encode([
            "result" => $dataArray,
            "paginate" => $paginate,
        ], JSON_UNESCAPED_UNICODE);
    }

}