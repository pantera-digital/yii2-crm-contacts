<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model pantera\crm\contacts\models\Contact */
?>
<div class="contact-update">

    <?= $this->render('_form', [
        'model' => $model,
        'params' => $params,
    ]) ?>

</div>
