<?php
// controllers/CoinController.php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Coin;

class CoinController extends Controller
{
    public function actionPage()
    {
        $coins = Coin::getDummyData();
        return $this->render('page', [
            'coins' => $coins,
        ]);
    }
}
