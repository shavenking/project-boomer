<?php

namespace App\Repos\Contracts;

use App\Entities\{
    ConstructionDaily as ConstructionDailyEntity,
    Labor,
    Project,
    ProjectWork,
    Subcontractor
};
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

interface ConstructionDaily
{
    public function create(\ArrayAccess $data, Project $project): ConstructionDailyEntity;

    public function addDailyWork(string $seat, Subcontractor $subcontractor, ProjectWork $work, ConstructionDailyEntity $constructionDaily);

    public function addLabor(
        ConstructionDailyEntity $constructionDaily,
        Labor $labor,
        int $amount
    );

    public function getConstructionDaily(Project $project, Carbon $date);
}
