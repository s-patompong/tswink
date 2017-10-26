<?php


namespace TsWink\Classes;


use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\ArrayType;
use Doctrine\DBAL\Types\BigIntType;
use Doctrine\DBAL\Types\BinaryType;
use Doctrine\DBAL\Types\BlobType;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\DateImmutableType;
use Doctrine\DBAL\Types\DateIntervalType;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\DateTimeTzImmutableType;
use Doctrine\DBAL\Types\DateTimeTzType;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\DecimalType;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\GuidType;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\JsonArrayType;
use Doctrine\DBAL\Types\JsonType;
use Doctrine\DBAL\Types\ObjectType;
use Doctrine\DBAL\Types\SimpleArrayType;
use Doctrine\DBAL\Types\SmallIntType;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\DBAL\Types\TimeImmutableType;
use Doctrine\DBAL\Types\TimeType;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\VarDateTimeImmutableType;
use Doctrine\DBAL\Types\VarDateTimeType;
use TsWink\Exceptions\UnknownTypeException;

class TypeSimplifier
{
    /** @var Type */
    private $type;

    public function simplify(Column $column)
    {
        $this->type = $column->getType();

        if($this->isTypeString()) {
            return "''";
        }
        if($this->isTypeAny()) {
            return "any";
        }
        if($this->isTypeNumber()) {
            return "0";
        }
        if($this->isTypeDecimal()) {
            return "0.0";
        }
        if($this->isBooleanDecimal()) {
            return "false";
        }

        throw new UnknownTypeException("Unknown type: {$this->type->getName()}");
    }

    private function isTypeString()
    {
        return $this->type instanceof BinaryType
            || $this->type instanceof GuidType
            || $this->type instanceof StringType
            || $this->type instanceof TextType;
    }

    private function isTypeAny()
    {
        return $this->type instanceof ArrayType
            || $this->type instanceof DateImmutableType
            || $this->type instanceof DateIntervalType
            || $this->type instanceof DateTimeImmutableType
            || $this->type instanceof DateTimeType
            || $this->type instanceof DateTimeTzImmutableType
            || $this->type instanceof DateTimeTzType
            || $this->type instanceof DateType
            || $this->type instanceof JsonArrayType
            || $this->type instanceof JsonType
            || $this->type instanceof ObjectType
            || $this->type instanceof SimpleArrayType
            || $this->type instanceof TimeImmutableType
            || $this->type instanceof TimeType
            || $this->type instanceof VarDateTimeImmutableType
            || $this->type instanceof VarDateTimeType;
    }

    private function isTypeNumber()
    {
        return $this->type instanceof BigIntType
            || $this->type instanceof IntegerType
            || $this->type instanceof SmallIntType;
    }

    private function isTypeDecimal()
    {
        return $this->type instanceof DecimalType
            || $this->type instanceof FloatType;
    }

    private function isBooleanDecimal()
    {
        return $this->type instanceof BooleanType ;
    }
}