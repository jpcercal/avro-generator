<?php

namespace Cekurte\Avro\Generator\DataType;

use Cekurte\Avro\Generator\Contracts\DataType;
use Cekurte\Avro\Generator\DataType\GenericDataType;

class StringDataType extends GenericDataType implements DataType
{
    public function process($row)
    {
        $this->data = [
            'sqlType'  => '12',
            'type'     => 'string',
            'metadata' => '',
        ];

        return $this;
    }
}
