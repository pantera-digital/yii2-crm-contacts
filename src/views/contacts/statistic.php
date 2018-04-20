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
                <table class="table table-condensed table-bordered">
                    <tbody>
                    <?php foreach ($widgetData['labels'] as $key => $label):?>
                        <tr style="background:<?=$widgetData['datasets'][0]['backgroundColor'][$key]?>;opacity: 0.8;">
                            <th style="opacity: 1;">
                                <?=$label?>
                            </th>
                            <td style="opacity: 1;">
                                <?=$widgetData['datasets'][0]['data'][$key]?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach;?>
</div>

