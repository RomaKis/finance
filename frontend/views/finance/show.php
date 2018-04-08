<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */


use yii\bootstrap\ActiveForm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\finance\Rate;
use frontend\models\resource\finance\Rate as RateResource;

$this->title = 'Finance';
$this->params['breadcrumbs'][] = $this->title;
$finances = [];
$diff = 0;
foreach (\frontend\models\resource\Finance::find()->all() as $model) {
    $finance = new \frontend\models\Finance();
    $finance->date = $model->getAttribute('date');
    $finance->sumUah = $model->getAttribute('sum_uah');
    $finance->sumUsd = Rate::getSumUsd($model->getAttribute('sum_uah'), RateResource::UAH);
    $finance->difference = $model->getAttribute('sum_uah') - $diff;
    $diff = $finance->difference;

    $finances[] = $finance;
}

$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $finances,
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
                    return Url::to(['finance/details/show', 'date' => $model->date]);
                }
            ],
            [
                'header' => 'Diff with last',
                'attribute' => 'difference',
            ],
        ]
    ]);
    ?>
</div>
<div class="add-finance">
<?php $model = new \frontend\models\resource\Finance();
$model->date = date('Y-m-d');

?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'add-finance-form']); ?>

            <?= $form->field($model, 'date')->widget(yii\jui\DatePicker::className(), []); ?>

            <div class="form-group">
                <?= Html::submitButton('Add for the date', ['class' => 'btn btn-primary', 'name' =>
                    'add-finance-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
