<?php
/**
 * @var array $widgetsData
 */
use dosamigos\chartjs\ChartJs;
?>
<div class="row">
    <?php foreach ($widgetsData as $key => $widgetData):?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=\pantera\crm\contacts\models\ParamGroup::findOne($key)->name;?>
                </div>
                <div class="panel-body">
                    <?= ChartJs::widget([
                        'type' => 'pie',
                        'options' => [
                            'height' => 135,
                            'width' => 400
                        ],
                        'data' => $widgetData
                    ]);
                    ?>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>

