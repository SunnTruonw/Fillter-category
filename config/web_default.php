<?php
    return [
        'frontend'=>[
            'noImage'=>'/frontend/images/noimage.jpg',
            'userNoImage'=>'/frontend/images/usernoimage.png',
        ],
        'backend'=>[
            'noImage'=>'/admin_asset/images/noimage.png',
            'userNoImage'=>'/admin_asset/images/usernoimage.png',
        ],
        'priceSearch' =>[
            1=>[
                'value'=>1,
                'start'=>0,
                'end'=>500000,
                'name'=>'Dưới 500 nghìn'
            ],
            2=>[
                'value'=>2,
                'start'=>500000,
                'end'=>1000000,
                'name'=>'Từ 500 nghìn - 1 triệu'
            ],
            3=>[
                'value'=>3,
                'start'=>1000000,
                'end'=>3000000,
                'name'=>'Từ 1 triệu - 3 triệu'
            ],
            4=>[
                'value'=>4,
                'start'=>3000000 ,
                'end'=>5000000,
                'name'=>'Từ 3 triệu - 5 triệu'
            ],
            5=>[
                'value'=>5,
                'start'=>5000000 ,
                'end'=>10000000,
                'name'=>'Từ 5 triệu - 10 triệu'
            ],
            6=>[
                'value'=>6,
                'start'=>10000000 ,
                'end'=>20000000,
                'name'=>'Từ 10 triệu - 20 triệu'
            ],
            7=>[
                'value'=>7,
                'start'=>20000000 ,
                'end'=>50000000,
                'name'=>'Từ 20 triệu - 50 triệu'
            ],
            8=>[
                'value'=>8,
                'start'=>50000000 ,
                'end'=>null,
                'name'=>'Trên 50 triệu'
            ],
        ],
    ];
?>
