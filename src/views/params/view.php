<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model pantera\crm\contacts\models\Param */
?>
<div class="param-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'group_id',
            'name',
        ],
    ]) ?>

</div>
