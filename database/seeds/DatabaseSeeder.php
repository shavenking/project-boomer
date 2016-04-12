<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\MainflowType;
use App\Entities\DetailingflowType;
use App\Entities\CostType;
use App\Entities\Unit;

class DatabaseSeeder extends Seeder
{
    private $units = [1 => '公尺', '平方公尺', '立方公尺', '公斤', '公噸', '工', '小時', '天', '月', '年', '支', '只', '式', '包', '才', '張', '毫升', '公升', '加侖', '處', '部', '%', '次', '塊', '片', '扇', '樘', '付', '組'];

    private $mainflowTypes = ['基礎工程', '結構工程', '內外裝飾工程', '地坪及屋頂防水層', '其它及門窗工程'];

    private $detailingflowTypes = [
        ['反循環基樁', '預壘樁', '中間柱H型鋼支柱', 'H型鋼支撐', '地下室抽水','地下室挖土','廢土棄運單程距離','挖土、填土','基礎伸縮縫'],
        ['鋼筋', '鋼結構', '模板', '混凝土', '施工大型機具','鷹架'],
        ['砌磚', '1:2水泥', '1:3水泥', '內牆磁磚', '外牆磁磚', '地坪屋頂'],
        ['地坪', '屋頂', '地板'],
        ['鋁窗', '不鏽鋼', '鐵捲門', '隔牆', '門', '扶手']
    ];

    private $costTypes = ['工料（ S ）', '材料（ M ）', '工資（ L ）', '其它（ R ）'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->seedFlowTypes();
        $this->seedUnits();
        $this->seedCostTypes();

        $this->call(TestDataSeeder::class);

        Model::reguard();
    }

    private function seedFlowTypes()
    {
        $rows = array_map(function ($mainflowType, $detailingflowTypes) {
            $mainflowType = MainflowType::create(['name' => $mainflowType]);

            foreach ($detailingflowTypes as $detailingflowType) {
                DetailingflowType::create([
                    'mainflow_type_id' => $mainflowType->id,
                    'name' => $detailingflowType
                ]);
            }
        }, $this->mainflowTypes, $this->detailingflowTypes);

    }

    private function seedUnits()
    {
        foreach ($this->units as $unit) {
            Unit::create(['name' => $unit]);
        }
    }

    public function seedCostTypes()
    {
        foreach ($this->costTypes as $costType) {
            CostType::create(['name' => $costType]);
        }
    }
}
