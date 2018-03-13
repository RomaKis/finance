<?php
use frontend\models\resource\finance\Details;
use frontend\models\resource\finance\Rate;
use frontend\models\resource\finance\Source;
use frontend\models\resource\finance\Stock;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<table border="1" width="100%">
    <tr>
        <td>
            Id
        </td>
        <td>
            User id
        </td>
        <td>
            Stock Name
        </td>
        <td>
            Source Name
        </td>
        <td>
            Sum
        </td>
        <td>
            Currency
        </td>
        <td>
            Is Active
        </td>
        <td>
            Date
        </td>
    </tr>
    <?php foreach (Details::find()->all() as $existModel) { ?>
        <tr>
            <?php foreach ($existModel->attributes as $key => $attribute) { ?>
                <td>
                    <?php echo $attribute; ?>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>

</table>
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
