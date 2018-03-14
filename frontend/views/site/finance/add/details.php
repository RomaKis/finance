<?php

use frontend\models\finance\NameByIdProvider;
use frontend\models\resource\finance\Details;
use frontend\models\resource\finance\Rate;
use frontend\models\resource\finance\Source;
use frontend\models\resource\finance\Stock;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
?>
<h3>Existing Finances</h3>
<?php
$dataProvider = new ActiveDataProvider([
    'query' => Details::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
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
        'sum',
        'currency',
        'is_active',
        'date',
    ]
]);
?>

<h3>Add Finance</h3>

<?php $form = ActiveForm::begin(['id' => 'source-form']); ?>

<?php
$stockArray = [];
foreach (Stock::find()->all() as $stock) {
    $stockArray[$stock->getAttribute('id')] = $stock->getAttribute('name');
}

$sourceArray = [];
foreach (Source::find()->all() as $source) {
    $sourceArray[$source->getAttribute('id')] = $source->getAttribute('name');
}

$currencyArray = [];
foreach (Rate::find()->all() as $rate) {
    $currencyArray[$rate->getAttribute('currency')] = $rate->getAttribute('currency');
}
?>
<?= $form->field($model, 'stockId')->dropDownList($stockArray) ?>

<?= $form->field($model, 'sourceId')->dropDownList($sourceArray) ?>

<?= $form->field($model, 'sum')->textInput() ?>

<?= $form->field($model, 'currency')->dropDownList($currencyArray) ?>

<?= $form->field($model, 'isActive')->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'source-button']) ?>
</div>

<?php ActiveForm::end(); ?>
