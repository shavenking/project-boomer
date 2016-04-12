<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\{ Project, Workflow, DetailingflowType };

class TestDataSeeder extends Seeder
{
    private $projects = ['尊安家', '捲尾家', '全家就是你家'];

    /**
     * detailingflow_type_id => name
     */
    private $workflows = [
        '預壘樁擋土',
        '鋼筋混凝土結構體放樣'
    ];

    private $workflowNodes = [
        ['障礙物處理', '放樣', '鑽頭尺寸及鑽桿垂直度', '預壘樁施工順序', '鑽孔深度', '預壘樁砂漿配比', '鑽頭與砂漿之重疊', '灌漿之壓力', '灌漿之中斷時間', '吊放鋼筋蘢'],
        ['鋼板樁放樣', '打入鋼板樁', '土方完成面', 'P.C.面', 'R.C.面', '放樣施工圖', '放樣基準線', '四周側模水平木押條', '模板面高程', '各結構部位放樣位置（混凝土面上）', '各結構部位，模板組立位置（模板面上）', '樓梯平台模板']
    ];

    private $checkitemSets = [
        [
            ['地上地下架線、埋設物有檔案資料記載按項清除'],
            ['依設計圖說尺寸檢測'],
            ['依設計圖說尺寸、鑽桿之垂直檢測'],
            ['跳樁施工'],
            ['鑽桿入土深度，依設計圖說指示'],
            ['a. 水泥：以磅秤量測 120kg ...略'],
            ['灌入砂漿量與拔出鑽桿長度重疊約 50cm'],
            ['依壓力錶 21 公斤/平方公分'],
            ['因拆裝鑽桿灌漿中斷時間不得超過 3 公尺'],
            ['地面以固定器固定鋼筋位置']
        ],
        [
            ['以經緯儀、捲尺測出，如有誤差隨時改正'],
            ['以經緯儀、垂球測出尺寸，最大誤差值不可大於預留間隙 5cm '],
            ['使用水準儀、捲尺、設計圖說規定誤差正負 3cm'],
            ['使用水準儀、捲尺、設計圖說規定誤差正負 1cm'],
            ['使用水準儀、捲尺、設計圖說規定誤差正負 1cm'],
            ['依設計圖說尺寸，不得有任何誤差'],
            ['使用經緯儀、捲尺，如有誤差隨時改正'],
            ['若有遺漏立即補釘'],
            ['建築物最遠兩端高程差正 2cm 以內', '清水模板任何 3 公尺範圍，誤差小於等於 0.7cm'],
            ['自基準墨線，以捲尺量測各結構體部位，依設計圖說尺寸，誤差為正負 0.5cm'],
            ['自基準墨線，以捲尺量測各結構體部位，模板組立尺寸內牆、內柱、內樑，誤差為正負 1.0cm', '自基準墨線，以捲尺量測各結構體部位，模板組立尺寸內牆、內柱、內樑，誤差為正負 0.6cm'],
            ['用捲尺量出設計圖說尺寸，誤差正負 1.0cm'],
        ]
    ];

    private $works = [
        [
            [
                'detailingflow_type_id' => '2',
                'name' => '預壘樁（25 cm）',
                'amount' => 1,
                'unit_price' => 135 * 7 + 2200,
                'unit_id' => 1,
                'workitems' => [
                    [
                        'unit_id' => 14,
                        'cost_type_id' => 2,
                        'name' => '水泥',
                        'amount' => 7,
                        'unit_price' => 135
                    ],
                    [
                        'unit_id' => 6,
                        'cost_type_id' => 3,
                        'name' => '鋼筋工',
                        'amount' => 1,
                        'unit_price' => 2200
                    ]
                ]
            ],
            [
                'detailingflow_type_id' => '2',
                'name' => '預壘樁（30 cm）',
                'amount' => 1,
                'unit_price' => 135 * 10 + 2200,
                'unit_id' => 1,
                'workitems' => [
                    [
                        'unit_id' => 14,
                        'cost_type_id' => 2,
                        'name' => '水泥',
                        'amount' => 10,
                        'unit_price' => 135
                    ],
                    [
                        'unit_id' => 6,
                        'cost_type_id' => 3,
                        'name' => '鋼筋工',
                        'amount' => 1,
                        'unit_price' => 2200
                    ]
                ]
            ]
        ],
        [
            [
                'detailingflow_type_id' => '10',
                'name' => '1:4:8 混凝土',
                'amount' => 1,
                'unit_price' => 135 * 3 + 1800,
                'unit_id' => 3,
                'workitems' => [
                    [
                        'unit_id' => 14,
                        'cost_type_id' => 2,
                        'name' => '水泥',
                        'amount' => 3,
                        'unit_price' => 135
                    ],
                    [
                        'unit_id' => 6,
                        'cost_type_id' => 3,
                        'name' => '小工',
                        'amount' => 1,
                        'unit_price' => 1800
                    ]
                ]
            ],
            [
                'detailingflow_type_id' => '10',
                'name' => '1:2:4 混凝土',
                'amount' => 1,
                'unit_price' => 135 * 6 + 1800,
                'unit_id' => 3,
                'workitems' => [
                    [
                        'unit_id' => 14,
                        'cost_type_id' => 2,
                        'name' => '水泥',
                        'amount' => 6,
                        'unit_price' => 135
                    ],
                    [
                        'unit_id' => 6,
                        'cost_type_id' => 3,
                        'name' => '小工',
                        'amount' => 1,
                        'unit_price' => 1800
                    ]
                ]
            ]
        ]
    ];

    public function run()
    {
        Model::unguard();

        $this->seedProjects();
        $this->seedWorkflows();

        Model::reguard();
    }

    private function seedProjects()
    {
        foreach ($this->projects as $project) {
            Project::create([
                'name' => $project
            ]);
        }
    }

    private function seedWorkflows()
    {
        foreach ($this->workflows as $workflowIdx => $name) {
            $workflow = Workflow::create([
                'name' => $name
            ]);

            $checklist = $workflow->checklist()->create([
                'name' => $name
            ]);

            foreach ($this->works[$workflowIdx] as $work) {
                $newWork = $workflow->works()->create(array_except($work, 'workitems'));

                foreach ($work['workitems'] as $workitem) {
                    $newWork->items()->create($workitem);
                }
            }


            foreach ($this->workflowNodes[$workflowIdx] as $idx => $title) {
                $workflow->nodes()->create([
                    'order' => $idx + 1,
                    'title' => $title
                ]);

                foreach ($this->checkitemSets[$workflowIdx][$idx] as $detail) {
                    $checklist->checkitems()->create([
                        'name' => $title,
                        'detail' => $detail
                    ]);
                }
            }
        }
    }
}
