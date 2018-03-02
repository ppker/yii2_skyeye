<?php
use yii\helpers\Url;
?>
<!-- BEGIN HEADER SEARCH BOX -->
<form class="search-form" action="/" method="GET">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="query">
                                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
    </div>
</form>
<!-- END HEADER SEARCH BOX -->
<!-- BEGIN MEGA MENU -->
<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
<div class="hor-menu">
    <ul class="nav navbar-nav">
        <li class="menu-dropdown classic-menu-dropdown">
            <a href="<?= Url::home(); ?>">
                <i class="icon-screen-desktop"></i>&nbsp;&nbsp;加班点餐
                <span class="arrow"></span>
            </a>
        </li>

        <li class="menu-dropdown classic-menu-dropdown ">
            <a href="javascript:;">
                <i class="icon-home"></i>&nbsp;&nbsp;社区
                <span class="arrow"></span>
            </a>
            <ul class="dropdown-menu pull-left">
                <li class="order_log">
                    <?php if(\Yii::$app->user->isGuest): ?>
                    <?php else: ?>
                        <a href="<?= Url::to(['order/log']); ?>" class="nav-link  "><i class="icon-notebook"></i>&nbsp;&nbsp;&nbsp;今日点餐记录</a>
                    <?php endif;?>

                </li>
                <!--<li class=" ">
                    <a href="javascript:;" class="nav-link  "><i class="icon-speedometer"></i>&nbsp;&nbsp;&nbsp;晚八点</a>
                </li>
                <li class=" ">
                    <a href="javascript:;" class="nav-link  "><i class="icon-cup"></i>&nbsp;&nbsp;&nbsp;图书馆</a>
                </li>
                <li class=" ">
                    <a href="javascript:;" class="nav-link  "><i class="icon-grid"></i>&nbsp;&nbsp;&nbsp;数据之美</a>
                </li>
                <li class=" ">
                    <a href="javascript:;" class="nav-link  "><i class="icon-playlist"></i>&nbsp;&nbsp;&nbsp;音乐之声</a>
                </li>
                <li class=" ">
                    <a href="javascript:;" class="nav-link  "><i class="icon-size-actual"></i>&nbsp;&nbsp;&nbsp;探索发现...</a>
                </li>-->
            </ul>
        </li>

    </ul>
</div>
<!-- END MEGA MENU -->