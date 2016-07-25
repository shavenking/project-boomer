<?php

namespace App\Entities\Transformers;

use App\Entities\ProjectChecklist;
use League\Fractal\TransformerAbstract;

class ProjectChecklistTransformer extends TransformerAbstract
{
    public function transform(ProjectChecklist $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'seat' => $model->seat,
            'passes_amount' => (int) $model->passes_amount,
            'finished_at' => (string) $model->finished_at,
            'is_checked_finished' => !is_null($model->finished_at)
        ];
    }
}
