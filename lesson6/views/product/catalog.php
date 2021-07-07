<?php
/**
 * @var Product[] $catalog
 * @var integer|null $page
 */

use app\models\Product;
?>

<h2>Каталог</h2>

<? if ($catalog) : ?>
    <? foreach ($catalog as $item): ?>
        <div>
            <h3>
                <a href="/product/card/?id=<?=$item->id?>">
                    <?=$item->name?>
                </a>
            </h3>
            <p>Цена: <?=$item->price?></p>
            <button>Купить</button>
        </div>
    <? endforeach ?>
    <br>
    <a href="/product/catalog/?page=<?=$page?>">Еще</a>
<? else: ?>
    <?= "Каталог товаров отсутствует!" ?>
<? endif; ?>