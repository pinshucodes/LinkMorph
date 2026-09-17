<?php
/**
 * Interstitial ad page — full page iframe ad with countdown
 */
$this->assign('title', get_option('site_name'));
$this->assign('description', get_option('description'));
$this->assign('og_title', $link->title);
$this->assign('og_description', $link->description);
$this->assign('og_image', $link->image);
?>

<?php $this->start('scriptTop'); ?>
<script>if (window.self !== window.top) { window.top.location.href = window.location.href; }</script>
<?php $this->end(); ?>

<style>
body { margin: 0 !important; padding: 0 !important; background: #000 !important; overflow: hidden; }

/* Full-screen iframe */
#lm-interstitial-frame {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    border: none;
    z-index: 1;
}

/* Floating skip bar at top */
#lm-skip-bar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 9999;
    background: rgba(9, 9, 11, 0.95);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255,255,255,.1);
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

.lm-skip-brand {
    font-weight: 800;
    font-size: 15px;
    color: #fff;
    letter-spacing: -0.03em;
    display: flex;
    align-items: center;
    gap: 8px;
}
.lm-skip-brand-dot {
    width: 7px; height: 7px;
    background: #6366f1;
    border-radius: 50%;
    box-shadow: 0 0 8px rgba(99,102,241,.6);
}

.lm-skip-countdown {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: rgba(255,255,255,.6);
    font-weight: 500;
}
.lm-skip-timer {
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 8px;
    padding: 4px 12px;
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    min-width: 44px;
    text-align: center;
}

/* Skip button — disabled at first */
#lm-skip-btn {
    background: #6366f1;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 9px 20px;
    font-size: 13px;
    font-weight: 700;
    cursor: not-allowed;
    opacity: .4;
    white-space: nowrap;
    transition: all .2s;
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}
#lm-skip-btn.ready {
    opacity: 1;
    cursor: pointer;
    animation: lm-ready-pulse .5s ease;
}
#lm-skip-btn.ready:hover {
    background: #4f46e5;
    box-shadow: 0 0 0 4px rgba(99,102,241,.3);
}
@keyframes lm-ready-pulse {
    0%   { transform: scale(1); }
    50%  { transform: scale(1.04); }
    100% { transform: scale(1); }
}

/* Progress bar */
#lm-progress {
    position: fixed;
    top: 53px;
    left: 0;
    height: 2px;
    background: linear-gradient(90deg, #6366f1, #a855f7);
    z-index: 9999;
    transition: width 1s linear;
}

/* Anti-adblock */
.myTestAd { height: 5px; width: 5px; position: absolute; }
</style>

<!-- Anti-adblock pixel -->
<div class="myTestAd"></div>

<!-- Full-screen iframe ad -->
<iframe id="lm-interstitial-frame" src="<?= $interstitial_ad_url ?>" scrolling="yes" allowtransparency="true"></iframe>

<!-- Top floating bar -->
<div id="lm-skip-bar">
    <div class="lm-skip-brand">
        <span class="lm-skip-brand-dot"></span>
        <?= h(get_option('site_name')) ?>
    </div>
    <div class="lm-skip-countdown">
        <span><?= __('Your link is ready in') ?></span>
        <span class="lm-skip-timer" id="lm-skip-timer">…</span>
        <span><?= __('sec') ?></span>
    </div>
    <button id="lm-skip-btn" disabled>
        <i class="fa fa-lock"></i>
        <span id="lm-skip-text"><?= __('Please wait') ?></span>
    </button>
</div>

<!-- Progress bar -->
<div id="lm-progress" style="width: 0%;"></div>

<!-- Hidden submit form -->
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
    /* Read timer from AdlinkFly JS vars if present, fallback to 10s */
    var total = (typeof app_vars !== 'undefined' && app_vars['timer']) ? parseInt(app_vars['timer']) : 10;
    var remaining = total;
    var timerEl = document.getElementById('lm-skip-timer');
    var btn     = document.getElementById('lm-skip-btn');
    var btnText = document.getElementById('lm-skip-text');
    var progress = document.getElementById('lm-progress');

    timerEl.textContent = remaining;
    progress.style.width = '0%';

    var ticker = setInterval(function () {
        remaining--;
        timerEl.textContent = remaining;
        /* Progress bar width */
        var pct = ((total - remaining) / total * 100).toFixed(1);
        progress.style.width = pct + '%';

        if (remaining <= 0) {
            clearInterval(ticker);
            progress.style.width = '100%';
            progress.style.background = 'linear-gradient(90deg, #22c55e, #16a34a)';

            timerEl.textContent = '✓';
            timerEl.style.color = '#22c55e';
            btn.disabled = false;
            btn.classList.add('ready');
            btn.innerHTML = '<i class="fa fa-external-link"></i> <?= __('Get My Link') ?>';
            btn.onclick = function () {
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
