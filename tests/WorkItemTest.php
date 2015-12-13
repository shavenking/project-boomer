<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkItemTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function testIndex()
    {
        $workModel = app(\App\Entities\Work::class);

        $itemModel = app(\App\Entities\WorkItem::class);

        $work = factory(get_class($workModel))->create();

        $item = factory(get_class($itemModel))->create([
            'work_id' => $work->id
        ]);

        $this->get(route('api.v1.works.work-items.index', $work->id))->seeJson();

        $this->seeInDatabase($itemModel->getTable(), $item->toArray());
    }

    public function testStore()
    {
        $workModel = app(\App\Entities\Work::class);
        $itemModel = app(\App\Entities\WorkItem::class);

        $work = factory(get_class($workModel))->create();

        $item = factory(get_class($itemModel))->make([
            'work_id' => $work->id
        ]);

        $this->post(
            route('api.v1.works.work-items.store', $work->id),
            $item->toArray()
        )->seeJson();

        $this->seeInDatabase($itemModel->getTable(), $itemModel->toArray());
    }

    public function testDestroy()
    {
        $workModel = app(\App\Entities\Work::class);
        $itemModel = app(\App\Entities\WorkItem::class);

        $work = factory(get_class($workModel))->create();

        $item = factory(get_class($itemModel))->create([
            'work_id' => $work->id
        ]);

        $this->delete(
            route('api.v1.works.work-items.destroy', [$work->id, $item->id])
        )->seeJson();

        $this->notSeeInDatabase($itemModel->getTable(), $itemModel->toArray());
    }
}
