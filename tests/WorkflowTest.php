<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkflowTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testIndex()
    {
        $model = app(\App\Entities\Workflow::class);

        $workflow = factory(get_class($model))->create();

        $this->get(route('api.v1.workflows.index'))->seeJson();

        $this->seeInDatabase($model->getTable(), $workflow->toArray());
    }

    public function testStore()
    {
        $this->post(route('api.v1.workflows.store'))->seeJson();
    }

    public function testShow()
    {
        $model = app(\App\Entities\Workflow::class);

        $workflow = factory(get_class($model))->create();

        $this->get(route('api.v1.workflows.show', $workflow->id))
            ->seeJsonEquals([
                'workflow' => $workflow->toArray()
            ]);
    }

    public function testDestroy()
    {
        $model = app(\App\Entities\Workflow::class);

        $workflow = factory(get_class($model))->create();

        $this->delete(route('api.v1.workflows.destroy', $workflow->id))
            ->seeJson();

        $this->notSeeInDatabase($model->getTable(), $workflow->toArray());
    }
}
