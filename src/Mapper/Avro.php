<?php

namespace Cekurte\Avro\Generator\Mapper;

use Cekurte\Avro\Generator\Exception\DatabaseException;
use Cekurte\Avro\Generator\Mapper\Field;

class Avro
{
    private $type;

    private $name;

    private $doc;

    private $fields;

    private $tableName;

    public function __construct($row)
    {
        $this
            ->setType('record')
            ->setName($row['table_name'])
            ->setTableName($row['table_name'])
            ->setDoc(sprintf('Schema for %s', $row['table_name']))
        ;
    }

    /**
     * Get data as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'type'      => $this->getType(),
            'name'      => $this->getName(),
            'doc'       => $this->getDoc(),
            'fields'    => $this->getFields(),
            'tableName' => $this->getTableName(),
        ];
    }

    /**
     * Gets the value of type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the value of type.
     *
     * @param string $type the type
     *
     * @return Avro
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Gets the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param string $name the name
     *
     * @return Avro
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of doc.
     *
     * @return string
     */
    public function getDoc()
    {
        return $this->doc;
    }

    /**
     * Sets the value of doc.
     *
     * @param string $doc the doc
     *
     * @return Avro
     */
    public function setDoc($doc)
    {
        $this->doc = $doc;

        return $this;
    }

    /**
     * Gets the value of fields.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Add a value to fields.
     *
     * @param Field $field the field
     *
     * @return Avro
     */
    public function addField(Field $field)
    {
        $this->fields[] = $field->toArray();

        return $this;
    }

    /**
     * Gets the value of tableName.
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * Sets the value of tableName.
     *
     * @param string $tableName the table name
     *
     * @return Avro
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }
}
