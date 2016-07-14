<?php

namespace Cekurte\Avro\Generator\DataType;

use Cekurte\Avro\Generator\Contracts\DataType;
use Cekurte\Avro\Generator\DataType\GenericDataType;

class LongDataType extends GenericDataType implements DataType
{
    public function process($row)
    {
        $this->data = [
            'sqlType'  => '2',
            'type'     => 'long',
            'metadata' => '',
        ];

        return $this;
    }
}
