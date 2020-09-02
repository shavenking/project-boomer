<?php

namespace App\Repos;

use App\Repos\Contracts\DailyLabor as Contract;
use App\Entities\{
    ConstructionDaily as ConstructionDailyEntity,
    Labor as LaborEntity
};

class DailyLabor implements Contract
{
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
