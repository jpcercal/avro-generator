<?php

namespace Cekurte\Avro\Generator\Database;

use Cekurte\Avro\Generator\Exception\DatabaseException;
use Cekurte\Environment\Environment;

class ConnectionFactory
{
    /**
     * @param  string $dbName
     *
     * @return PDO
     *
     * @throws ConnectionException
     */
    public static function getConnection($dbName)
    {
        try {
            $connectionString = str_replace(
                '%DB_NAME%',
                $dbName,
                Environment::get('CONNECTION_STRING')
            );

            $connection = new \PDO(
                $connectionString,
                Environment::get('DB_USER', null),
                Environment::get('DB_PASS', null)
            );

            $connection->setAttribute(
                \PDO::ATTR_ERRMODE,
                \PDO::ERRMODE_EXCEPTION
            );

            return $connection;
        } catch(\PDOException $e) {
            throw new DatabaseException('Error connecting to SQL Server', 1, $e);
        }
    }
}
