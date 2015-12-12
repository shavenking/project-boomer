<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainflowTypeTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testIndex()
    {
        $model = app(\App\Entities\MainflowType::class);

        $mainflowType = factory(get_class($model))->create();

        $this->get(route('api.v1.mainflow-types.index'))->seeJson();

        $this->seeInDatabase($model->getTable(), $mainflowType->toArray());
    }
}
