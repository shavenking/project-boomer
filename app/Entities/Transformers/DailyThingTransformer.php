<?php

namespace App\Entities\Transformers;

use League\Fractal\TransformerAbstract;
use Illuminate\Database\Eloquent\Model;
use App\Entities\ConstructionDaily;

class DailyThingTransformer extends TransformerAbstract
{
    protected $constructionDaily;

    public function __construct(ConstructionDaily $constructionDaily)
    {
        $this->constructionDaily = $constructionDaily;
    }

    public function transform(Model $model)
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
            'name' => $model->name,
            'amount' => (int) $model->pivot->amount,
            'work_date' => (string) $this->constructionDaily->work_date,
            'created_at' => (string) $model->pivot->created_at,
            'updated_at' => (string) $model->pivot->updated_at
        ];
    }
}
