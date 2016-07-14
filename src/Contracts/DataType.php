<?php

namespace Cekurte\Avro\Generator\Contracts;

interface DataType
{
    public function process($row);

    public function getType();

    public function getSqlType();

    public function getMetadata();
}
