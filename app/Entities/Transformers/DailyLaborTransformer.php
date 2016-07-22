<?php

namespace App\Entities\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\{
    ConstructionDaily,
    Labor
};

class DailyLaborTransformer extends TransformerAbstract
{
    protected $constructionDaily;

    public function __construct(ConstructionDaily $constructionDaily)
    {
        $this->constructionDaily = $constructionDaily;
    }

    public function transform(Labor $labor)
    {
        if (is_null($labor->getRelation('pivot'))) {
            throw new \Exception;
        }

        if (
            $labor->pivot->construction_daily_id
            !== $this->constructionDaily->id
        ) {
            throw new \Exception;
        }

        return [
            'id' => $labor->pivot->id,
            'name' => $labor->name,
            'amount' => (int) $labor->pivot->amount,
            'work_date' => (string) $this->constructionDaily->work_date,
            'created_at' => (string) $labor->pivot->created_at,
            'updated_at' => (string) $labor->pivot->updated_at
        ];
    }
}
