<?php
use frontend\models\finance\Details;
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
    <?php foreach (Details::findIdentitiesByUserId(Yii::$app->user->identity->getId()) as $financeModel) { ?>
        <tr>
            <?php foreach ($financeModel->attributes as $key => $attribute) { ?>
                <td>
                    <?php echo $attribute; ?>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>
