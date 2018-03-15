<?php

use frontend\models\finance\NameByIdProvider;
use frontend\models\resource\finance\Details;
use frontend\models\resource\finance\Rate;
use frontend\models\resource\finance\Stock;
use kartik\depdrop\DepDrop;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

$this->title = 'Add Details';
$this->params['breadcrumbs'][] = $this->title;
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

$currencyArray = [];
foreach (Rate::find()->all() as $rate) {
    $currencyArray[$rate->getAttribute('currency')] = $rate->getAttribute('currency');
}
$model->date = date('Y-m-d')
?>
<?= $form->field($model, 'stockId')->dropDownList($stockArray,
    [
        'id' => 'stock_id',
        'prompt'=>'- Select  -',
    ]
) ?>

<?= $form->field($model, 'sourceId')->widget(DepDrop::classname(), [
    'options' => ['id' => 'source_id'],
    'value' => 1,
    'pluginOptions' => [
        'depends' => ['stock_id'],
        'placeholder' => '',
        'url' => Url::to(['get-sources-by-stock-id']),
    ]
]);
?>

<?= $form->field($model, 'sum')->textInput() ?>

<?= $form->field($model, 'currency')->dropDownList($currencyArray) ?>

<?= $form->field($model, 'date')->widget(yii\jui\DatePicker::className(), []); ?>

<?= $form->field($model, 'isActive')->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'source-button']) ?>
</div>

<?php ActiveForm::end(); ?>
