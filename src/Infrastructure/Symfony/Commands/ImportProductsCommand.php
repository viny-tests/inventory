<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Commands;

use App\Infrastructure\Symfony\Service\ImporterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportProductsCommand extends Command
{
    private ImporterService $importerService;

    public function __construct(ImporterService $importerService, string $name = '7senders:products:import-info')
    {
        $this->importerService = $importerService;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setDescription('Import command to create/update products');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Importing products information');
        $this->importerService->importProducts();
        $output->writeln('Done');

        return Command::SUCCESS;
    }
}
