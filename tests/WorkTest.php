<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testIndex()
    {
        $model = app(\App\Entities\Work::class);

        $work = factory(get_class($model))->create();

        $this->get(route('api.v1.works.index'))->seeJson();

        $this->seeInDatabase($model->getTable(), $work->toArray());
    }
}
