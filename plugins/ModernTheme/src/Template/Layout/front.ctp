<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="<?= locale_get_primary_language('') ?>">
<head>
    <?= $this->element('front_head'); ?>
</head>
<body class="<?= ($this->request->getParam('_name') === 'home') ? 'home-page' : 'inner-page' ?>">
<?= get_option('after_body_tag_code'); ?>

<!-- ── Navigation ─────────────────────────────────────────── -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Mobile toggle -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#lm-navbar">
                <span class="sr-only"><?= __('Toggle navigation') ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Logo -->
            <?php
            $logo  = get_logo();
            $class = ($logo['type'] === 'image') ? 'logo-image' : '';
            ?>
            <a class="navbar-brand <?= $class ?>" href="<?= build_main_domain_url('/') ?>">
                <?php if ($logo['type'] !== 'image') : ?>
                    <span class="logo-dot"></span>
                <?php endif; ?>
                <?= $logo['content'] ?>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="lm-navbar">
            <?=
            menu_display('menu_main', [
                'ul_class' => 'nav navbar-nav navbar-right',
                'li_class' => '',
                'a_class'  => '',
            ], true);
            ?>
        </div>
    </div>
</nav>

<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>

<?= $this->element('front_footer'); ?>

</body>
</html>
