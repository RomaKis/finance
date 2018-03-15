<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model Details */

use frontend\models\finance\Details;
use frontend\models\finance\NameByIdProvider;
use frontend\models\resource\finance\Details as ResourceDetails;
use yii\grid\GridView;

$this->title = 'Details';
$this->params['breadcrumbs'][] = $this->title;
$dataProviderSum = new \yii\data\ArrayDataProvider([
    'allModels' => Details::getGroupedByDate()->getSumByDate(Yii::$app->request->get('date')),

]);

$gridViewSum =  GridView::widget([
    'dataProvider' => $dataProviderSum,
    'summary' => '',
    'columns' => [
        [
            'header' => '<b>UAH</b>',
            'attribute' => 'sumUah',
        ],
        [
            'header' => '<b>USD</b>',
            'attribute' => 'sumUsd',
        ],
    ]
]);

$dataProviderActiveSum = new \yii\data\ArrayDataProvider([
    'allModels' => Details::getActiveGroupedByDate()->getSumByDate(Yii::$app->request->get('date')),
]);

$gridViewActiveSum =  GridView::widget([
    'dataProvider' => $dataProviderActiveSum,
    'summary' => '',
    'columns' => [
        [
            'header' => '<b>UAH</b>',
            'attribute' => 'sumUah',
        ],
        [
            'header' => '<b>USD</b>',
            'attribute' => 'sumUsd',
        ],
    ]
]);

$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => ResourceDetails::findIdentitiesByDate(Yii::$app->request->get('date')),

]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'showFooter' => true,
    'columns' => [
        'id',
        'user_id',
        [
            'label' => 'Stock Name',
            'value' => function ($model) {
                $nameById = new NameByIdProvider();

                return $nameById->getStockNameById($model->getAttribute('stock_id'));
            }
        ],
        [
            'label' => 'Source Name',
            'value' => function ($model) {
                $nameById = new NameByIdProvider();

                return $nameById->getSourceNameById($model->getAttribute('source_id'));
            }
        ],
        [
            'attribute' => 'sum',
            'footer' => $gridViewSum
        ],
        'currency',
        [
            'attribute' => 'is_active',
            'footer' => $gridViewActiveSum
        ],
        'date',
    ]
]);
?>
