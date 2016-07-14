<?php

namespace Cekurte\Avro\Generator\DataType;

use Cekurte\Avro\Generator\Contracts\DataType;

abstract class GenericDataType implements DataType
{
    protected $data;

    public function getType()
    {
        return $this->data['type'];
    }

    public function getSqlType()
    {
        return $this->data['sqlType'];
    }

    public function getMetadata()
    {
        return $this->data['metadata'];
    }
}
