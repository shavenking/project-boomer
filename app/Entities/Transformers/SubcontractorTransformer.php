<?php

namespace App\Entities\Transformers;

use App\Entities\Subcontractor;
use League\Fractal\TransformerAbstract;

class SubcontractorTransformer extends TransformerAbstract
{
    public function transform(Subcontractor $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name
        ];
    }
}
