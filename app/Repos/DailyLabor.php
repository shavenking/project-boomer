<?php

namespace App\Repos;

use Illuminate\Support\Collection;
use App\Repos\Contracts\DailyLabor as Contract;
use App\Entities\{
    ConstructionDaily as ConstructionDailyEntity,
    Labor as LaborEntity
};
use App\Entities\Transformers\DailyThingTransformer;

class DailyLabor implements Contract
{
    public function transform(
        $laborOrLabors,
        ConstructionDailyEntity $constructionDaily
    ): Collection {
        $transformer = new DailyThingTransformer(
            $constructionDaily
        );

        $result = call_user_func(
            app('fractalTransform'),
            $laborOrLabors,
            $transformer,
            'daily_labor'
        );

        return $result;
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
}
