<?php

use common\modules\crm\models\eav\ClientParams;
use kartik\select2\Select2;
use pantera\crm\contacts\models\Param;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\crm\models\CrmContacts */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .crm-contacts-form .form-horizontal .control-label {text-align: left;}
</style>
<div class="crm-contacts-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',
                'wrapper' => 'col-sm-8',
            ]
        ]
    ]); ?>
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'gender')->dropDownList($model->getGenders()) ?>

    <div class="divider"></div>


    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7 (999) 999-99-99',
    ]) ?>

    <?= $form->field($model, 'email', [
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope fa-fw"></i></span>{input}</div>',
    ])->textInput(['maxlength' => true, 'placeholder' => 'mail@mail.ru']) ?>

    <div class="divider"></div>
    <?= $form->field($model, 'birth_date')->widget(\kartik\date\DatePicker::className(),[
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd'
        ],
    ]) ?>
    <?= $form->field($model, 'comment')->textarea(['placeholder'=>'Дополнительные сведения о контакте']) ?>
    <?php
    $groupedParams = [];
    foreach ($params as $param) {
        if($param->group) {
            $groupedParams[$param->group->name][] = $param;
        } else {
            $groupedParams['Дополнительные параметры'][] = $param;
        }
    }
    ?>

    <?php if ($params): ?>
        <?php foreach($groupedParams as $group_name => $groupParams):?>
            <div class="h4"><?=$group_name?></div>
            <hr/>
            <?php foreach ($groupParams as $param):?>
                <?=$form->field($model,'Params['.$param->id.']')->dropDownList($param->getValues())->label($param->name)?>
                <?php if(0):?>
                    <?= Select2::widget([
                        'data' => ArrayHelper::map($param->getValues(),'name','name'),
                        'name' => "Params[".$paramId."]",
                        'pluginOptions' => [
                            'tags' => true,
                            'allowClear' => true,
                        ],
                        'options' => [
                            'prompt' => 'Выберите значение или укажите новое',
                        ],
                        'value' => empty($registry->param) ? (empty($registry->value_varchar) ? null : $registry->value_varchar) : @$registry->value_varchar,
                    ])?>
                <?php endif;?>
            <?php endforeach;?>
        <?php endforeach;?>
    <?php endif;?>

    <?php ActiveForm::end(); ?>

</div>
