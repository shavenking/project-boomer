<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UnitTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testIndex()
    {
        $model = app(\App\Entities\Unit::class);

        $unit = factory(get_class($model))->create();

        $this->get(route('api.v1.units.index'))->seeJson();

        $this->seeInDatabase($model->getTable(), $unit->toArray());
    }
}
