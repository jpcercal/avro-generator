<?php

namespace Cekurte\Avro\Generator\Command;

use Cekurte\Avro\Generator\Database\ConnectionFactory;
use Cekurte\Avro\Generator\Database\Query;
use Cekurte\Avro\Generator\Exception\DatabaseException;
use Cekurte\Avro\Generator\Export\AvroExport;
use Cekurte\Avro\Generator\Mapper\Avro;
use Cekurte\Avro\Generator\Mapper\Field;
use Cekurte\Environment\Environment;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

class Generator extends Command
{
    /**
     * @var SymfonyStyle
     */
    private $io;

    protected function configure()
    {
        $this
            ->setName('cekurte:avro:generator')
            ->setDescription('Generate avro files given a database name.')
            ->setHelp(<<<'EOF'
The <info>%command.name%</info> command export avro files given a database name to do this:

  <info>php %command.full_name% %command.name%</info>
EOF
            )
        ;
    }

    private function sectionDatabase()
    {
        $this->io->section('Database');

        $connection = null;

        $question = 'Set the database name';

        $dbName = $this->io->ask($question, null, function ($input) use (&$connection) {
            try {
                $connection = ConnectionFactory::getConnection($input);
            } catch (DatabaseException $e) {
                throw new \RuntimeException(sprintf(
                    '%s. %s',
                    $e->getMessage(),
                    'Check if the database name exists.'
                ));
            }

            return $input;
        });

        $this->io->success($dbName);

        $question = 'Set the path to export files';

        $path = $this->io->ask($question, null, function ($input) {
            if (!is_dir($input = str_replace('\\ ', ' ', $input))) {
                throw new \RuntimeException('You must type an valid directory.');
            }

            return $input;
        });

        $this->io->success($path);

        $stmt = (new Query($connection))->runQuery();

        $avro = null;

        $currentTable = null;

        $rowCount = $stmt->rowCount();

        $index = 0;

        $this->io->section('Export');

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $index++;

            $loopLast = $rowCount === $index;

            if ($currentTable != $row['table_name'] || $loopLast) {
                if ($avro instanceof Avro) {
                    $exportTo = sprintf(
                        '%s%s%s.avsc',
                        $path,
                        DIRECTORY_SEPARATOR,
                        $currentTable
                    );

                    $this->io->text(sprintf(
                        'Exporting avro data to "%s"',
                        $exportTo
                    ));

                    if ($loopLast) {
                        $avro->addField(new Field($row));
                    }

                    if (false !== (new AvroExport($avro))->exportTo($exportTo)) {
                        $this->io->note('File exported with successfully.');
                    } else {
                        $this->io->error('An error occurred.');
                    }
                }

                if (!$loopLast) {
                    $currentTable = $row['table_name'];

                    $this->io->text(sprintf(
                        'Reading the table "%s"',
                        $currentTable
                    ));

                    $avro = new Avro($row);
                }
            }

            $avro->addField(new Field($row));
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->io->title('Avro Generator');
        $this->io->newLine();

        $this->sectionDatabase();

        $this->io->success('Great Job!');
    }
}
