<?php
declare(strict_types=1);

namespace App\Tests\Feature\Infrastructure\Symfony\Controller\V1\Actions;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetOneProductByUnitTest extends WebTestCase
{
    public function testGetOneProduct(): void
    {
        $client = self::createClient();
        $client->request('GET', '/v1/products/BA-01/units/package');

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
