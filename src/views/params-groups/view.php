<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model pantera\crm\contacts\models\ParamGroup */
?>
<div class="param-group-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
