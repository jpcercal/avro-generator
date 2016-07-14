<?php

namespace Cekurte\Avro\Generator\Export;

use Cekurte\Avro\Generator\Contracts\Export;
use Cekurte\Avro\Generator\Exception\DatabaseException;
use Cekurte\Avro\Generator\Mapper\Avro;

class AvroExport implements Export
{
    private $data;

    public function __construct(Avro $avro)
    {
        $this->data = $avro->toArray();
    }

    public function exportTo($path)
    {
        return file_put_contents($path, json_encode($this->data, JSON_PRETTY_PRINT));
    }
}
