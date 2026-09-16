<?php
/**
 * @var \App\View\AppView $this
 */
?>

<?php if ($this->request->getParam('action') === 'home') : ?>
<!-- Payment methods strip -->
<div class="payment-methods">
    <div class="container text-center">
        <?php foreach (get_withdrawal_methods() as $method) : ?>
            <?php if ($method['image']) : ?>
                <?= $this->Assets->image($method['image']); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- ── Footer ─────────────────────────────────────────────── -->
<footer>
    <div class="copyright-container">
        <div class="container">
            <div class="row" style="align-items:center;">
                <!-- Footer menu -->
                <div class="col-sm-4 bottom-menu">
                    <?=
                    menu_display('menu_footer', [
                        'ul_class' => 'list-inline',
                        'li_class' => '',
                        'a_class'  => '',
                    ]);
                    ?>
                </div>

                <!-- Social -->
                <div class="col-sm-4 social-links">
                    <ul class="list-inline">
                        <?php if (get_option('facebook_url')) : ?>
                            <li>
                                <a href="<?= h(get_option('facebook_url')) ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_option('twitter_url')) : ?>
                            <li>
                                <a href="<?= h(get_option('twitter_url')) ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="Twitter / X">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_option('instagram_url')) : ?>
                            <li>
                                <a href="<?= h(get_option('instagram_url')) ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="Instagram">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Copyright -->
                <div class="col-sm-4 copyright">
                    &copy; <?= date('Y') ?> <?= h(get_option('site_name')) ?>.
                    <?= __('All rights reserved.') ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?= $this->element('js_vars'); ?>

<script data-cfasync="false" src="<?= $this->Assets->url('/js/ads.js?ver=' . APP_VERSION) ?>"></script>

<?php
if ((bool)get_option('combine_minify_css_js', false)) {
    echo $this->Assets->script('/build/js/script.min.js?ver=' . APP_VERSION);
} else {
    echo $this->Assets->script('/vendor/jquery.min.js?ver='              . APP_VERSION);
    echo $this->Assets->script('/vendor/bootstrap/js/bootstrap.min.js?ver=' . APP_VERSION);
    echo $this->Assets->script('/vendor/owl/owl.carousel.min.js?ver='   . APP_VERSION);
    echo $this->Assets->script('/vendor/wow.min.js?ver='                . APP_VERSION);
    echo $this->Assets->script('/vendor/clipboard.min.js?ver='          . APP_VERSION);
    echo $this->Assets->script('/js/front.js?ver='                      . APP_VERSION);
    echo $this->Assets->script('/js/app.js?ver='                        . APP_VERSION);
}
?>

<?= $this->fetch('scriptBottom') ?>
<?= get_option('footer_code'); ?>
