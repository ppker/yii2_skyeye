<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/3/16
 * Project: Cat Visual
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="mt-card-item">
        <div class="mt-card-avatar mt-overlay-1">
            <a href="<?= Url::to(['dishes/list', 'id' => $model->id]) ?>" class=""><img src="<?= Yii::getAlias('@web/images/' . $model->photo);?>" /></a>
        </div>
        <div class="mt-card-content">
            <h3 class="mt-card-name"><?= Html::encode($model->name); ?></h3>
            <div class="hotel-star">
                <span class="star-ranking clearfix">
                    <!-- 5颗星60px长度，算此时星级的长度 -->
                    <span class="star-score" style="width: 69px"></span>
                </span>
                <span class="score-num fl">4.7分</span>
                <span class="total cc-lightred-new fr">月售200单</span>
            </div>

            <div class="mt-card-social">
                <?php
                    $like = Html::a(
                        Html::tag('i', '', ['class' => 'fa fa-thumbs-o-up']) . ' ' . Html::tag('span', $model->zan) . ' 个赞',
                        'javascript:;',
                        [
                            'data-do' => 'zan',
                            'data-id' => $model->id,
                            'data-type' => 'hotel',
                            'class' => 'zan_hate ' . (($model->zan) ? 'active' : '')
                        ]
                    );
                    $hate = Html::a(
                        Html::tag('i', '', ['class' => 'fa fa-thumbs-o-down']) . ' ' . Html::tag('span', $model->hate) . ' 个踩',
                        'javascript:;',
                        [
                            'data-do' => 'hate',
                            'data-id' => $model->id,
                            'data-type' => 'hotel',
                            'class' => 'zan_hate ' . (($model->hate) ? 'active' : '')
                        ]
                    );
                ?>
                <ul>
                    <li>
                        <?= $like; ?>
                    </li>
                    <li>
                        <?= $hate; ?>
                    </li>
                </ul>
            </div>
            <p class="mt-card-desc font-grey-mint"><?= Html::encode($model->address); ?></p>
        </div>
    </div>
</div>
