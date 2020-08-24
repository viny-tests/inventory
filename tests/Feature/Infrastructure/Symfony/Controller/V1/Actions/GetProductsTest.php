<?php
declare(strict_types=1);

namespace App\Tests\Feature\Infrastructure\Symfony\Controller\V1\Actions;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetProductsTest extends WebTestCase
{
    public function testList(): void
    {
        $client = self::createClient();
        $client->request('GET', '/v1/products');

        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
