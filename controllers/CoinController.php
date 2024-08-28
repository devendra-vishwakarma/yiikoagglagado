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


    public function actionService()
    {
        $coins = Coin::getDummyData();
        return $this->render('service', [
            "coins" => $coins,
        ]);
    }

    public function actionAddToCart($id)
    {
        Coin::addToCart($id);
        return $this->redirect(['viewcart']);
    }

    public function actionViewcart()
    {
        $cartItems = Coin::getCartItems();
        return $this->render('viewcart', [
            'cartItems' => $cartItems,
        ]);
    }
}
