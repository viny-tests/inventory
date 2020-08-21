<?php
declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class AssertionFakeTest extends TestCase
{
    public function testOk(): void
    {
        self::assertEquals(true, true);
    }
}
