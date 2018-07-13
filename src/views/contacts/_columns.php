<?php
use kartik\select2\Select2;
use pantera\crm\contacts\components\grid\TagsGridColumn;
use pantera\crm\contacts\models\Param;
use pantera\textAvatar\TextAvatarHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * @var \pantera\crm\contacts\models\ContactSearch $searchModel
 */
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
        'class'=> TagsGridColumn::class,
        'filter' => Select2::widget([
            'data' => ArrayHelper::map(Param::find()->all(),'id','name','groupName'),
            'model' => $searchModel,
            'pjaxContainerId' => 'crud-datatable-pjax',
            'attribute' => 'tags',
            'options' => [
                'placeholder' => 'Укажите теги',
                'multiple' => true
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]),
    ],
    [
        'header' => 'Визиты',
        'value' => function($data) {
            return $data->getVisits()->count() ?: 0;
        }
    ],
    [
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
/*
foreach (Param::find()->all() as $param) {
    $columns[] = [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'Params['.$param->id.']',
        'header' => $param->name,
        'value' => function($data) use ($param) {
            /** @var \pantera\crm\contacts\models\Contact $data */
/*
            $record = $data->getParamsRegistry()->andWhere(['param_id' => $param->id])->one();
            if($record) {
                return $record->value;
            } else {
                return null;
            }
        }
    ];
}
*/
return $columns;