<?php
declare(strict_types=1);

namespace App\Infrastructure\Symfony\Commands;

use App\Infrastructure\Symfony\Service\ImporterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \JsonException;
use function sprintf;

class ImportPricesCommand extends Command
{
    private ImporterService $importerService;

    public function __construct(ImporterService $importerService, string $name = '7senders:products:import-prices')
    {
        $this->importerService = $importerService;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setDescription('Import command to retrieve prices');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Importing prices information');
        try {
            $this->importerService->importPrices();
        } catch (JsonException $e) {
            $output->writeln(sprintf('Error: %s', $e->getMessage()));

            return Command::FAILURE;
        }
        $output->writeln('Done');

        return Command::SUCCESS;
    }
}
