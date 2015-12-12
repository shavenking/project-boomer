<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CostTypesTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testIndex()
    {
        $model = app(\App\Entities\CostType::class);

        $costType = factory(get_class($model))->create();

        $this->get(route('api.v1.cost-types.index'))->seeJson();

        $this->seeInDatabase($model->getTable(), $costType->toArray());
    }
}
