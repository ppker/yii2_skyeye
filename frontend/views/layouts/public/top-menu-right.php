<div class="top-menu">
    <ul class="nav navbar-nav pull-right">

        <?php if (Yii::$app->user->isGuest): ?>
            <li class="user-login">
                <a href="javascript:;">
                    <i class="icon-user"></i>
                    <span class="badge badge-default">登录</span>
                </a>
            </li>

            <li class="user-register">
                <a href="javascript:;">
                    <i class="icon-users"></i>
                    <span class="badge badge-default">注册</span>
                </a>
            </li>
        <?php else: ?>
            <!-- BEGIN NOTIFICATION DROPDOWN -->
            <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->

            <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="icon-bell"></i>
                    <span class="badge badge-default"></span>
                </a>
                <ul class="dropdown-menu">
                </ul>
            </li>


            <!-- END NOTIFICATION DROPDOWN -->
            <!-- BEGIN TODO DROPDOWN -->

            <li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="icon-calendar"></i>
                    <span class="badge badge-default"></span>
                </a>
                <ul class="dropdown-menu extended tasks">
                </ul>
            </li>

            <!-- END TODO DROPDOWN -->
            <li class="droddown dropdown-separator">
                <span class="separator"></span>
            </li>
            <!-- BEGIN INBOX DROPDOWN -->

            <!-- END INBOX DROPDOWN -->
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown dropdown-user dropdown-dark">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img alt="" class="img-circle" src="<?= Yii::getAlias('@web/static/images/avatar9.jpg');?>">
                    <span class="username username-hide-mobile"><?= \Yii::$app->user->identity->realname; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">

                    <li>
                        <a href="<?= \yii\helpers\Url::to(["site/logout"]); ?>">
                            <i class="icon-key"></i> Log Out </a>
                    </li>
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
            <!--<li class="dropdown dropdown-extended quick-sidebar-toggler">
                <span class="sr-only">Toggle Quick Sidebar</span>
                <i class="icon-logout"></i>
            </li>-->
        <?php endif; ?>
        <!-- END QUICK SIDEBAR TOGGLER -->
    </ul>
</div>