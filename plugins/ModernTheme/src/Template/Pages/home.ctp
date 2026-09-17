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

            <!-- Badge -->
            <div class="hero-badge">
                <span class="badge-dot"></span>
                <span><?= __('India\'s fastest growing link monetization platform') ?></span>
            </div>

            <!-- Headline -->
            <h1 class="intro-heading">
                <?= __('Shorten Links.') ?><br>
                <span class="gradient-text"><?= __('Earn Real Money.') ?></span>
            </h1>

            <p class="intro-sub">
                <?= __('Every click on your short link earns you money. Share links on WhatsApp, Instagram, YouTube — withdraw straight to UPI.') ?>
            </p>

            <!-- Shorten Form -->
            <?php if (get_option('home_shortening') == 'yes') : ?>
                <div class="hero-shorten-wrap">
                    <?= $this->element('shorten'); ?>
                </div>
            <?php endif; ?>

            <!-- Trust badges -->
            <div class="hero-trust">
                <span><?= __('Free forever') ?></span>
                <span><?= __('No credit card') ?></span>
                <span><?= __('UPI withdrawals') ?></span>
                <span><?= __('Instant link creation') ?></span>
            </div>

        </div>
    </div>
</header>

<!-- ==================== STATS ==================== -->
<?php if ((bool)get_option('display_home_stats', 1)) : ?>
<section class="stats">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="stat-block">
                    <div class="stat-num" data-target="<?= (int)$totalClicks ?>"><?= number_format((int)$totalClicks) ?></div>
                    <div class="stat-label"><?= __('Total Clicks Served') ?></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="stat-block">
                    <div class="stat-num" data-target="<?= (int)$totalLinks ?>"><?= number_format((int)$totalLinks) ?></div>
                    <div class="stat-label"><?= __('Links Created') ?></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="stat-block">
                    <div class="stat-num" data-target="<?= (int)$totalUsers ?>"><?= number_format((int)$totalUsers) ?>+</div>
                    <div class="stat-label"><?= __('Active Publishers') ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ==================== HOW IT WORKS ==================== -->
<section>
    <div class="container text-center">
        <div class="section-label"><?= __('How It Works') ?></div>
        <h2 class="section-heading"><?= __('Start Earning in 3 Simple Steps') ?></h2>
        <p class="section-sub"><?= __('No technical skills needed. If you can paste a URL, you can earn money.') ?></p>
        <div class="row">
            <div class="col-sm-4">
                <div class="step-card">
                    <div class="step-num">01</div>
                    <h4 class="step-title"><?= __('Create a Free Account') ?></h4>
                    <p class="step-desc"><?= __('Sign up with just your email. Verification is instant. Zero cost, always.') ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="step-card">
                    <div class="step-num">02</div>
                    <h4 class="step-title"><?= __('Shorten & Share Your Link') ?></h4>
                    <p class="step-desc"><?= __('Paste any URL, get a short link in seconds. Share on any platform.') ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="step-card">
                    <div class="step-num">03</div>
                    <h4 class="step-title"><?= __('Watch Your Earnings Grow') ?></h4>
                    <p class="step-desc"><?= __('Get paid for every view. Withdraw anytime to your UPI or bank account.') ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== FEATURES ==================== -->
<section style="background: var(--surface); border-top: 1px solid var(--border-subtle); border-bottom: 1px solid var(--border-subtle);">
    <div class="container text-center">
        <div class="section-label"><?= __('Platform Features') ?></div>
        <h2 class="section-heading"><?= __('Everything ShortX Has. Plus More.') ?></h2>
        <p class="section-sub"><?= __('Built for Indian publishers who deserve a platform that actually works for them.') ?></p>
        <div class="row" style="text-align: left;">

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-qrcode"></i></div>
                    <h4 class="feature-title"><?= __('QR Code Generator') ?></h4>
                    <p class="feature-desc"><?= __('Every link gets an instant QR code. Download PNG, share on print or offline.') ?></p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-tag"></i></div>
                    <h4 class="feature-title"><?= __('Custom Branded Aliases') ?></h4>
                    <p class="feature-desc"><?= __('Replace random characters with your brand name. yoursite.com/instagram instead of xk39a.') ?></p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-bar-chart"></i></div>
                    <h4 class="feature-title"><?= __('Real-Time Analytics') ?></h4>
                    <p class="feature-desc"><?= __('See clicks, countries, devices, and earnings update live. Know exactly what\'s working.') ?></p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-mobile"></i></div>
                    <h4 class="feature-title"><?= __('UPI Payouts') ?></h4>
                    <p class="feature-desc"><?= __('Withdraw directly to GPay, PhonePe, Paytm, or your bank. Fast, no delays.') ?></p>
                </div>
            </div>

            <?php if ((bool)get_option('enable_referrals', 1)) : ?>
            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-users"></i></div>
                    <h4 class="feature-title"><?= __('{0}% Referral Commission', h(get_option('referral_percentage'))) ?></h4>
                    <p class="feature-desc"><?= __('Earn a lifetime cut of every rupee your referrals make. Share once, earn forever.') ?></p>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-shield"></i></div>
                    <h4 class="feature-title"><?= __('Password Protection') ?></h4>
                    <p class="feature-desc"><?= __('Lock any link behind a password. Perfect for exclusive content and gated communities.') ?></p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-clock-o"></i></div>
                    <h4 class="feature-title"><?= __('Link Expiration') ?></h4>
                    <p class="feature-desc"><?= __('Set expiry dates for flash sales, limited offers, or time-sensitive campaigns.') ?></p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-code"></i></div>
                    <h4 class="feature-title"><?= __('Developer REST API') ?></h4>
                    <p class="feature-desc"><?= __('Shorten and manage links programmatically. Supports PHP, Python, JavaScript, and more.') ?></p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-bullseye"></i></div>
                    <h4 class="feature-title"><?= __('Retargeting Pixels') ?></h4>
                    <p class="feature-desc"><?= __('Fire Facebook, Google, or TikTok pixels on your link visitors. Build audiences while you earn.') ?></p>
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
        'key'    => 'home_testimonials_' . locale_get_default(),
    ],
])
?>

<!-- ==================== CONTACT ==================== -->
<section id="contact">
    <div class="container">
        <div class="text-center">
            <div class="section-label"><?= __('Get In Touch') ?></div>
            <h2 class="section-heading"><?= __('Have a Question?') ?></h2>
            <p class="section-sub"><?= __('We respond within 24 hours. No bots.') ?></p>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="lm-contact-card">
                    <?= $this->element('contact'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->start('scriptBottom'); ?>
<script>
/* Animated stat counters */
(function () {
    function animateCount(el) {
        var target = parseInt(el.getAttribute('data-target') || el.innerText.replace(/[^0-9]/g, ''), 10);
        if (!target) return;
        var suffix = el.innerText.replace(/[0-9,]/g, '');
        var start = 0, dur = 2000;
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
