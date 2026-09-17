<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $logged_user
 * @var \App\Model\Entity\Plan $logged_user_plan
 */
?>
<!DOCTYPE html>
<html lang="<?= locale_get_primary_language('') ?>">
<head>
    <?= $this->Html->charset(); ?>
    <title><?= h($this->fetch('title')); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= h($this->fetch('description')); ?>">

    <?= $this->Assets->favicon() ?>


    <!-- Dark Dashboard CSS System -->
    <style>
    :root {
      --db-bg:        #09090b;
      --db-sidebar:   #111113;
      --db-surface:   #18181b;
      --db-surface-2: #27272a;
      --db-border:    #3f3f46;
      --db-border-s:  #27272a;
      --db-text:      #fafafa;
      --db-muted:     #a1a1aa;
      --db-subtle:    #71717a;
      --db-accent:    #6366f1;
      --db-accent-h:  #4f46e5;
      --db-accent-g:  rgba(99,102,241,.15);
      --db-success:   #22c55e;
      --db-warning:   #f59e0b;
      --db-danger:    #ef4444;
      --db-font:      -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      --db-radius:    10px;
      --db-radius-lg: 14px;
    }
    *, *::before, *::after { box-sizing: border-box; }
    body, h1, h2, h3, h4, h5, h6, p, a, button, input,
    select, textarea, label, span, li, td, th {
        font-family: var(--db-font) !important;
    }
    </style>

    <?php
    if ((bool)get_option('combine_minify_css_js', false)) {
        echo $this->Assets->css('/build/css/dashboard.min.css?ver=' . APP_VERSION);
    } else {
        echo $this->Assets->css('/vendor/bootstrap/css/bootstrap.min.css?ver=' . APP_VERSION);
        echo $this->Assets->css('/vendor/font-awesome/css/font-awesome.min.css?ver=' . APP_VERSION);
        echo $this->Assets->css('/vendor/dashboard/css/AdminLTE.min.css?ver=' . APP_VERSION);
        echo $this->Assets->css('/vendor/dashboard/css/skins/_all-skins.min.css?ver=' . APP_VERSION);
        echo $this->Assets->css('/css/app.css?ver=' . APP_VERSION);
    }

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>


    <?= get_option('member_head_code'); ?>

    <?= $this->fetch('scriptTop') ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="member-dashboard hold-transition skin-black sidebar-mini">
<style>
/* ── Dark Member Dashboard Overrides ─────────────────────── */
body.member-dashboard { background: var(--db-bg) !important; color: var(--db-text); }

/* Wrapper */
.wrapper { background: var(--db-bg) !important; }

/* Main header */
.main-header { background: var(--db-sidebar) !important; border-bottom: 1px solid var(--db-border-s) !important; }
.main-header .logo {
    background: var(--db-sidebar) !important;
    border-right: 1px solid var(--db-border-s) !important;
    color: var(--db-text) !important;
    font-weight: 800 !important;
    font-size: 18px !important;
    letter-spacing: -0.04em !important;
}
.main-header .logo:hover { background: var(--db-surface) !important; }
.main-header .navbar { background: var(--db-sidebar) !important; border: none !important; }
.main-header .navbar .sidebar-toggle {
    color: var(--db-muted) !important;
    border-right: 1px solid var(--db-border-s) !important;
}
.main-header .navbar .sidebar-toggle:hover { background: var(--db-surface) !important; color: var(--db-text) !important; }
.main-header .navbar .navbar-custom-menu > .nav > li > a {
    color: var(--db-muted) !important;
    font-size: 13px !important;
    font-weight: 500 !important;
}
.main-header .navbar .navbar-custom-menu > .nav > li > a:hover { color: var(--db-text) !important; background: var(--db-surface) !important; }

/* User dropdown */
.user-header { background: var(--db-accent) !important; }
.navbar-custom-menu .dropdown-menu {
    background: var(--db-surface) !important;
    border: 1px solid var(--db-border) !important;
    border-radius: var(--db-radius-lg) !important;
    box-shadow: 0 16px 48px rgba(0,0,0,.6) !important;
    padding: 6px !important;
}
.navbar-custom-menu .dropdown-menu > li > a { color: var(--db-muted) !important; border-radius: var(--db-radius) !important; }
.navbar-custom-menu .dropdown-menu > li > a:hover { background: var(--db-surface-2) !important; color: var(--db-text) !important; }
.user-footer { background: var(--db-surface-2) !important; }

/* Sidebar */
.main-sidebar {
    background: var(--db-sidebar) !important;
    border-right: 1px solid var(--db-border-s) !important;
}
.sidebar-menu > li > a {
    color: var(--db-muted) !important;
    border-radius: var(--db-radius) !important;
    margin: 2px 8px !important;
    padding: 10px 16px !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    transition: all .15s !important;
}
.sidebar-menu > li > a:hover {
    background: var(--db-surface) !important;
    color: var(--db-text) !important;
}
.sidebar-menu > li.active > a,
.sidebar-menu > li > a:focus {
    background: var(--db-accent-g) !important;
    color: var(--db-accent) !important;
    border-left: 2px solid var(--db-accent) !important;
    padding-left: 14px !important;
}
.sidebar-menu > li > a > .fa { width: 20px !important; color: var(--db-subtle) !important; }
.sidebar-menu > li.active > a > .fa,
.sidebar-menu > li > a:hover > .fa { color: var(--db-accent) !important; }

/* Treeview submenu */
.treeview-menu { background: transparent !important; padding-left: 8px !important; }
.treeview-menu > li > a {
    color: var(--db-subtle) !important;
    padding: 8px 16px 8px 36px !important;
    font-size: 13px !important;
    border-radius: var(--db-radius) !important;
    margin: 1px 8px !important;
}
.treeview-menu > li > a:hover { background: var(--db-surface) !important; color: var(--db-muted) !important; }
.treeview-menu > li.active > a { color: var(--db-accent) !important; }

/* Shorten button in sidebar */
.shorten-button {
    background: var(--db-accent) !important;
    border: none !important;
    border-radius: var(--db-radius) !important;
    color: #fff !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    margin: 0 12px !important;
    transition: all .15s !important;
}
.shorten-button:hover { background: var(--db-accent-h) !important; box-shadow: 0 0 0 4px var(--db-accent-g) !important; }

/* Content wrapper */
.content-wrapper {
    background: var(--db-bg) !important;
    margin-left: 230px;
}

/* Content header */
.content-header { padding: 24px 20px 0 !important; }
.content-header h1 { font-size: 22px !important; font-weight: 800 !important; color: var(--db-text) !important; letter-spacing: -0.03em !important; }
.content-header > .breadcrumb { background: transparent !important; font-size: 13px !important; color: var(--db-subtle) !important; }
.content-header > .breadcrumb > li > a { color: var(--db-muted) !important; }

/* Section content */
.content { padding: 20px !important; }

/* Box cards */
.box {
    background: var(--db-surface) !important;
    border: 1px solid var(--db-border-s) !important;
    border-radius: var(--db-radius-lg) !important;
    box-shadow: none !important;
    margin-bottom: 20px;
}
.box-header {
    background: transparent !important;
    border-bottom: 1px solid var(--db-border-s) !important;
    padding: 16px 20px !important;
    color: var(--db-text) !important;
    font-weight: 700 !important;
    font-size: 14px !important;
    border-radius: var(--db-radius-lg) var(--db-radius-lg) 0 0 !important;
}
.box-header.with-border { border-bottom: 1px solid var(--db-border-s) !important; }
.box-body { padding: 20px !important; color: var(--db-muted) !important; }
.box-footer { background: var(--db-surface-2) !important; border-top: 1px solid var(--db-border-s) !important; border-radius: 0 0 var(--db-radius-lg) var(--db-radius-lg) !important; }

/* Tables */
.table { color: var(--db-muted) !important; }
.table > thead > tr > th {
    color: var(--db-subtle) !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: .08em !important;
    border-bottom: 1px solid var(--db-border-s) !important;
    background: var(--db-surface-2) !important;
    padding: 12px 14px !important;
}
.table > tbody > tr > td {
    border-top: 1px solid var(--db-border-s) !important;
    color: var(--db-muted) !important;
    font-size: 13px !important;
    padding: 12px 14px !important;
    vertical-align: middle !important;
}
.table > tbody > tr:hover > td { background: var(--db-surface-2) !important; }
.table-striped > tbody > tr:nth-of-type(odd) { background: transparent !important; }
.table-bordered { border: 1px solid var(--db-border-s) !important; }
.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > td { border: 1px solid var(--db-border-s) !important; }

/* Forms */
.form-control {
    background: var(--db-surface-2) !important;
    border: 1px solid var(--db-border) !important;
    border-radius: var(--db-radius) !important;
    color: var(--db-text) !important;
    padding: 10px 14px !important;
    height: auto !important;
    box-shadow: none !important;
    font-size: 14px;
}
.form-control:focus {
    border-color: var(--db-accent) !important;
    box-shadow: 0 0 0 3px var(--db-accent-g) !important;
    background: var(--db-surface) !important;
}
.form-control::placeholder { color: var(--db-subtle) !important; }
select.form-control option { background: var(--db-surface-2); }
.control-label, label { color: var(--db-muted) !important; font-size: 13px !important; font-weight: 600 !important; }

/* Buttons */
.btn-primary, .btn-info { background: var(--db-accent) !important; border: none !important; color: #fff !important; }
.btn-primary:hover, .btn-info:hover { background: var(--db-accent-h) !important; }
.btn-success { background: var(--db-success) !important; border: none !important; color: #fff !important; }
.btn-danger { background: var(--db-danger) !important; border: none !important; }
.btn-default {
    background: var(--db-surface-2) !important;
    border: 1px solid var(--db-border) !important;
    color: var(--db-muted) !important;
}
.btn-default:hover { background: var(--db-border) !important; color: var(--db-text) !important; }
.btn { border-radius: var(--db-radius) !important; font-weight: 600 !important; }

/* Alerts */
.alert { border: none !important; border-radius: var(--db-radius) !important; font-size: 13px !important; }
.alert-success { background: rgba(34,197,94,.1) !important; color: #86efac !important; border-left: 3px solid #22c55e !important; }
.alert-danger  { background: rgba(239,68,68,.1) !important;  color: #fca5a5 !important; border-left: 3px solid #ef4444 !important; }
.alert-info    { background: rgba(99,102,241,.1) !important; color: #a5b4fc !important; border-left: 3px solid #6366f1 !important; }
.alert-warning { background: rgba(245,158,11,.1) !important; color: #fcd34d !important; border-left: 3px solid #f59e0b !important; }

/* Footer */
.main-footer {
    background: var(--db-sidebar) !important;
    border-top: 1px solid var(--db-border-s) !important;
    color: var(--db-subtle) !important;
    font-size: 12px !important;
}

/* Pagination */
.pagination > li > a {
    background: var(--db-surface-2) !important;
    border: 1px solid var(--db-border) !important;
    color: var(--db-muted) !important;
}
.pagination > .active > a { background: var(--db-accent) !important; border-color: var(--db-accent) !important; color: #fff !important; }
.pagination > li > a:hover { background: var(--db-border) !important; color: var(--db-text) !important; }

/* Badges */
.badge { border-radius: 6px !important; font-size: 11px !important; font-weight: 600 !important; }
.label-success, .badge-success { background: rgba(34,197,94,.15) !important; color: #86efac !important; }
.label-danger,  .badge-danger  { background: rgba(239,68,68,.15) !important;  color: #fca5a5 !important; }
.label-info,    .badge-info    { background: rgba(99,102,241,.15) !important; color: #a5b4fc !important; }

/* Modals */
.modal-content { background: var(--db-surface) !important; border: 1px solid var(--db-border) !important; border-radius: var(--db-radius-lg) !important; box-shadow: 0 24px 80px rgba(0,0,0,.7) !important; }
.modal-header { border-bottom: 1px solid var(--db-border-s) !important; background: var(--db-surface) !important; }
.modal-header .modal-title { color: var(--db-text) !important; font-weight: 700 !important; }
.modal-header .close { color: var(--db-muted) !important; text-shadow: none !important; opacity: .7; }
.modal-header .close:hover { opacity: 1; }
.modal-body { background: var(--db-surface) !important; color: var(--db-muted) !important; }
.modal-footer { background: var(--db-surface-2) !important; border-top: 1px solid var(--db-border-s) !important; }

/* Dropdowns */
.dropdown-menu { background: var(--db-surface) !important; border: 1px solid var(--db-border) !important; border-radius: var(--db-radius-lg) !important; padding: 6px !important; box-shadow: 0 12px 40px rgba(0,0,0,.5) !important; }
.dropdown-menu > li > a { color: var(--db-muted) !important; border-radius: var(--db-radius) !important; font-size: 13px !important; }
.dropdown-menu > li > a:hover { background: var(--db-surface-2) !important; color: var(--db-text) !important; }
.divider { background: var(--db-border-s) !important; }

/* Input groups */
.input-group-addon { background: var(--db-surface-2) !important; border-color: var(--db-border) !important; color: var(--db-muted) !important; }

/* Nav tabs */
.nav-tabs { border-bottom: 1px solid var(--db-border-s) !important; }
.nav-tabs > li > a { color: var(--db-muted) !important; border: none !important; border-bottom: 2px solid transparent !important; background: transparent !important; }
.nav-tabs > li.active > a, .nav-tabs > li > a:hover { color: var(--db-accent) !important; border-bottom-color: var(--db-accent) !important; background: transparent !important; }
.tab-content { padding-top: 16px; }

/* Callouts */
.callout { background: var(--db-surface-2) !important; border-color: var(--db-border) !important; border-radius: var(--db-radius) !important; }
.callout-success { border-left-color: var(--db-success) !important; }
.callout-danger  { border-left-color: var(--db-danger) !important; }
.callout-info    { border-left-color: var(--db-accent) !important; }

/* Select2 */
.select2-container--default .select2-selection--single {
    background: var(--db-surface-2) !important;
    border-color: var(--db-border) !important;
    color: var(--db-text) !important;
    height: auto !important;
    padding: 8px 12px !important;
    border-radius: var(--db-radius) !important;
}
.select2-dropdown { background: var(--db-surface) !important; border-color: var(--db-border) !important; border-radius: var(--db-radius-lg) !important; }
.select2-results__option { color: var(--db-muted) !important; }
.select2-results__option--highlighted { background: var(--db-accent) !important; color: #fff !important; }

/* Banner ad container */
.banner-member { margin-bottom: 20px; }

@media (max-width: 767px) {
    .content-wrapper { margin-left: 0; }
}
</style>
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="<?= $this->Url->build('/'); ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">
                <?= preg_replace('/(\B.|\s+)/', '', get_option('site_name')) ?>
            </span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?= get_option('site_name') ?></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only"><?= __('Toggle navigation') ?></span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <?php if (in_array($logged_user->role, ['admin'])) : ?>
                        <li class="dropdown messages-menu">
                            <!-- Menu toggle button -->
                            <a href="<?= $this->Url->build([
                                'controller' => 'Users',
                                'action' => 'dashboard',
                                'prefix' => 'admin',
                            ]); ?>">
                                <i class="fa fa-dashboard"></i> <span
                                    class="hidden-xs"><?= __('Administration Area') ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="<?= $this->Url->build([
                            'controller' => 'Withdraws',
                            'action' => 'index',
                            'prefix' => 'member',
                        ]); ?>">
                            <span
                                class="hidden-xs"><?= __('Available Balance') ?>: </span><?= display_price_currency($logged_user->publisher_earnings + $logged_user->referral_earnings); ?>
                        </a>
                    </li>

                    <?php if (count(get_site_languages(true)) > 1) : ?>
                        <li class="dropdown language-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-language"></i> <?= __('Language') ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach (get_site_languages(true) as $lang) : ?>
                                    <li>
                                        <?= $this->Html->link(
                                            locale_get_display_name($lang, $lang),
                                            $this->request->getPath() . '?lang=' . $lang
                                        ); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img
                                src="<?= "https://www.gravatar.com/avatar/" . md5(strtolower(trim($logged_user->email))) .
                                "?s=160" ?>" class="user-image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?= h($logged_user->first_name); ?></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="<?= "https://www.gravatar.com/avatar/" .
                                md5(strtolower(trim($logged_user->email))) . "?s=160" ?>" class="img-circle">
                                <p>
                                    <small><?= __('Member since') ?> <?= $logged_user->created ?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= $this->Url->build([
                                        'controller' => 'Users',
                                        'action' => 'profile',
                                        'prefix' => 'member',
                                    ]); ?>" class="btn btn-default btn-flat"><?= __('Profile') ?></a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= $this->Url->build([
                                        'controller' => 'Users',
                                        'action' => 'logout',
                                        'prefix' => 'auth',
                                    ]); ?>" class="btn btn-default btn-flat"><?= __('Log out') ?></a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <br>

            <button type="button" class="btn btn-block btn-social btn-github btn-lg shorten-button" data-toggle="modal"
                    data-target="#myModal"><i class="fa fa-paper-plane"></i> <span><?= __("New Shorten Link") ?></span>
            </button>

            <br>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">

                <?php if ((bool)get_option('wallet_enable')) : ?>
                    <li>
                        <a><i class="fa fa-credit-card text-aqua"></i>
                            <span><b><?= __("Money Wallet") ?></b><br>
                                <?= display_price_currency($logged_user->wallet_money) ?>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>

                <li><a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']); ?>"><i
                            class="fa fa-dashboard"></i> <span><?= __('Statistics') ?></span></a></li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span><?= __('Manage Links') ?></span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Links',
                                'action' => 'index',
                            ]); ?>"><?= __('All Links') ?></a></li>
                        <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Links',
                                'action' => 'hidden',
                            ]); ?>"><?= __('Hidden Links') ?></a></li>
                    </ul>
                </li>

                <li><a href="<?php echo $this->Url->build(['controller' => 'Withdraws', 'action' => 'index']); ?>"><i
                            class="fa fa-dollar"></i> <span><?= __('Withdraw') ?></span></a></li>

                <?php if (
                    $logged_user_plan->api_quick ||
                    $logged_user_plan->api_mass ||
                    $logged_user_plan->api_full ||
                    $logged_user_plan->api_developer ||
                    $logged_user_plan->bookmarklet
                ) : ?>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-wrench"></i> <span><?= __('Tools') ?></span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <?php if ($logged_user_plan->api_quick) : ?>
                                <li><a href="<?php echo $this->Url->build([
                                        'controller' => 'Tools',
                                        'action' => 'quick',
                                    ]); ?>"><?= __('Quick Link') ?></a></li>
                            <?php endif; ?>
                            <?php if ($logged_user_plan->api_mass) : ?>
                                <li><a href="<?php echo $this->Url->build([
                                        'controller' => 'Tools',
                                        'action' => 'massShrinker',
                                    ]); ?>"><?= __('Mass Shrinker') ?></a></li>
                            <?php endif; ?>
                            <?php if ($logged_user_plan->api_full) : ?>
                                <li><a href="<?php echo $this->Url->build([
                                        'controller' => 'Tools',
                                        'action' => 'full',
                                    ]); ?>"><?= __('Full Page Script') ?></a></li>
                            <?php endif; ?>
                            <?php if ($logged_user_plan->api_developer) : ?>
                                <li><a href="<?php echo $this->Url->build([
                                        'controller' => 'Tools',
                                        'action' => 'api',
                                    ]); ?>"><?= __('Developers API') ?></a></li>
                            <?php endif; ?>
                            <?php if ($logged_user_plan->bookmarklet) : ?>
                                <li><a href="<?php echo $this->Url->build([
                                        'controller' => 'Tools',
                                        'action' => 'bookmarklet',
                                    ]); ?>"><?= __('Bookmarklet') ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ((bool)get_option('enable_referrals', 1)) : ?>
                    <li><a href="<?php echo $this->Url->build([
                            'controller' => 'Users',
                            'action' => 'referrals',
                        ]); ?>"><i
                                class="fa fa-exchange"></i> <span><?= __('Referrals') ?></span></a></li>
                <?php endif; ?>

                <?php if (get_option('earning_mode', 'campaign') === 'campaign' &&
                    get_option('enable_advertising', 'yes') == 'yes') : ?>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-database"></i> <span><?= __('Campaigns') ?></span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo $this->Url->build([
                                    'controller' => 'Campaigns',
                                    'action' => 'index',
                                ]); ?>"><?= __('List') ?></a></li>
                            <?php if (get_option('enable_interstitial', 'yes') == 'yes') : ?>
                                <li><a href="<?php echo $this->Url->build([
                                        'controller' => 'Campaigns',
                                        'action' => 'createInterstitial',
                                    ]); ?>"><?= __('Create Interstitial Campaign') ?></a></li>
                            <?php endif; ?>
                            <?php if (get_option('enable_banner', 'yes') == 'yes') : ?>
                                <li><a href="<?php echo $this->Url->build([
                                        'controller' => 'Campaigns',
                                        'action' => 'createBanner',
                                    ]); ?>"><?= __('Create Banner Campaign') ?></a></li>

                            <?php endif; ?>
                            <?php if (get_option('enable_popup', 'yes') == 'yes') : ?>
                                <li><a href="<?php echo $this->Url->build([
                                        'controller' => 'Campaigns',
                                        'action' => 'createPopup',
                                    ]); ?>"><?= __('Create Popup Campaign') ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (
                    (bool)get_option('enable_premium_membership') ||
                    get_option('earning_mode', 'campaign') === 'campaign'
                ) : ?>
                    <li>
                        <a href="<?php echo $this->Url->build(['controller' => 'Invoices', 'action' => 'index']); ?>">
                            <i class="fa fa-credit-card"></i> <span><?= __('Invoices') ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="treeview">
                    <a href="#"><i class="fa fa-gears"></i> <span><?= __('Settings') ?></span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Users',
                                'action' => 'profile',
                            ]); ?>"><?= __('Profile') ?></a></li>
                        <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Users',
                                'action' => 'changePassword',
                            ]); ?>"><?= __('Change Password') ?></a></li>
                        <li><a href="<?php echo $this->Url->build([
                                'controller' => 'Users',
                                'action' => 'changeEmail',
                            ]); ?>"><?= __('Change Email') ?></a></li>
                    </ul>
                </li>

                <li><a href="<?php echo $this->Url->build(['controller' => 'Forms', 'action' => 'support']); ?>"><i
                            class="fa fa-life-ring"></i> <span><?= __('Support') ?></span></a></li>
                <?php if ((bool)get_option('enable_premium_membership')) : ?>
                    <li>
                        <a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'plans']); ?>">
                            <i class="fa fa-refresh"></i> <span><?= __('Change Your Plan') ?></span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
            <!-- /.sidebar-menu -->

            <?php if ((bool)get_option('enable_premium_membership')) : ?>

                <?php
                if ($logged_user_plan->id === 1) {
                    $exp_date = __("Never");
                } else {
                    $exp_date = __("Never");
                    if (isset($logged_user->expiration)) {
                        $exp_date = $this->Time->nice($logged_user->expiration);
                    }
                }
                ?>

                <ul class="sidebar-menu">
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'plans']); ?>">
                            <i class="fa fa-user-circle text-aqua"></i>
                            <span><b><?= __("Current Plan") ?></b><br>
                                <?= h($logged_user_plan->title) ?>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'plans']); ?>">
                            <i class="fa fa-clock-o text-aqua"></i>
                            <span><b><?= __("Expiration Date") ?></b><br>
                                <?= $exp_date ?>
                                <?php if (isset($logged_user->expiration) &&
                                    ($this->Time->isThisWeek($logged_user->expiration) || $this->Time->isPast($logged_user->expiration))
                                ) : ?>
                                    - <?= __("Renew") ?>
                                <?php endif; ?>
                            </span>
                        </a>
                    </li>
                </ul>

            <?php endif; ?>

        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><?= h($this->fetch('content_title')); ?></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> <?= __('Dashboard') ?></a></li>
                <li class="active"><?= h($this->fetch('content_title')); ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box-short" style="margin-bottom: 10px; display: none;">
                <div class="box box-success box-solid shorten-member">
                    <div class="box-body" style="overflow: hidden;">
                        <?= $this->cell('Link::shortenMember') ?>
                    </div>
                </div>
            </div>

            <?php if (!$logged_user_plan->disable_ads && !empty(get_option('ad_member'))) : ?>
                <div class="banner banner-member">
                    <div class="banner-inner">
                        <?= get_option('ad_member'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">

        </div>
        <!-- Default to the left -->
        <?= __('Copyright &copy;') ?> <?= h(get_option('site_name')) ?> <?= date("Y") ?>
    </footer>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>


</div>

<?= $this->element('js_vars'); ?>

<script data-cfasync="false" src="<?= $this->Assets->url('/js/ads.js?ver=' . APP_VERSION) ?>"></script>

<?php
if ((bool)get_option('combine_minify_css_js', false)) {
    echo $this->Assets->script('/build/js/dashboard.min.js?ver=' . APP_VERSION);
} else {
    echo $this->Assets->script('/vendor/jquery.min.js?ver=' . APP_VERSION);
    echo $this->Assets->script('/vendor/bootstrap/js/bootstrap.min.js?ver=' . APP_VERSION);
    echo $this->Assets->script('/vendor/clipboard.min.js?ver=' . APP_VERSION);
    echo $this->Assets->script('/vendor/conditionize.jquery.js?ver=' . APP_VERSION);
    echo $this->Assets->script('/js/app.js?ver=' . APP_VERSION);
    echo $this->Assets->script('/vendor/dashboard/js/app.min.js?ver=' . APP_VERSION);
}
?>

<?= $this->fetch('scriptBottom') ?>
</body>
</html>
