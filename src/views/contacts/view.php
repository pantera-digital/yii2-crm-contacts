<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model pantera\crm\contacts\models\Contact */
?>
<div class="contact-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'middle_name',
            'phone',
            'email:email',
            'birth_date',
            'created_at',
            'comment:ntext',
            'gender',
            'default_values:ntext',
        ],
    ]) ?>

</div>
