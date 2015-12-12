<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DetailingflowTypeTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testIndex()
    {
        $model = app(\App\Entities\DetailingflowType::class);

        $detailingflowType = factory(get_class($model))->create([
            'mainflow_type_id' => 1
        ]);

        $this->get(route('api.v1.mainflow-types.detailingflow-types.index', 1))->seeJson();

        $this->seeInDatabase($model->getTable(), $detailingflowType->toArray());
    }
}
