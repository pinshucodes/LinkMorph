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
<header class="shorten text-center">
    <div class="container">
        
        <div class="intro-lead-in"><?= __('URL Shortener & Monetization Platform') ?></div>
        
        <h1 class="intro-heading">
            <?= __('Shorten Links.') ?> <span class="highlight"><?= __('Earn Money.') ?></span>
        </h1>
        
        <p class="intro-sub">
            <?= __('Paste your long URL below and start earning with every click. Join thousands of publishers already making money with the best rates in India.') ?>
        </p>

        <?php if (get_option('home_shortening') == 'yes') : ?>
            <div class="hero-shorten-wrap">
                <?= $this->element('shorten'); ?>
            </div>
        <?php endif; ?>

        <div class="hero-trust">
            <span><i class="fa fa-check-circle"></i> <?= __('Free forever') ?></span>
            <span><i class="fa fa-check-circle"></i> <?= __('Instant setup') ?></span>
            <span><i class="fa fa-check-circle"></i> <?= __('Payouts via UPI') ?></span>
            <span><i class="fa fa-check-circle"></i> <?= __('No credit card needed') ?></span>
        </div>

    </div>
</header>

<!-- ==================== STATS BAR ==================== -->
<?php if ((bool)get_option('display_home_stats', 1)) : ?>
<section class="stats">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="stat-card">
                    <div class="stat-num" id="count-clicks"><?= number_format((int)$totalClicks) ?></div>
                    <div class="stat-text"><?= __('Total Clicks Served') ?></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="stat-card">
                    <div class="stat-num" id="count-links"><?= number_format((int)$totalLinks) ?></div>
                    <div class="stat-text"><?= __('Links Shortened') ?></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="stat-card">
                    <div class="stat-num" id="count-users"><?= number_format((int)$totalUsers) ?>+</div>
                    <div class="stat-text"><?= __('Active Publishers') ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ==================== HOW IT WORKS ==================== -->
<section>
    <div class="container">
        <div class="section-title">
            <div class="section-subheading"><?= __('Simple Process') ?></div>
            <h2 class="section-heading"><?= __('Start Earning in 3 Steps') ?></h2>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="step-card">
                    <div class="step-icon"><i class="fa fa-user-plus"></i></div>
                    <h4 class="step-title"><?= __('1. Create an Account') ?></h4>
                    <p class="step-desc"><?= __('Sign up in seconds. No credit card required, completely free to use.') ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="step-card">
                    <div class="step-icon"><i class="fa fa-link"></i></div>
                    <h4 class="step-title"><?= __('2. Shorten your Link') ?></h4>
                    <p class="step-desc"><?= __('Paste your long URL, optionally add an alias, and get a neat short link.') ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="step-card">
                    <div class="step-icon"><i class="fa fa-money"></i></div>
                    <h4 class="step-title"><?= __('3. Earn Money') ?></h4>
                    <p class="step-desc"><?= __('Share your link everywhere. Get paid for every visitor. Withdraw via UPI.') ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== WHY JOIN US ==================== -->
<section class="bg-light-gray">
    <div class="container">
        <div class="section-title">
            <div class="section-subheading"><?= __('Platform Features') ?></div>
            <h2 class="section-heading"><?= __('Why Publishers Choose Us') ?></h2>
        </div>
        <div class="row">
            
            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-qrcode"></i></div>
                    <h4 class="feature-title"><?= __('QR Code Generator') ?></h4>
                    <p class="feature-desc"><?= __('Every link comes with a downloadable QR code. Perfect for print, WhatsApp, and offline sharing.') ?></p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-tag"></i></div>
                    <h4 class="feature-title"><?= __('Custom Alias') ?></h4>
                    <p class="feature-desc"><?= __('Brand your short links with a memorable custom alias instead of random characters.') ?></p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-bar-chart"></i></div>
                    <h4 class="feature-title"><?= __('Detailed Analytics') ?></h4>
                    <p class="feature-desc"><?= __('Track clicks, countries, devices, and referrers in real time. Know exactly who is clicking.') ?></p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-inr"></i></div>
                    <h4 class="feature-title"><?= __('Fast UPI Payouts') ?></h4>
                    <p class="feature-desc"><?= __('Earn in ₹ and withdraw directly to your UPI / Bank account. Minimum withdrawal just ') . display_price_currency(get_option('minimum_withdrawal_amount')) . '.'; ?></p>
                </div>
            </div>

            <?php if ((bool)get_option('enable_referrals', 1)) : ?>
            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-users"></i></div>
                    <h4 class="feature-title"><?= __('{0}% Referral Bonus', h(get_option('referral_percentage'))) ?></h4>
                    <p class="feature-desc"><?= __('Invite friends and earn {0}% of their lifetime earnings. The more you share, the more you make.', h(get_option('referral_percentage'))) ?></p>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-md-4 col-sm-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-clock-o"></i></div>
                    <h4 class="feature-title"><?= __('Link Expiration') ?></h4>
                    <p class="feature-desc"><?= __('Set expiry dates on links for time-sensitive campaigns. Expired links auto-redirect safely.') ?></p>
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
<section id="contact">
    <div class="container">
        <div class="section-title">
            <div class="section-subheading"><?= __('Get In Touch') ?></div>
            <h2 class="section-heading"><?= __("Have a Question?") ?></h2>
        </div>
        
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?= $this->element('contact'); ?>
            </div>
        </div>
    </div>
</section>

<?php $this->start('scriptBottom'); ?>
<script>
/* Simple stat counter animation */
document.addEventListener("DOMContentLoaded", function() {
    function animateValue(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString('en-IN');
            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                if(obj.id === 'count-users') obj.innerHTML += '+';
            }
        };
        window.requestAnimationFrame(step);
    }

    const statElements = [
        { id: 'count-clicks', val: <?= (int)$totalClicks ?> },
        { id: 'count-links', val: <?= (int)$totalLinks ?> },
        { id: 'count-users', val: <?= (int)$totalUsers ?> }
    ];

    if ('IntersectionObserver' in window) {
        let observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    let el = entry.target;
                    let targetVal = parseInt(el.innerText.replace(/,/g, ''), 10);
                    animateValue(el, 0, targetVal, 2000);
                    observer.unobserve(el);
                }
            });
        }, {threshold: 0.5});
        
        statElements.forEach(item => {
            let el = document.getElementById(item.id);
            if(el) observer.observe(el);
        });
    }
});
</script>
<?php $this->end(); ?>
