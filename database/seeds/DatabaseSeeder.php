<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\MainflowType;
use App\Entities\DetailingflowType;
use App\Entities\CostType;
use App\Entities\Unit;

class DatabaseSeeder extends Seeder
{
    private $units = ['1. 公尺', '2. 平方公尺', '3. 立方公尺', '4. 公斤', '5. 公噸', '6. 工', '7. 小時', '8. 天', '9. 月', '10. 年', '11. 支', '12. 只', '13. 式', '14. 包', '15. 才', '16. 張', '17. 毫升', '18. 公升', '19. 加侖', '20. 處', '21. 部', '22. %', '23. 次', '24. 塊', '25. 片', '26. 扇', '27. 樘', '28. 付', '29. 組'];

    private $mainflowTypes = ['1. 基礎工程', '2. 結構工程', '3. 內外裝飾工程', '4. 地坪及屋頂防水層', '5. 其它及門窗工程'];

    private $detailingflowTypes = [
        ['1. 反循環基樁', '2. 預壘樁', '3. 中間柱H型鋼支柱', '4. H型鋼支撐', '5. 地下室抽水','6. 地下室挖土','7. 廢土棄運單程距離','8. 挖土、填土','9. 基礎伸縮縫'],
        ['1. 鋼筋', '2. 鋼結構', '3. 模板', '4. 混凝土', '5. 施工大型機具','6. 鷹架'],
        ['1. 砌磚', '2. 1:2水泥', '3. 1:3水泥', '4. 內牆磁磚', '5. 外牆磁磚', '6. 地坪屋頂'],
        ['1. 地坪', '2. 屋頂', '3. 地板'],
        ['1. 鋁窗', '2. 不鏽鋼', '3. 鐵捲門', '4. 隔牆', '5. 門', '6. 扶手']
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
