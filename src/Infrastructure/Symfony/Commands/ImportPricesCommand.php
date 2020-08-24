<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportPricesCommand extends Command
{
    protected function configure(): void
    {
        $this->setDescription('Import command to retrieve prices')
            ->setName('7senders:products:import-prices');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Importing prices information');
        $output->writeln('Done');

        return Command::SUCCESS;
    }
}
