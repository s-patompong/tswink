<?php

namespace TsWink\Classes;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;

Class TswinkGenerator extends Generator
{
    /** @var TypeSimplifier */
    private $typeSimplifier;

    /** @var Table */
    private $table;

    public function __construct()
    {
        parent::__construct();

        $this->typeSimplifier = new TypeSimplifier;
    }

    public function generate()
    {
        /** @var Table $table */
        foreach ($this->tables as $table) {
            $this->table = $table;
            $this->processTable();
        }
    }

    private function processTable()
    {
        $this->writeFile($this->singularFromTableName() . ".ts", $this->getClassContent());
    }

    private function getClassContent()
    {
        $tsClass = "export class {$this->getTableNameForClassFile()} {\n";
        foreach ($this->table->getColumns() as $column) {
            $tsClass .= "\t{$column->getName()}: {$this->getSimplifiedType($column)}\n";
        }
        return $tsClass . "}\n";
    }

    private function getTableNameForClassFile()
    {
        return ucfirst($this->singularFromTableName());
    }

    private function singularFromTableName()
    {
        return strtolower(str_singular($this->table->getName()));
    }

    private function getSimplifiedType(Column $column)
    {
        return $this->typeSimplifier->simplify($column);
    }

    private function writeFile($fileName, $tsClass)
    {
        dd($fileName, $tsClass);
    }
}
