<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use pantera\crm\contacts\models\ParamGroup;

/* @var $this yii\web\View */
/* @var $model pantera\crm\contacts\models\Param */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="param-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_id')->dropDownList(ArrayHelper::map(ParamGroup::find()->all(), 'id', 'name'), ['prompt' => '--']) ?>

    <?= $form->field($model, 'default_values')->textarea() ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
