<?php
/**
 * Banner ad page — countdown timer then "Get Link" button
 */
$this->assign('title', get_option('site_name'));
$this->assign('description', get_option('description'));
$this->assign('og_title', $link->title);
$this->assign('og_description', $link->description);
$this->assign('og_image', $link->image);

$timer_seconds = $link_user_plan->timer ?? 5;
?>

<?php $this->start('scriptTop'); ?>
<script>if (window.self !== window.top) { window.top.location.href = window.location.href; }</script>
<?php $this->end(); ?>

<style>
/* ── Banner Ad Page — Dark Premium UI ─── */
.lm-banner-page {
    background: var(--bg);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}
.lm-banner-top-ad {
    width: 100%;
    max-width: 728px;
    margin: 0 auto 24px;
    text-align: center;
}
.lm-banner-main {
    width: 100%;
    max-width: 640px;
}
.lm-banner-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 36px;
    text-align: center;
    box-shadow: 0 24px 80px rgba(0,0,0,.5);
}
.lm-site-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
    letter-spacing: -0.02em;
    margin-bottom: 24px;
}
.lm-site-badge-dot {
    width: 7px; height: 7px;
    background: var(--accent);
    border-radius: 50%;
    box-shadow: 0 0 8px rgba(99,102,241,.6);
}

/* Countdown ring */
.lm-timer-wrap {
    position: relative;
    width: 100px; height: 100px;
    margin: 0 auto 24px;
}
.lm-timer-svg {
    position: absolute;
    inset: 0;
    transform: rotate(-90deg);
}
.lm-timer-track { fill: none; stroke: var(--surface-2); stroke-width: 4; }
.lm-timer-fill  { fill: none; stroke: var(--accent); stroke-width: 4; stroke-linecap: round;
    stroke-dasharray: 283; stroke-dashoffset: 0;
    transition: stroke-dashoffset 1s linear; }
.lm-timer-num {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    font-weight: 800;
    color: var(--text);
    letter-spacing: -0.03em;
}
.lm-timer-label {
    font-size: 12px;
    color: var(--text-subtle);
    text-transform: uppercase;
    letter-spacing: .08em;
    font-weight: 600;
    margin-bottom: 24px;
}

/* Link preview */
.lm-preview {
    background: var(--surface-2);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-lg);
    padding: 14px 18px;
    margin-bottom: 24px;
    text-align: left;
    display: flex;
    align-items: flex-start;
    gap: 14px;
}
.lm-preview-thumb {
    width: 48px; height: 48px;
    object-fit: cover;
    border-radius: var(--radius);
    flex-shrink: 0;
}
.lm-preview-text h4 {
    font-size: 14px; font-weight: 600; color: var(--text);
    margin: 0 0 3px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.lm-preview-text p {
    font-size: 12px; color: var(--text-muted);
    margin: 0;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}

/* Ad slots */
.lm-ad-mid {
    margin: 16px 0;
    text-align: center;
}
.lm-ad-square { margin: 20px auto; text-align: center; }

/* Get Link button */
.lm-get-link-btn {
    background: var(--accent);
    color: #fff !important;
    border: none;
    border-radius: var(--radius-lg);
    padding: 16px 40px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    letter-spacing: -0.02em;
    text-decoration: none !important;
    opacity: .4;
    pointer-events: none;
}
.lm-get-link-btn.ready {
    opacity: 1;
    pointer-events: auto;
    animation: lm-pulse-btn .6s ease;
    box-shadow: 0 0 0 0 var(--accent-ring);
}
.lm-get-link-btn.ready:hover {
    background: var(--accent-hover);
    box-shadow: 0 0 0 6px var(--accent-glow);
    transform: translateY(-1px);
}
@keyframes lm-pulse-btn {
    0%   { box-shadow: 0 0 0 0 var(--accent-ring); }
    100% { box-shadow: 0 0 0 12px rgba(99,102,241,0); }
}
.lm-disclaimer {
    font-size: 12px;
    color: var(--text-subtle);
    margin-top: 20px;
    line-height: 1.6;
}
.lm-disclaimer a { color: var(--accent); }

/* Blog post teaser */
.lm-blog-teaser {
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid var(--border-subtle);
    text-align: left;
}
.lm-blog-teaser .blog-from {
    font-size: 11px;
    color: var(--text-subtle);
    text-transform: uppercase;
    letter-spacing: .08em;
    font-weight: 600;
    margin-bottom: 6px;
}
.lm-blog-teaser h4 { font-size: 14px; font-weight: 600; color: var(--text); margin: 0 0 4px; }
.lm-blog-teaser p  { font-size: 13px; color: var(--text-muted); margin: 0; }

/* Bottom ad */
.lm-banner-bottom-ad {
    width: 100%;
    max-width: 728px;
    margin: 24px auto 0;
    text-align: center;
}

/* Anti-adblock */
.myTestAd { height: 5px; width: 5px; position: absolute; }
</style>

<div class="lm-banner-page">

    <!-- Top leaderboard ad (728×90) -->
    <?php if (!empty($banner_728x90)) : ?>
    <div class="lm-banner-top-ad">
        <?= $banner_728x90 ?>
    </div>
    <?php endif; ?>

    <div class="lm-banner-main">
        <div class="lm-banner-card">

            <!-- Site badge -->
            <div class="lm-site-badge">
                <span class="lm-site-badge-dot"></span>
                <?= h(get_option('site_name')) ?>
            </div>

            <!-- Countdown timer ring -->
            <div class="lm-timer-wrap">
                <svg class="lm-timer-svg" viewBox="0 0 100 100">
                    <circle class="lm-timer-track" cx="50" cy="50" r="45"/>
                    <circle class="lm-timer-fill" id="lm-timer-fill" cx="50" cy="50" r="45"/>
                </svg>
                <div class="lm-timer-num" id="lm-timer-display"><?= $timer_seconds ?></div>
            </div>
            <div class="lm-timer-label"><?= __('seconds until your link is ready') ?></div>

            <!-- Link preview -->
            <?php if (
                get_option('short_link_content', 'no') === 'yes' &&
                (!empty($link->title) || !empty($link->description) || !empty($link->image))
            ) : ?>
            <div class="lm-preview">
                <?php if (!empty($link->image)) : ?>
                    <img class="lm-preview-thumb" src="<?= h($link->image) ?>" alt="">
                <?php endif; ?>
                <div class="lm-preview-text">
                    <?php if (!empty($link->title)) : ?>
                        <h4><?= h($link->title) ?></h4>
                    <?php endif; ?>
                    <?php if (!empty($link->description)) : ?>
                        <p><?= h($link->description) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Middle ad (468×60) -->
            <?php if (!empty($banner_468x60)) : ?>
            <div class="lm-ad-mid"><?= $banner_468x60 ?></div>
            <?php endif; ?>

            <!-- Get Link button -->
            <a href="javascript:void(0)" class="lm-get-link-btn" id="lm-get-link">
                <i class="fa fa-lock"></i>
                <span id="lm-btn-text"><?= __('Please wait…') ?></span>
            </a>

            <!-- Square ad (336×280) -->
            <?php if (!empty($banner_336x280)) : ?>
            <div class="lm-ad-square"><?= $banner_336x280 ?></div>
            <?php endif; ?>

            <!-- Blog teaser -->
            <?php if ($post) : ?>
            <div class="lm-blog-teaser">
                <div class="blog-from">
                    <a href="<?= build_main_domain_url('/blog') ?>" style="color: var(--accent);"><?= __('From Our Blog') ?></a>
                </div>
                <h4><?= h($post->title) ?></h4>
                <p><?= $post->description ?></p>
            </div>
            <?php endif; ?>

            <p class="lm-disclaimer">
                <?= __('By proceeding, you agree to our') ?>
                <a href="<?= build_main_domain_url('/page/terms-of-service') ?>"><?= __('Terms') ?></a>
                &amp;
                <a href="<?= build_main_domain_url('/page/privacy-policy') ?>"><?= __('Privacy Policy') ?></a>.
                <?= __('Ad revenue supports free link shortening for everyone.') ?>
            </p>
        </div>
    </div>

    <!-- Bottom leaderboard ad -->
    <?php if (!empty($banner_728x90)) : ?>
    <div class="lm-banner-bottom-ad">
        <?= $banner_728x90 ?>
    </div>
    <?php endif; ?>
</div>

<!-- Anti-adblock pixel -->
<div class="myTestAd"></div>

<!-- Hidden form to submit when timer expires -->
<?= $this->Form->create(null, ['url' => ['controller' => 'Links', 'action' => 'go', 'prefix' => false], 'id' => 'go-link', 'class' => 'hidden']); ?>
<?= $this->Form->hidden('ad_form_data', ['value' => $ad_form_data]); ?>
<?= $this->Form->button(__('Submit'), ['id' => 'go-submit', 'class' => 'hidden']); ?>
<?= $this->Form->end(); ?>

<?php if (get_option('enable_popup', 'yes') == 'yes' && $show_pop_ad) : ?>
<?= $this->Form->create(null, ['url' => ['controller' => 'Links', 'action' => 'popad', 'prefix' => false], 'target' => '_blank', 'id' => 'go-popup', 'class' => 'hidden']); ?>
<?= $this->Form->hidden('pop_ad', ['value' => $pop_ad]); ?>
<?= $this->Form->end(); ?>
<?php endif; ?>

<?php $this->start('scriptBottom'); ?>
<script>
(function () {
    var total = <?= (int)$timer_seconds ?>;
    var remaining = total;
    var fill = document.getElementById('lm-timer-fill');
    var display = document.getElementById('lm-timer-display');
    var btn = document.getElementById('lm-get-link');
    var btnText = document.getElementById('lm-btn-text');
    var circumference = 283; /* 2π × 45 */

    function setProgress(secs) {
        var offset = circumference * (1 - secs / total);
        fill.style.strokeDashoffset = circumference - (circumference * secs / total);
    }

    setProgress(total);

    var ticker = setInterval(function () {
        remaining--;
        display.textContent = remaining;
        setProgress(remaining);

        if (remaining <= 0) {
            clearInterval(ticker);
            display.innerHTML = '<i class="fa fa-check" style="font-size:20px;color:var(--success);"></i>';
            fill.style.stroke = 'var(--success)';
            btn.classList.add('ready');
            btn.innerHTML = '<i class="fa fa-external-link"></i> <?= __('Get My Link') ?>';
            btn.onclick = function (e) {
                e.preventDefault();
                document.getElementById('go-submit').click();
                <?php if (get_option('enable_popup', 'yes') == 'yes' && $show_pop_ad) : ?>
                document.getElementById('go-popup').submit();
                <?php endif; ?>
            };
        }
    }, 1000);
}());
</script>
<?php $this->end(); ?>
