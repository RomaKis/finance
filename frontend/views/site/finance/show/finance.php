<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model SumProvider */

use frontend\models\finance\Details;
use frontend\models\SumProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Finance';
$this->params['breadcrumbs'][] = $this->title;

$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => Details::getGroupedByDate()->getSumByDate(),

]);
?>
<div class="finances">
    <h1><?= Html::encode($this->title) ?></h1>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
            'date',
        [
            'header' => 'Sum <b>UAH</b>',
            'attribute' => 'sumUah',
        ],
        [
            'header' => 'Sum <b>USD</b>',
            'attribute' => 'sumUsd',
        ],
        [
            'class' => ActionColumn::className(),
            'header' => 'Actions',
            'headerOptions' => ['style' => 'color:#337ab7'],
            'template' => '{view}',
            'urlCreator' => function ($action, $model, $key, $index) {
                return Url::to(['finance-details', 'date' => $model->date]);
            }
        ],
        [
            'header' => 'Difference <b>UAH</b>',
            'attribute' => 'difference',
        ],
    ]
]);
?>
</div>
