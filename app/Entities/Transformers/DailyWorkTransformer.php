<?php

namespace App\Entities\Transformers;

use App\Entities\ProjectWork;
use App\Entities\Subcontractor;
use League\Fractal\TransformerAbstract;
use App\Entities\ConstructionDaily;

class DailyWorkTransformer extends TransformerAbstract
{
    protected $constructionDaily;

    protected $defaultIncludes = ['subcontractor', 'projectChecklist'];

    public function __construct(ConstructionDaily $constructionDaily)
    {
        $this->constructionDaily = $constructionDaily;
    }

    public function transform(ProjectWork $model)
    {
        if (is_null($model->getRelation('pivot'))) {
            throw new \Exception;
        }

        if (
            $model->pivot->construction_daily_id
            !== $this->constructionDaily->id
        ) {
            throw new \Exception;
        }

        return [
            'id' => $model->pivot->id,
            'seat' => $model->pivot->seat,
            'name' => $model->name
        ];
    }

    public function includeSubcontractor(ProjectWork $model)
    {
        $subcontractor = Subcontractor::findOrFail(
            $model->pivot->subcontractor_id
        );

        return $this->item(
            $subcontractor, new SubcontractorTransformer, 'subcontractor'
        );
    }

    public function includeProjectChecklist(ProjectWork $model)
    {
        $projectChecklist = (
            $model->checklists()->whereSeat($model->pivot->seat)->firstOrFail()
        );

        return $this->item(
            $projectChecklist,
            new ProjectChecklistTransformer,
            'project_checklist'
        );
    }
}
