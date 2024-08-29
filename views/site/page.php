<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

function formatCurrency($value, $currency = '$')
{
    return $currency . number_format($value, 2);
}

$this->title = 'Cryptocurrency Prices by Market Cap';
?>

<div class="container">
    <div class="sidebar d-flex flex-column align-item-center text-center">
        <h2>Sidebar</h2>
        <ul>
            <li class="mb-4 mt-5"><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Home</a></li>
            <li class="mb-4"><a href="<?= \yii\helpers\Url::to(['/coin/page']) ?>">CryptoCoins</a></li>
            <li class="mb-4"><a href="<?= \yii\helpers\Url::to(['/coin/service']) ?>">Service</a></li>
            <li class="mb-4"><a href="<?= \yii\helpers\Url::to(['/coin/page']) ?>">Contact-Us</a></li>
            <li class="mb-4"><a href="<?= \yii\helpers\Url::to(['/coin/page']) ?>">Setting</a></li>
            <li class="mb-4"><a href="<?= \yii\helpers\Url::to(['/coin/page']) ?>">Profile</a></li>
            <!-- Add more sidebar items as needed -->
        </ul>
    </div>

    <div class="main-content">
        <h1><?= Html::encode($this->title) ?></h1>

        <input type="text" id="search" placeholder="Search For a Crypto Currency"
            style="width: 100%; margin-bottom: 20px;" />

        <table class="table">
            <thead>
                <tr>
                    <th>Coin</th>
                    <th>Price</th>
                    <th>24h Change</th>
                    <th>Market Cap</th>
                    <th>Favorite</th>
                </tr>
            </thead>
            <tbody id="coinTable">
                <?php foreach ($coins as $coin): ?>
                    <tr>
                        <td>
                            <img src="<?= Html::encode($coin['image']) ?>" alt="<?= Html::encode($coin['name']) ?>" height="50" />
                            <div>
                                <strong><?= Html::encode($coin['symbol']) ?></strong>
                                <div><?= Html::encode($coin['name']) ?></div>
                            </div>
                        </td>
                        <td><?= formatCurrency($coin['current_price']) ?></td>
                        <td style="color: <?= $coin['price_change_percentage_24h'] > 0 ? 'green' : 'red' ?>;">
                            <?= ($coin['price_change_percentage_24h'] > 0 ? '+' : '') . number_format($coin['price_change_percentage_24h'], 2) ?>%
                        </td>
                        <td><?= formatCurrency($coin['market_cap']) ?></td>
                        <td>
                            <button class="favorite-button" data-id="<?= Html::encode($coin['id']) ?>">❤️</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('#coinTable tr');
        rows.forEach(row => {
            const name = row.querySelector('td div').textContent.toLowerCase();
            row.style.display = name.includes(query) ? '' : 'none';
        });
    });
</script>

<style>
    .container {
        display: flex;
    }
    .sidebar {
        width: 250px;
        background-color: #f4f4f4;
        padding: 20px;
        border-right: 1px solid #ddd;
    }
    .sidebar h2 {
        font-size: 1.5em;
    }
    .sidebar ul {
        list-style: none;
        padding: 0;
    }
    .sidebar ul li {
        margin: 10px 0;
    }
    .sidebar ul li a {
        text-decoration: none;
        color: #333;
    }
    .sidebar ul li a:hover {
        text-decoration: underline;
    }
    .main-content {
        flex: 1;
        padding: 20px;
    }
</style>
