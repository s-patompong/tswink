<?php


namespace TsWink\Classes;


use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;

class TypeSimplifier
{
    public function simplify(Column $column)
    {
        $type = $column->getType();

        if($type instanceof IntegerType) {
            return 0;
        }
        if($type instanceof StringType) {
            return '""';
        }
        if($type instanceof DateTimeType) {
            return '""';
        }

        return "any";
    }
}