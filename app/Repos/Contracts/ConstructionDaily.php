<?php

namespace App\Repos\Contracts;

use App\Entities\{
    ConstructionDaily as ConstructionDailyEntity,
    Project,
    ProjectWork,
    Subcontractor
};

interface ConstructionDaily
{
    public function create(\ArrayAccess $data, Project $project): ConstructionDailyEntity;

    public function addDailyWork(string $seat, Subcontractor $subcontractor, ProjectWork $work, ConstructionDailyEntity $constructionDaily);
}
