<?php

namespace Cekurte\Avro\Generator\DataType;

use Cekurte\Avro\Generator\Contracts\DataType;
use Cekurte\Avro\Generator\DataType\GenericDataType;

class FloatDataType extends GenericDataType implements DataType
{
    public function process($row)
    {
        $this->data = [
            'sqlType'  => '6',
            'type'     => 'float',
            'metadata' => [
                'decimalDigits' => 0 + $row['scale'],
            ],
        ];

        return $this;
    }
}
