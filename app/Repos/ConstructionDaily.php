<?php

namespace App\Repos;

use App\Entities\{
    Appliance as ApplianceEntity, ConstructionDaily as ConstructionDailyEntity, Labor, Material as MaterialEntity, Project, ProjectWork, ProjectChecklist, Subcontractor
};
use App\Repos\Contracts\ConstructionDaily as Contract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ConstructionDaily implements Contract
{
    public function create(\ArrayAccess $data, Project $project): ConstructionDailyEntity
    {
        $constructionDaily = new ConstructionDailyEntity;
        $constructionDaily->setAttribute('inspection_record', $data['inspection_record'] ?? '');
        $constructionDaily->setAttribute('important_record', $data['important_record'] ?? '');
        $constructionDaily->setAttribute('work_date', $data['work_date']);

        return $project->constructionDailies()->save($constructionDaily);
    }

    public function addDailyWork(string $seat, Subcontractor $subcontractor, ProjectWork $work, ConstructionDailyEntity $constructionDaily)
    {
        $constructionDaily->works()->save($work, [
            'seat' => $seat,
            'subcontractor_id' => $subcontractor->id
        ]);

        // Create checklist
        if ($work->workflow && $work->workflow->checklist) {
            $checklist = $work->workflow->checklist;
            $checkitems = $checklist->checkitems;

            $checklist = ProjectChecklist::create(
                array_merge(
                    $checklist->toArray(),
                    [
                        'project_id' => $work->project_id,
                        'project_work_id' => $work->id,
                        'subcontractor_id' => $subcontractor->id,
                        'name' => $work->name,
                        'seat' => $seat,
                        'passes_amount' => 0
                    ]
                )
            );

            foreach ($checkitems as $checkitem) {
                $checklist->checkitems()->create($checkitem->toArray());
            }
        }
    }

    public function addLabor(
        ConstructionDailyEntity $constructionDaily,
        Labor $labor,
        int $amount
    ) {
        return $constructionDaily->labors()->attach(
            $labor,
            compact('amount')
        );
    }

    public function getConstructionDaily(Project $project, Carbon $date)
    {
        return (
            $project
                ->constructionDailies()
                ->whereDate('work_date', '=', $date)
                ->firstOrFail()
        );
    }

    public function dailyMaterials(
        ConstructionDailyEntity $constructionDaily,
        MaterialEntity $material
    ): BelongsToMany {
        return (
            $constructionDaily
                ->materials()
                ->wherePivot('material_id', $material->id)
        );
    }

    public function addMaterial(
        ConstructionDailyEntity $constructionDaily,
        MaterialEntity $material,
        int $amount
    ) {
        return $constructionDaily->materials()->attach(
            $material,
            compact('amount')
        );
    }

    public function addAppliance(
        ConstructionDailyEntity $constructionDaily,
        ApplianceEntity $appliance,
        int $amount
    ) {
        return $constructionDaily->appliances()->attach(
            $appliance,
            compact('amount')
        );
    }

    public function dailyAppliances(
        ConstructionDailyEntity $constructionDaily,
        ApplianceEntity $appliance
    ): BelongsToMany {
        return (
            $constructionDaily
                ->appliances()
                ->wherePivot('appliance_id', $appliance->id)
        );
    }
}
