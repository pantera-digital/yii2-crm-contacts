<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin() ?>
<?= Html::submitButton('Загрузить',['class' => 'btn btn-success btn-sm']) ?>
<?php $this->registerJs('$(\'[type="checkbox"]\').each(function(){ $(this).prop(\'checked\',true)})') ?>
<table class="table">
    <?php foreach ($data as $row): ?>
        <tr>
            <td>
                <?= $form->field($model,'clients[]')->checkbox(['value' => json_encode($row)])->label(false)?>
            </td>
            <?php foreach ($row as $col):?>
                <td><?=$col?></td>
            <?php endforeach;?>
        </tr>
    <?php endforeach; ?>
</table>
<?php ActiveForm::end() ?>
