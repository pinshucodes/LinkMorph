<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?= $this->Html->charset(); ?>
<title><?= h($this->fetch('title')); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?= h($this->fetch('description')); ?>">
<meta name="keywords" content="<?= h(get_option('seo_keywords')); ?>">

<?= $this->Assets->favicon() ?>

<!-- Inter — modern SaaS font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<!-- LinkMorph design system overrides — loaded after theme CSS -->
<style>
:root{--lm-dark:#0f172a;--lm-dark-mid:#1e293b;--lm-dark-surface:#334155;--lm-accent:#22c55e;--lm-accent-hover:#16a34a;--lm-accent-light:rgba(34,197,94,.12);--lm-purple:#7c3aed;--lm-purple-end:#4f46e5;--lm-text:#1e293b;--lm-muted:#64748b;--lm-border:#e2e8f0;--lm-surface:#fff;--lm-page:#f8fafc;--lm-radius:12px;--lm-shadow:0 1px 3px rgba(0,0,0,.1),0 1px 2px rgba(0,0,0,.06);--lm-shadow-md:0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -1px rgba(0,0,0,.06);--lm-shadow-lg:0 10px 15px -3px rgba(0,0,0,.1),0 4px 6px -2px rgba(0,0,0,.05)}
*,::after,::before{box-sizing:border-box}
body{font-family:'Inter',system-ui,-apple-system,BlinkMacSystemFont,sans-serif!important;color:var(--lm-text);background:var(--lm-page)}
</style>

<?php
if ((bool)get_option('combine_minify_css_js', false)) {
    echo $this->Assets->css('/build/css/styles.min.css?ver=' . APP_VERSION);
} else {
    echo $this->Assets->css('/vendor/bootstrap/css/bootstrap.min.css?ver=' . APP_VERSION);
    echo $this->Assets->css('/vendor/font-awesome/css/font-awesome.min.css?ver=' . APP_VERSION);
    echo $this->Assets->css('/vendor/animate.min.css?ver=' . APP_VERSION);
    echo $this->Assets->css('/vendor/owl/owl.carousel.min.css?ver=' . APP_VERSION);
    echo $this->Assets->css('/vendor/owl/owl.theme.default.css?ver=' . APP_VERSION);
    echo $this->Assets->css('/css/front.css?ver=' . APP_VERSION);
    echo $this->Assets->css('/css/app.css?ver=' . APP_VERSION);
    echo $this->Assets->css('/css/spritesheet.css?ver=' . APP_VERSION);
}

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>

<?= get_option('head_code'); ?>
<?= $this->fetch('scriptTop') ?>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
