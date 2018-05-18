<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'importFile')->fileInput() ?>

<?= \yii\helpers\Html::submitButton('Загрузить',['class' => 'btn btn-success btn-sm']) ?>

<?php ActiveForm::end() ?>