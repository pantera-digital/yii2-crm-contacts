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
    .crm-contacts-form textarea.form-control {height: 100px; min-height: 0;}
    .crm-contacts-form .required .control-label:after {
        content: " *";
        color: red;
        position: relative;
        top: -2px;
    }
    .crm-contacts-form .form-group {margin-bottom: 7px;}
    .crm-contacts-form .control-label {font-weight: 500;}
    .crm-contacts-form .input-group {max-width: 250px;}
    .crm-contacts-form .panel-body {
        padding: 40px 30px 10px;
    }
    .crm-contacts-form .form-control {
        border: 0 none;
        box-shadow: none !important;
        border-bottom: 1px solid #ccc;
        border-radius: 0;
        padding-left: 0;
    }
    .crm-contacts-form .input-group-addon {
        border: 0 none;
        background: transparent !important;
        padding-left: 0;
    }
    .crm-contacts-form .help-block {font-size: 12px;}
    .crm-contacts-form .divider {height: 2em;}
    .crm-contacts-form .form-actions {
        position: sticky;
        bottom: 0;
        padding: 15px 0;
        background: #f7f7f7;
        z-index: 100;
        margin-top: -15px;
    }
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
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>{input}</div>',
    ])->textInput(['maxlength' => true, 'placeholder' => 'mail@mail.ru']) ?>

    <div class="divider"></div>
    <?php if(0):?>
        <?= $form->field($model, 'birth_date')->widget(\kartik\date\DatePicker::className(),[
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd'
            ],
        ]) ?>
    <?php endif;?>
    <?= $form->field($model, 'birth_date')->textInput()?>
    <?= $form->field($model, 'comment')->textarea(['placeholder'=>'Дополнительные сведения о контакте']) ?>
    <?php
    $groupedParams = [];
    foreach ($params as $param) {
        if($param->group) {
            $groupedParams[$param->group->name][] = $param;
        } else {
            $groupedParams['Без группы'][] = $param;
        }
    }
    ?>
    <?php if ($params): ?>
        <?php foreach($groupedParams as $group_name => $groupParams):?>
            <div class="h4"><?=$group_name?></div>
            <?php foreach ($groupParams as $param):?>
                <div class="form-group">
                    <div class="control-label col-sm-4">
                        <?=$param->name?>
                    </div>

                    <div class="col-sm-8">
                        <?=$form->field($model,'Params['.$param->id.']')->dropDownList($param->getValues())->label(false)?>
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
                    </div>
                </div>
            <?php endforeach;?>
        <?php endforeach;?>

    <?php endif;?>
    <?php ActiveForm::end(); ?>

</div>
