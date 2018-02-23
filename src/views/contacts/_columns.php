<?php
use pantera\crm\contacts\models\Param;
use pantera\textAvatar\TextAvatarHelper;
use yii\helpers\Url;

$columns = [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
        'mergeHeader' => false,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'first_name',
        'format'=>'raw',
        'value'=>function($data){
            return '<span class="text-avatar gender-' . strtolower($data->gender) . '">' . TextAvatarHelper::generate($data->fullName) . '</span> ' . $data->fullName;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
        'format'=>'email',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header'=>'Параметры',
        'filter'=>'<input class="form-control" type="text"/>',
        'format'=>'raw',
        'value'=>function($data){
            $labels = [
                '<span class="label label-default">Постоянный клиент</span>',
                '<span class="label label-default">По рекомендации</span>',
                '<span class="label label-default">30-40 лет</span>',
            ];
            $labels2 = [
                '<span class="label label-success pull-right">Доволен</span>',
                '<span class="label label-warning pull-right">Недоволен</span>',
            ];
            unset($labels[rand(-1, 4)]);
            unset($labels2[rand(0, 1)]);
            return implode(' ', $labels) . implode(' ', $labels2);
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'birth_date',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'comment',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'gender',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'default_values',
    // ],
];

foreach (Param::find()->all() as $param) {
    $columns[] = [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'Params['.$param->id.']',
        'header' => $param->name,
        'value' => function($data) use ($param) {
            /** @var \pantera\crm\contacts\models\Contact $data */
            $record = $data->getParamsRegistry()->andWhere(['param_id' => $param->id])->one();
            if($record) {
                return $record->value;
            } else {
                return null;
            }
        }
    ];
}
$columns[] = [
    'class' => 'kartik\grid\ActionColumn',
    'dropdown' => false,
    'vAlign'=>'middle',
    'mergeHeader' => false,
    'width' => 'auto',
    'urlCreator' => function($action, $model, $key, $index) {
        return Url::to([$action,'id'=>$key]);
    },
    'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip','label'=>'<i class="mdi mdi-perm-identity"></i>'],
    'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip','label'=>'<i class="mdi mdi-edit"></i>'],
    'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
        'data-request-method'=>'post',
        'data-toggle'=>'tooltip',
        'data-confirm-title'=>'Are you sure?',
        'data-confirm-message'=>'Are you sure want to delete this item',
        'label'=>'<i class="mdi mdi-delete"></i>'],
];

return $columns;