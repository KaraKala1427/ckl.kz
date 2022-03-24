<?php

namespace Tests\Unit;

use App\Repositories\PhoneRepository;
use App\Services\Products\CovidService;
use PHPUnit\Framework\TestCase;

class CovidTest extends TestCase
{
    /**
     * @return void
     * @covers CovidService::isAllowedAge
     * @testdox Checking for allowed age, where age is under 65 age
     */
    public function test_for_allowed_age()
    {
        $isAllowedAge = app(CovidService::class)->isAllowedAge('12.12.1970');
        $this->assertTrue($isAllowedAge);
    }

    /**
     * @return void
     * @covers CovidService::isAllowedAge
     * @testdox Checking for not allowed age, where age is above 65 age
     */
    public function test_for_not_allowed_age()
    {
        $isAllowedAge = app(CovidService::class)->isAllowedAge('12.12.1980');
        $this->assertTrue(!$isAllowedAge);
    }


}
