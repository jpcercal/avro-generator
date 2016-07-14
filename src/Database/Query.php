<?php

namespace Cekurte\Avro\Generator\Database;

use Cekurte\Avro\Generator\Exception\DatabaseException;

class Query
{
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function runQuery()
    {
        $sql = <<<EOT
SELECT  b.name table_name,
        a.name column_name,
        d.name [type_name],
        a.max_length,
        a.precision,
        a.scale

    FROM sys.columns a

        INNER JOIN sys.tables b
            ON a.object_id = b.object_id

        INNER JOIN sys.schemas c
            ON b.schema_id = c.schema_id

        INNER JOIN sys.types d
            ON a.system_type_id = d.system_type_id

    WHERE c.name = 'Staging'

    ORDER by b.name
EOT;

        $stmt = $this->connection->prepare($sql, [
            \PDO::ATTR_CURSOR => \PDO::CURSOR_SCROLL
        ]);

        $stmt->execute();

        return $stmt;
    }
}
