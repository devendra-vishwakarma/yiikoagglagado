<?php
// models/Coin.php
namespace app\models;

use yii\base\Model;

class Coin extends Model
{
    public $id;
    public $name;
    public $symbol;
    public $image;
    public $current_price;
    public $market_cap;
    public $price_change_percentage_24h;

    // Dummy data for demonstration
    public static function addToCart($coinId)
    {
        $session = \Yii::$app->session;
        $cart = $session->get('cart', []);

        if (!isset($cart[$coinId])) {
            $cart[$coinId] = 1; // Start with one item
        } else {
            $cart[$coinId]++; // Increment the quantity
        }

        $session->set('cart', $cart);
    }

    public static function getCartItems()
    {
        $session = \Yii::$app->session;
        $cart = $session->get('cart', []);
        $coins = self::getDummyData();
        $cartItems = [];

        foreach ($cart as $id => $quantity) {
            foreach ($coins as $coin) {
                if ($coin['id'] === $id) {
                    $coin['quantity'] = $quantity;
                    $cartItems[] = $coin;
                    break;
                }
            }
        }

        return $cartItems;
    }
    public static function getDummyData()
    {
        return [
            [
                'id' => 'bitcoin',
                'name' => 'Bitcoin',
                'symbol' => 'BTC',
                'image' => 'https://cryptologos.cc/logos/bitcoin-btc-logo.png',
                'current_price' => 35000,
                'market_cap' => 650000000000,
                'price_change_percentage_24h' => 2.5,
            ],
            [
                'id' => 'ethereum',
                'name' => 'Ethereum',
                'symbol' => 'ETH',
                'image' => 'https://cryptologos.cc/logos/ethereum-eth-logo.png',
                'current_price' => 2000,
                'market_cap' => 230000000000,
                'price_change_percentage_24h' => -1.3,
            ],
            [
                'id' => 'ripple',
                'name' => 'Ripple',
                'symbol' => 'XRP',
                'image' => 'https://cryptologos.cc/logos/xrp-xrp-logo.png',
                'current_price' => 0.6,
                'market_cap' => 30000000000,
                'price_change_percentage_24h' => 0.8,
            ],
            [
                'id' => 'litecoin',
                'name' => 'Litecoin',
                'symbol' => 'LTC',
                'image' => 'https://cryptologos.cc/logos/litecoin-ltc-logo.png',
                'current_price' => 100,
                'market_cap' => 7000000000,
                'price_change_percentage_24h' => -0.5,
            ],
            [
                'id' => 'cardano',
                'name' => 'Cardano',
                'symbol' => 'ADA',
                'image' => 'https://cryptologos.cc/logos/cardano-ada-logo.png',
                'current_price' => 0.3,
                'market_cap' => 10000000000,
                'price_change_percentage_24h' => 1.2,
            ],
            [
                'id' => 'polkadot',
                'name' => 'Polkadot',
                'symbol' => 'DOT',
                'image' => 'https://cryptologos.cc/logos/polkadot-new-dot-logo.png',
                'current_price' => 10,
                'market_cap' => 12000000000,
                'price_change_percentage_24h' => 0.4,
            ],
            [
                'id' => 'binancecoin',
                'name' => 'Binance Coin',
                'symbol' => 'BNB',
                'image' => 'https://cryptologos.cc/logos/binance-coin-bnb-logo.png',
                'current_price' => 300,
                'market_cap' => 45000000000,
                'price_change_percentage_24h' => 3.0,
            ],
            [
                'id' => 'chainlink',
                'name' => 'Chainlink',
                'symbol' => 'LINK',
                'image' => 'https://cryptologos.cc/logos/chainlink-link-logo.png',
                'current_price' => 7,
                'market_cap' => 3200000000,
                'price_change_percentage_24h' => -2.0,
            ],
            [
                'id' => 'dogecoin',
                'name' => 'Dogecoin',
                'symbol' => 'DOGE',
                'image' => 'https://cryptologos.cc/logos/dogecoin-doge-logo.png',
                'current_price' => 0.05,
                'market_cap' => 7000000000,
                'price_change_percentage_24h' => 1.5,
            ],
            [
                'id' => 'shiba-inu',
                'name' => 'Shiba Inu',
                'symbol' => 'SHIB',
                'image' => 'https://cryptologos.cc/logos/shiba-inu-shib-logo.png',
                'current_price' => 0.00001,
                'market_cap' => 4000000000,
                'price_change_percentage_24h' => 0.3,
            ],
        ];
    }
}
