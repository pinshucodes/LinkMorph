<?php
/**
 * @var \App\View\AppView $this
 * @var int $totalClicks
 * @var int $totalLinks
 * @var int $totalUsers
 */
$this->assign('title', (get_option('site_meta_title')) ?: get_option('site_name'));
$this->assign('description', get_option('description'));
$this->assign('content_title', get_option('site_name'));
$siteName = h(get_option('site_name'));
?>

<!-- ==================== HERO ==================== -->
<header class="shorten">
    <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in"><?= __('URL Shortener & Monetization Platform') ?></div>

            <div class="intro-heading">
                <?= __('Shorten Links.') ?><br>
                <span class="highlight"><?= __('Earn Money.') ?></span>
            </div>

            <p class="intro-sub">
                <?= __('Paste your long URL below and start earning with every click. Join thousands of publishers already making money.') ?>
            </p>

            <?php if (get_option('home_shortening') == 'yes') : ?>
                <div class="hero-shorten-wrap">
                    <?= $this->element('shorten'); ?>
                </div>
            <?php endif; ?>

            <div class="hero-trust">
                <span><?= __('Free forever') ?></span>
                <span><?= __('Instant setup') ?></span>
                <span><?= __('Payouts via UPI') ?></span>
                <span><?= __('No credit card needed') ?></span>
            </div>
        </div>
    </div>
</header>

<!-- ==================== STATS BAR ==================== -->
<?php if ((bool)get_option('display_home_stats', 1)) : ?>
<section class="stats">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 text-center">
                <div class="stat">
                    <div class="stat-num"><?= number_format((int)$totalClicks) ?></div>
                    <div class="stat-text">
                        <i class="fa fa-mouse-pointer" style="color:#22c55e;margin-right:6px;"></i>
                        <?= __('Total Clicks Served') ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="stat">
                    <div class="stat-num"><?= number_format((int)$totalLinks) ?></div>
                    <div class="stat-text">
                        <i class="fa fa-link" style="color:#22c55e;margin-right:6px;"></i>
                        <?= __('Links Shortened') ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="stat">
                    <div class="stat-num"><?= number_format((int)$totalUsers) ?>+</div>
                    <div class="stat-text">
                        <i class="fa fa-users" style="color:#22c55e;margin-right:6px;"></i>
                        <?= __('Active Publishers') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ==================== HOW IT WORKS ==================== -->
<section>
    <div class="container text-center">
        <div class="section-title">
            <h3 class="section-subheading"><?= __('Simple Process') ?></h3>
            <h2 class="section-heading"><?= __('Start Earning in <b>3 Steps</b>') ?></h2>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="step step1">
                    <div class="step-img">
                        <i class="fa fa-user-plus" style="color:#fff;font-size:28px;"></i>
                    </div>
                    <h4 class="step-heading"><?= __('Create a Free Account') ?></h4>
                    <p class="feature-content"><?= __('Sign up in seconds. No credit card required.') ?></p>
                    <div class="step-num"><span>1</span></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="step step2">
                    <div class="step-img">
                        <i class="fa fa-scissors" style="color:#fff;font-size:28px;"></i>
                    </div>
                    <h4 class="step-heading"><?= __('Shorten & Share Your Link') ?></h4>
                    <p class="feature-content"><?= __('Paste your URL, get a short link, share anywhere.') ?></p>
                    <div class="step-num"><span>2</span></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="step step3">
                    <div class="step-img">
                        <i class="fa fa-inr" style="color:#fff;font-size:28px;"></i>
                    </div>
                    <h4 class="step-heading"><?= __('Earn Money Per View') ?></h4>
                    <p class="feature-content"><?= __('Get paid for every visitor who sees your link. Withdraw via UPI.') ?></p>
                    <div class="step-num"><span>3</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== WHY JOIN US ==================== -->
<section class="bg-light-gray">
    <div class="container text-center">
        <div class="section-title">
            <h3 class="section-subheading"><?= __('Platform Features') ?></h3>
            <h2 class="section-heading"><?= __('Why <b>Publishers Choose</b> Us?') ?></h2>
        </div>
        <div class="row">

            <div class="col-sm-4">
                <div class="feature">
                    <div class="feature-img">
                        <i class="fa fa-qrcode" style="color:#16a34a;font-size:26px;"></i>
                    </div>
                    <h4 class="feature-heading"><?= __('QR Code Generator') ?></h4>
                    <div class="feature-content"><?= __('Every link comes with a downloadable QR code. Perfect for print, WhatsApp, and offline sharing.') ?></div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="feature">
                    <div class="feature-img">
                        <i class="fa fa-tag" style="color:#16a34a;font-size:26px;"></i>
                    </div>
                    <h4 class="feature-heading"><?= __('Custom Alias') ?></h4>
                    <div class="feature-content"><?= __('Brand your short links with a memorable custom alias instead of random characters.') ?></div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="feature">
                    <div class="feature-img">
                        <i class="fa fa-bar-chart" style="color:#16a34a;font-size:26px;"></i>
                    </div>
                    <h4 class="feature-heading"><?= __('Detailed Analytics') ?></h4>
                    <div class="feature-content"><?= __('Track clicks, countries, devices, and referrers in real time. Know exactly who is clicking.') ?></div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="feature">
                    <div class="feature-img">
                        <i class="fa fa-rupee" style="color:#16a34a;font-size:26px;"></i>
                    </div>
                    <h4 class="feature-heading"><?= __('Fast UPI Payouts') ?></h4>
                    <div class="feature-content"><?= __('Earn in ₹ and withdraw directly to your UPI / Bank account. Minimum withdrawal just ') . display_price_currency(get_option('minimum_withdrawal_amount')) . '.'; ?></div>
                </div>
            </div>

            <?php if ((bool)get_option('enable_referrals', 1)) : ?>
            <div class="col-sm-4">
                <div class="feature">
                    <div class="feature-img">
                        <i class="fa fa-users" style="color:#16a34a;font-size:26px;"></i>
                    </div>
                    <h4 class="feature-heading">
                        <?= __('{0}% Referral Bonus', h(get_option('referral_percentage'))) ?>
                    </h4>
                    <div class="feature-content">
                        <?= __('Invite friends and earn {0}% of their lifetime earnings. The more you share, the more you make.', h(get_option('referral_percentage'))) ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-sm-4">
                <div class="feature">
                    <div class="feature-img">
                        <i class="fa fa-clock-o" style="color:#16a34a;font-size:26px;"></i>
                    </div>
                    <h4 class="feature-heading"><?= __('Link Expiration') ?></h4>
                    <div class="feature-content"><?= __('Set expiry dates on links for time-sensitive campaigns. Expired links auto-redirect to a safe page.') ?></div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="feature">
                    <div class="feature-img">
                        <i class="fa fa-shield" style="color:#16a34a;font-size:26px;"></i>
                    </div>
                    <h4 class="feature-heading"><?= __('Safe & Secure') ?></h4>
                    <div class="feature-content"><?= __('All links are scanned for malware. Your data is protected with industry-standard security.') ?></div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="feature">
                    <div class="feature-img">
                        <i class="fa fa-mobile" style="color:#16a34a;font-size:26px;"></i>
                    </div>
                    <h4 class="feature-heading"><?= __('Mobile Optimized') ?></h4>
                    <div class="feature-content"><?= __('Works flawlessly on every device. Share links from your phone and track results on the go.') ?></div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="feature">
                    <div class="feature-img">
                        <i class="fa fa-code" style="color:#16a34a;font-size:26px;"></i>
                    </div>
                    <h4 class="feature-heading"><?= __('Developer API') ?></h4>
                    <div class="feature-content"><?= __('Shorten links programmatically via our REST API. Integrate with any app, bot, or automation tool.') ?></div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==================== TESTIMONIALS ==================== -->
<?=
$this->cell('Testimonial', [], [
    'cache' => [
        'config' => '1day',
        'key' => 'home_testimonials_' . locale_get_default(),
    ],
])
?>

<!-- ==================== CONTACT ==================== -->
<section id="contact" class="bg-light-gray">
    <div class="container">
        <div class="section-title text-center">
            <h3 class="section-subheading"><?= __('Get In Touch') ?></h3>
            <h2 class="section-heading"><?= __("Have a <b>Question?</b>") ?></h2>
        </div>
        <?= $this->element('contact'); ?>
    </div>
</section>

<?php $this->start('scriptBottom'); ?>
<script>
/* Animate stat numbers counting up */
(function () {
    'use strict';
    function animateCount(el) {
        var target = parseInt(el.innerText.replace(/[^0-9]/g, ''), 10);
        if (!target) return;
        var suffix = el.innerText.replace(/[0-9,]/g, '');
        var start = 0;
        var dur = 1800;
        var step = Math.ceil(target / (dur / 16));
        var timer = setInterval(function () {
            start += step;
            if (start >= target) { start = target; clearInterval(timer); }
            el.innerText = start.toLocaleString('en-IN') + suffix;
        }, 16);
    }
    var nums = document.querySelectorAll('.stat-num');
    if ('IntersectionObserver' in window) {
        var obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { animateCount(e.target); obs.unobserve(e.target); }
            });
        }, { threshold: 0.5 });
        nums.forEach(function (n) { obs.observe(n); });
    } else {
        nums.forEach(animateCount);
    }
}());
</script>
<?php $this->end(); ?>
