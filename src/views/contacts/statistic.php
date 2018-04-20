<?php
/**
 * @var array $widgetsData
 * @var \yii\web\View $this
 */
use dosamigos\chartjs\ChartJs;
use pantera\crm\contacts\models\Param;

$this->title = "Статистика контактов";
$this->params['breadcrumbs'][] = ['url' => ['/contacts/contacts/index'], 'label' => 'Контакты'];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <?php foreach ($widgetsData as $groupId => $widgetData):?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=\pantera\crm\contacts\models\ParamGroup::findOne($groupId)->name;?>
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
                                <?=\yii\helpers\Html::a($label,['/contacts/contacts/index','ContactSearch' => [
                                     'tags' => [Param::findOne(['group_id' => $groupId, 'name' => $label])->id],
                                ]])?>
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

