<?php
/**
 * @var \App\View\AppView $this
 */
?>

<?php if ($this->request->getParam('action') === 'home') : ?>
<!-- Payment methods strip (homepage only) -->
<?php
$methods = get_withdrawal_methods();
$has_methods = false;
foreach ($methods as $m) { if ($m['image']) { $has_methods = true; break; } }
?>
<?php if ($has_methods) : ?>
<div style="background: var(--surface-2); border-top: 1px solid var(--border-subtle); padding: 20px 0; text-align: center;">
    <div class="container">
        <span style="font-size: 12px; color: var(--text-subtle); text-transform: uppercase; letter-spacing: .08em; font-weight: 600; margin-right: 20px;">
            <?= __('Withdraw via') ?>
        </span>
        <?php foreach ($methods as $method) : ?>
            <?php if ($method['image']) : ?>
                <?= $this->Assets->image($method['image'], ['style' => 'height:22px; width:auto; margin:0 10px; opacity:.5; filter:brightness(2) grayscale(1); vertical-align:middle;']); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>

<!-- ── Footer ─────────────────────────────────────────────── -->
<footer>
    <div class="container">
        <div class="footer-body">

            <!-- Brand column -->
            <div>
                <?php $logo = get_logo(); ?>
                <?php if ($logo['type'] === 'image') : ?>
                    <a href="<?= build_main_domain_url('/') ?>" class="footer-brand">
                        <?= $logo['content'] ?>
                    </a>
                <?php else : ?>
                    <a href="<?= build_main_domain_url('/') ?>" class="footer-brand">
                        <span class="footer-brand-dot"></span>
                        <?= $logo['content'] ?>
                    </a>
                <?php endif; ?>
                <p class="footer-tagline"><?= __('Shorten links. Earn money. Withdraw to UPI.') ?></p>
            </div>

            <!-- Links column 1 -->
            <div class="footer-links-group">
                <h6><?= __('Platform') ?></h6>
                <?=
                menu_display('menu_footer', [
                    'ul_class' => '',
                    'li_class' => '',
                    'a_class'  => '',
                ]);
                ?>
            </div>

            <!-- Links column 2 -->
            <div class="footer-links-group">
                <h6><?= __('Legal') ?></h6>
                <ul>
                    <li><a href="<?= build_main_domain_url('/page/terms-of-service') ?>"><?= __('Terms of Service') ?></a></li>
                    <li><a href="<?= build_main_domain_url('/page/privacy-policy') ?>"><?= __('Privacy Policy') ?></a></li>
                    <li><a href="<?= build_main_domain_url('/page/report-abuse') ?>"><?= __('Report Abuse') ?></a></li>
                </ul>
            </div>

            <!-- Links column 3 -->
            <div class="footer-links-group">
                <h6><?= __('Earn') ?></h6>
                <ul>
                    <li><a href="<?= build_main_domain_url('/payout-rates') ?>"><?= __('Payout Rates') ?></a></li>
                    <?php if ((bool)get_option('enable_referrals', 1)) : ?>
                    <li><a href="<?= build_main_domain_url('/auth/register') ?>"><?= __('Referral Program') ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?= build_main_domain_url('/auth/register') ?>"><?= __('Sign Up Free') ?></a></li>
                </ul>
            </div>

        </div>

        <!-- Footer bottom bar -->
        <div class="footer-bottom">
            <span>&copy; <?= date('Y') ?> <?= h(get_option('site_name')) ?>. <?= __('All rights reserved.') ?></span>

            <div class="social-links">
                <?php if (get_option('facebook_url')) : ?>
                    <a href="<?= h(get_option('facebook_url')) ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                <?php endif; ?>
                <?php if (get_option('twitter_url')) : ?>
                    <a href="<?= h(get_option('twitter_url')) ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                <?php endif; ?>
                <?php if (get_option('instagram_url')) : ?>
                    <a href="<?= h(get_option('instagram_url')) ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <i class="fa fa-instagram"></i>
                    </a>
                <?php endif; ?>
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
