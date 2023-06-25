<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <h3>ダービードリーム</h3>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="<?= route('dashboard') ?>">
                        <i class="fas fa-chart-bar"></i>ダッシュボード</a>
                </li>
                <li>
                    <a href="<?= route('user_index') ?>">
                        <i class="fa fa-user"></i>ユーザー</a>
                </li>
                <li>
                    <a class="js-arrow" href="#">
                        <i class="fas fa-database"></i>ベースリスト</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="<?= route('pasture_index') ?>">牧場</a>
                        </li>
                        <li>
                            <a href="<?= route('ranch_index') ?>">ロンギ場</a>
                        </li>
                        <li>
                            <a href="<?= route('truck_index') ?>">トラック</a>
                        </li>
                        <li>
                            <a href="<?= route('slope_index') ?>">坂路</a>
                        </li>
                        <li>
                            <a href="<?= route('pool_index') ?>">プール</a>
                        </li>
                        <li>
                            <a href="<?= route('racePlan_index') ?>">競馬場</a>
                        </li>
                        <li>
                            <a href="<?= route("lineage_index")?>">馬</a>
                        </li>
                        <li>
                            <a href="#">基数</a>
                        </li>
                        <li>
                            <a href="#">血統</a>
                        </li>
                        <li>
                            <a href="<?= route("illeword_index")?>">禁止ワード</a>
                        </li>

                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>仕事</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="<?= route("horse_index")?>">馬</a>
                        </li>
                        <li>
                            <a href="#">牧場</a>
                        </li>
                        <li>
                            <a href="#">施設</a>
                        </li>
                        <li>
                            <a href="#">事務</a>
                        </li>
                        <li>
                            <a href="#">試合</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->
