<?php
declare(strict_types=1);

namespace App\Tests\Feature\Infrastructure\Symfony\Commands;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class ImportProductsCommandTest extends KernelTestCase
{
    public function testExecute(): void
    {
        $kernel = self::createKernel();
        $app = new Application($kernel);

        $command = $app->find('7senders:products:import-info');
        $commandTester = new CommandTester($command);
        $result = $commandTester->execute([]);

        $output = $commandTester->getDisplay();

        self::assertStringContainsString('Importing products information', $output);
        self::assertStringContainsString('Done', $output);
        self::assertEquals(Command::SUCCESS, $result);
    }
}
