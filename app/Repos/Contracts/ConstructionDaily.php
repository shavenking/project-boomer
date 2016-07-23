<?php

namespace App\Repos\Contracts;

use App\Entities\{
    ConstructionDaily as ConstructionDailyEntity,
    Labor,
    Project,
    ProjectWork,
    Subcontractor,
    Material as MaterialEntity
};
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface ConstructionDaily
{
    public function create(\ArrayAccess $data, Project $project): ConstructionDailyEntity;

    public function addDailyWork(string $seat, Subcontractor $subcontractor, ProjectWork $work, ConstructionDailyEntity $constructionDaily);

    public function addLabor(
        ConstructionDailyEntity $constructionDaily,
        Labor $labor,
        int $amount
    );

    public function addMaterial(
        ConstructionDailyEntity $constructionDaily,
        MaterialEntity $material,
        int $amount
    );

    public function getConstructionDaily(Project $project, Carbon $date);

    public function dailyMaterials(
        ConstructionDailyEntity $constructionDaily,
        MaterialEntity $material
    ): BelongsToMany;
}
