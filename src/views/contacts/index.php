<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use pantera\grid\widgets\materialGridView\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel pantera\crm\contacts\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="contact-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'striped'=>false,
            'columns' => require(__DIR__.'/_columns.php'),
            'toggleDataOptions'=>[
                'all' => [
                    'icon' => false,
                    'label' => '<i class="mdi mdi-unfold-more"></i>',
                    'class' => 'btn btn-link',
                    'title' => 'Show all data'
                ],
                'page' => [
                    'icon' => false,
                    'label' => '<i class="mdi mdi-unfold-less"></i>',
                    'class' => 'btn btn-link',
                    'title' => 'Show first page data'
                ],
            ],
            'export'=>[
                'icon' => false,
                'label' => '<i class="mdi mdi-file-download"></i>',
                'options' => [
                    'class' => 'btn btn-link',
                ]
            ],
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="mdi mdi-person-add"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new Contacts','class'=>'btn btn-link']).
                    Html::a('<i class="mdi mdi-refresh"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-link', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Contacts listing',
                //'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'footer'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="mdi mdi-delete mdi-inverse"></i>&nbsp; Delete All',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Are you sure?',
                                    'data-confirm-message'=>'Are you sure want to delete this item'
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
