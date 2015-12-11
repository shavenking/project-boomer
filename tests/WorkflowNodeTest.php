<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkflowNodeTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    protected $workflowModel;

    protected $nodeModel;

    public function setUp()
    {
        parent::setUp();

        $this->workflowModel = app(\App\Entities\Workflow::class);
        $this->nodeModel = app(\App\Entities\WorkflowNode::class);
    }

    public function testIndex()
    {
        $workflow = factory(get_class($this->workflowModel))->create();

        $nodes = $workflow->nodes;

        $this->get(
            route('api.v1.workflows.nodes.index', $workflow->id)
        )->seeJson();
    }

    public function testStore()
    {
        $workflow = factory(get_class($this->workflowModel))->create();

        $node = factory(get_class($this->nodeModel))->make([
            'workflow_id' => $workflow->id
        ]);

        $this->post(
            route('api.v1.workflows.nodes.store', $workflow->id),
            [
                'order' => $node->order,
                'title' => $node->title
            ]
        )->seeJson();

        $this->seeInDatabase($this->nodeModel->getTable(), $node->toArray());
    }

    public function testShow()
    {
        $workflow = factory(get_class($this->workflowModel))->create();

        $node = $workflow->nodes()->create(
            factory(get_class($this->nodeModel))->make()->toArray()
        );

        $this->get(
            route('api.v1.workflows.nodes.show', [$workflow->id, $node->id])
        )->seeJson();
    }

    public function testUpdate()
    {
        $workflow = factory(get_class($this->workflowModel))->create();

        $node = $workflow->nodes()->create(
            factory(get_class($this->nodeModel))->make()->toArray()
        );

        $updateValues = [
            'order' => $node->order + 1,
            'title' => $node->title . 'TESTING'
        ];

        $this->put(
            route('api.v1.workflows.nodes.update', [$workflow->id, $node->id]),
            $updateValues
        )->seeJson();

        $this->seeInDatabase(
            $this->nodeModel->getTable(),
            array_merge($node->toArray(), $updateValues)
        );
    }

    public function testDestroy()
    {
        $workflow = factory(get_class($this->workflowModel))->create();

        $node = $workflow->nodes()->create(
            factory(get_class($this->nodeModel))->make()->toArray()
        );

        $this->delete(
            route('api.v1.workflows.nodes.destroy', [$workflow->id, $node->id])
        )->seeJson();

        $this->notSeeInDatabase($this->nodeModel->getTable(), $node->toArray());
    }
}
