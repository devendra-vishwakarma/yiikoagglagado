<?php
use yii\helpers\Html;

if (empty($cartItems)) {
    echo "<p>Your cart is empty.</p>";
} else {
    echo '<div class="container mt-4 d-flex gap-5 flex-wrap">';
    foreach ($cartItems as $item): ?>
        <div class="card mb-3" style="width: 18rem;">
            <img src="<?= Html::encode($item['image']) ?>" class="card-img-top p-5" alt="<?= Html::encode($item['name']) ?>">
            <div class="card-body">
                <h5 class="card-title"><?= Html::encode($item['name']) ?></h5>
                <p class="card-text">
                    Quantity: <?= Html::encode($item['quantity']) ?><br>
                    Price per unit: $<?= number_format(Html::encode($item['current_price']), 2) ?><br>
                    Total: $<?= number_format(Html::encode($item['current_price']) * Html::encode($item['quantity']), 2) ?>
                </p>
            </div>
        </div>
    <?php endforeach;
    echo '</div>';
}
