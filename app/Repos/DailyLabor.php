<?php

namespace App\Repos;

use Illuminate\Support\Collection;
use App\Repos\Contracts\DailyLabor as Contract;
use App\Entities\{
    ConstructionDaily as ConstructionDailyEntity,
    Labor as LaborEntity
};
use League\Fractal\{
    Manager,
    Resource\Item,
    Resource\Collection as ResourceCollection
};
use App\Entities\Transformers\DailyLaborTransformer;

class DailyLabor implements Contract
{
    protected $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    public function transform(
        $laborOrLabors,
        ConstructionDailyEntity $constructionDaily
    ): Collection {
        // Labor
        if ($laborOrLabors instanceof LaborEntity) {
            $resource = $this->transformItem(
                $laborOrLabors,
                $constructionDaily
            );
        }

        // Labors
        if ($laborOrLabors instanceof Collection) {
            $resource = $this->transformCollection(
                $laborOrLabors,
                $constructionDaily
            );
        }

        if (!isset($resource)) {
            throw new \Exception;
        }

        return new Collection(
            $this->manager->createData($resource)->toArray()
        );
    }

    public function firstOrFail(
        ConstructionDailyEntity $constructionDaily,
        LaborEntity $labor
    ) {
        return (
            $constructionDaily
                ->labors()
                ->wherePivot('labor_id', $labor->id)
                ->firstOrFail()
        );
    }

    private function transformCollection(
        Collection $labors,
        ConstructionDailyEntity $constructionDaily
    ) {
        return new ResourceCollection(
            $labors,
            new DailyLaborTransformer(
                $constructionDaily
            ),
            'daily_labor'
        );
    }

    private function transformItem(
        LaborEntity $labor,
        ConstructionDailyEntity $constructionDaily
    ) {
        return new Item(
            $labor,
            new DailyLaborTransformer(
                $constructionDaily
            ),
            'daily_labor'
        );
    }
}
