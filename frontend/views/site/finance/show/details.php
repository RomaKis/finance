<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model Details */

use frontend\models\finance\Details;
use frontend\models\finance\Rate;
use yii\helpers\Html;

$this->title = 'Finance';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finances">
    <h1><?= Html::encode($this->title) ?></h1>
    <table border="1" width="100%">
        <tr>
            <td>
                Id
            </td>
            <td>
                User id
            </td>
            <td>
                Stock
            </td>
            <td>
                Source
            </td>
            <td>
                Sum
            </td>
            <td>
                Currency
            </td>
        </tr>
        <?php foreach (Details::findIdentitiesByFinanceId(Yii::$app->request->get('id')) as $financeModel) { ?>
            <tr>
                <?php
                $sum = 0;
                $currency = 0;
                ?>
                <?php foreach ($financeModel->attributes as $key => $attribute) { ?>
                    <td>
                        <?php echo $attribute; ?>
                        <?php
                        if ($key == "currency") {
                            $currency = $attribute;
                        } elseif ($key == "sum") {
                            $sum = $attribute;
                        }
                        ?>
                    </td>
                <?php } ?>
            </tr>
            <?php $sumCurrencies[] = ['sum' => $sum, 'currency' => $currency];
        } ?>
    </table>
    <br>
    <table border="1" width="100%">
        <tr>
            <td>SUM</td>
            <td>
                <?php
                $sum = 0;
                foreach ($sumCurrencies as $sumCurrency) {
                    if ($sumCurrency['currency'] !== Rate::UAH) {
                        $kurs = Rate::findIdentitiesByCurrency($sumCurrency['currency']);
                        $currentSum = $sumCurrency['sum'] * $kurs->getAttribute('coefficient');
                        $sum += $currentSum;
                    } else {
                        $sum += $sumCurrency['sum'];
                    }
                }
                echo $sum;
                ?>
            </td>
            <td>
                UAH
            </td>
        </tr>
        <tr>
            <td>SUM</td>
            <td>
                <?php
                $coefficient = Rate::findIdentitiesByCurrency('USD')->getAttribute('coefficient');
                echo($sum / $coefficient);
                ?>
            </td>
            <td>
                USD
            </td>
        </tr>
    </table>
</div>
