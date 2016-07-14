<?php

namespace Cekurte\Avro\Generator\DataType;

use Cekurte\Avro\Generator\Contracts\DataType;
use Cekurte\Avro\Generator\DataType\GenericDataType;

class IntegerDataType extends GenericDataType implements DataType
{
    public function process($row)
    {
        $this->data = [
            'sqlType'  => '4',
            'type'     => 'int',
            'metadata' => '',
        ];

        return $this;
    }
}
