<?php
use pantera\crm\contacts\models\Param;
use yii\helpers\Url;

$columns = [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'first_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'last_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'middle_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
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
    'urlCreator' => function($action, $model, $key, $index) {
        return Url::to([$action,'id'=>$key]);
    },
    'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
    'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
    'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
        'data-request-method'=>'post',
        'data-toggle'=>'tooltip',
        'data-confirm-title'=>'Are you sure?',
        'data-confirm-message'=>'Are you sure want to delete this item'],
];

return $columns;