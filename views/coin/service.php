<?php
use yii\helpers\Html;
?>

<div class="container mt-4 d-flex gap-5 flex-wrap">
    <?php foreach ($coins as $coin): ?>
        <div class="card" style="width: 18rem; margin-bottom: 20px;">
            <img src="<?= Html::encode($coin['image']) ?>" class="card-img-top p-5" alt="<?= Html::encode($coin['name']) ?>" />
            <div class="card-body">
                <h5 class="card-title"><?= Html::encode($coin['name']) ?></h5>
                <p class="card-text">
                    Symbol: <?= Html::encode($coin['symbol']) ?><br>
                    Current Price: $<?= number_format(Html::encode($coin['current_price']), 2) ?><br>
                    Market Cap: $<?= number_format(Html::encode($coin['market_cap']), 0) ?><br>
                    24h Change: <span style="color: <?= $coin['price_change_percentage_24h'] > 0 ? 'green' : 'red' ?>;">
                        <?= Html::encode($coin['price_change_percentage_24h']) ?>%
                    </span>
                </p>
                <div class="d-flex align-item-center justify-content-around">
                    <div>
                        <a href="#" class="btn btn-success">Buy</a>
                    </div>
                    <div>
                        <a href="#" class="btn btn-danger">Sell</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>