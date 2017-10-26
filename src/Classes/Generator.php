<?php


namespace TsWink\Classes;


use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

abstract class Generator
{
    /** @var \Doctrine\DBAL\Connection */
    protected $conn;

    /** @var \Doctrine\DBAL\Schema\AbstractSchemaManager */
    protected $schemaManager;

    /** @var \Doctrine\DBAL\Schema\Table[] */
    protected $tables;

    public function __construct()
    {
        $config = new Configuration;

        $connectionParams = [];

        if(function_exists('app')) {
            $connectionParams = app('db')->getConfig();
            $connectionParams['driver'] = "pdo_" . $connectionParams['driver'];
            $connectionParams['dbname'] = $connectionParams['database'];
            $connectionParams['user'] = $connectionParams['username'];
        }

        $this->conn = DriverManager::getConnection($connectionParams, $config);
        $this->schemaManager = $this->conn->getSchemaManager();
        $this->tables = $this->schemaManager->listTables();
    }
}