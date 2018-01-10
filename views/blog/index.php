<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <!--<h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/ // нумерация строк
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {check}',
                'buttons' => 
                    [
                        /*'update' => function ($url, $model, $key) {
                            return Html::a('Обновить', $url); // меняем аконку на слово
                        },*/
                        'check' => function ($url, $model, $key) { // меняем иконку на другую 
                            return Html::a('<i class="fa fa-check" aria-hidden="true"></i>', $url);
                        },
                    ],
                'visibleButtons' => [
                    'check' => function ($model, $key, $index) {// меняем иконку на другую 
                        return ($model->status_id == 1) ? false : true;
                    }   
                ]
            ],
            'id',
            'title',
            'text:ntext',
            /*'url:url',*/
            [
                'attribute'=>'url',
                'format'=>'url',
                'headerOptions'=>['class'=>'adasdasd'],
            ],
            [
                'attribute'=>'status_id',
                'filter'=>\macsly\blogger\models\Blog::STATUS_LIST,
                'value'=>'statusName'
            ],
            'sort',
            'smallImage:image',
            'date_create:datetime',
            'date_update',
            [
                'attribute'=>'tags',
                'value'=>'TagsAsString'
            ],
            
        ],
    ]); ?>
<?php Pjax::end(); ?></div>





