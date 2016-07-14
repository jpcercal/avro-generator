<?php

namespace Cekurte\Avro\Generator\Mapper;

use Cekurte\Avro\Generator\DataType\DataTypeFactory;
use Cekurte\Avro\Generator\DataType\FloatDataType;
use Cekurte\Avro\Generator\Exception\DatabaseException;

class Field
{
    private $data;

    public function __construct($row)
    {
        $dataType = DataTypeFactory::getDataType($row);

        $this->data = [
            'name'       => $row['column_name'],
            'type'       => ['null', $dataType->getType()],
            'default'    => null,
            'columnName' => $row['column_name'],
            'sqlType'    => $dataType->getSqlType(),
        ];

        $meta = $dataType->getMetadata();

        if (!empty($meta)) {
            $this->data['metadata'] = $meta;
        }
    }

    public function toArray()
    {
        return $this->data;
    }
}
