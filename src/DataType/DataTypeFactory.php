<?php

namespace Cekurte\Avro\Generator\DataType;

use Cekurte\Avro\Generator\Contracts\DataType;
use Cekurte\Avro\Generator\DataType\FloatDataType;
use Cekurte\Avro\Generator\DataType\IntegerDataType;
use Cekurte\Avro\Generator\DataType\LongDataType;
use Cekurte\Avro\Generator\DataType\StringDataType;

class DataTypeFactory
{
    /**
     * Get a DataType instance.
     *
     * @param  array $row
     *
     * @return DataType
     */
    public static function getDataType($row)
    {
        switch ($row['type_name']) {
            case 'int':
                return (new IntegerDataType())->process($row);

            case 'int64':
            case 'bigint':
            case 'long':
                return (new LongDataType())->process($row);

            case 'varchar':
            case 'char':
                return (new StringDataType())->process($row);

            case 'float':
            case 'double':
                return (new FloatDataType())->process($row);
            case 'numeric':
                if ($row['scale'] > 0) {
                    return (new FloatDataType())->process($row);
                }

                if ($row['precision'] > 10) {
                    return (new LongDataType())->process($row);
                }

                return (new IntegerDataType())->process($row);
            default:
                return (new DefaultDataType())->process($row);
        }
    }
}
