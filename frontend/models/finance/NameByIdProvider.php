<?php

namespace frontend\models\finance;

use frontend\models\resource\finance\Source;
use frontend\models\resource\finance\Stock;

class NameByIdProvider
{
    public static function getStockNameById($id)
    {
        $stock = new Stock();
        $stock = $stock->findIdentity(['id' => $id]);

        return $stock->getAttribute('name');
    }

    public static function getSourceNameById($id)
    {
        $source = new Source();
        $source = $source->findIdentity(['id' => $id]);

        return $source->getAttribute('name');
    }
}
