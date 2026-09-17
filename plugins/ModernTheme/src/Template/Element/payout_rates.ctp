<?php
/**
 * @var \App\View\AppView $this
 */
$lang      = locale_get_default();
$countries = get_countries(true);

function getSortedRates($mode, $type) {
    if ($mode === 'simple') {
        $price = get_option('payout_rates_' . $type, []);
        uasort($price, function ($a, $b) {
            if (!isset($a[3]) || !isset($b[3])) return 0;
            return ($a[3] < $b[3]) ? 1 : -1;
        });
    } else {
        $price = get_option($type . '_price', []);
        uasort($price, function ($a, $b) {
            if (!isset($a[3]['publisher']) || !isset($b[3]['publisher'])) return 0;
            return ($a[3]['publisher'] < $b[3]['publisher']) ? 1 : -1;
        });
    }
    return $price;
}
function displayDesktop($val, $mode) {
    return display_price_currency($mode === 'simple' ? ($val[2] ?? 0) : ($val[2]['publisher'] ?? 0));
}
function displayMobile($val, $mode) {
    return display_price_currency($mode === 'simple' ? ($val[3] ?? 0) : ($val[3]['publisher'] ?? 0));
}
function hasValue($val, $mode) {
    if ($mode === 'simple') return !empty($val[2]) || !empty($val[3]);
    return !empty($val[2]['publisher']) || !empty($val[3]['publisher']);
}

$mode  = get_option('earning_mode');
$types = [];
if (get_option('enable_banner', 'yes') === 'yes') $types['banner'] = __('Banner Ads');
if (get_option('enable_interstitial', 'yes') === 'yes') $types['interstitial'] = __('Interstitial Ads');
if (get_option('enable_popup', 'yes') === 'yes') $types['popup'] = __('Popup Ads');

$topRates = [];
if (!empty($types)) {
    $firstType = array_key_first($types);
    $allRates  = getSortedRates($mode, $firstType);
    $count = 0;
    foreach ($allRates as $key => $value) {
        if (!hasValue($value, $mode) || $key === 'all') continue;
        $topRates[$key] = $value;
        if (++$count >= 5) break;
    }
}
?>

<link rel="stylesheet" href="https://fastly.jsdelivr.net/gh/lipis/flag-icon-css@3.3.0/css/flag-icon.min.css"/>

<style>
/* ── Payout Rates Page — Dark Premium ───── */
.lm-rates-hero {
    background: var(--surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 48px 40px;
    text-align: center;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
}
.lm-rates-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 80% 60% at 50% -10%, rgba(99,102,241,.12) 0%, transparent 70%);
    pointer-events: none;
}
.lm-rates-hero h2 {
    font-size: 32px;
    font-weight: 800;
    color: var(--text);
    letter-spacing: -0.04em;
    margin: 0 0 12px;
    position: relative;
}
.lm-rates-hero p {
    font-size: 16px;
    color: var(--text-muted);
    margin: 0;
    position: relative;
}
.lm-rates-hero .hero-accent {
    background: linear-gradient(135deg, #6366f1, #a855f7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Top country cards */
.lm-top-rates {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 16px;
    margin-bottom: 40px;
}
.lm-top-rate-card {
    background: var(--surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 24px 16px;
    text-align: center;
    transition: all .2s;
    position: relative;
    overflow: hidden;
}
.lm-top-rate-card:first-child {
    border-color: var(--accent);
    background: var(--accent-glow);
}
.lm-top-rate-card::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--accent-glow) 0%, transparent 60%);
    opacity: 0;
    transition: .2s;
}
.lm-top-rate-card:hover { transform: translateY(-3px); border-color: var(--border); }
.lm-top-rate-card:hover::after { opacity: 1; }
.lm-top-rate-card .flag-icon {
    font-size: 32px;
    border-radius: 4px;
    margin-bottom: 10px;
    display: block;
    box-shadow: 0 2px 6px rgba(0,0,0,.3);
}
.lm-top-rate-card .country-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 6px;
}
.lm-top-rate-card .rate-val {
    font-size: 22px;
    font-weight: 800;
    color: var(--text);
    letter-spacing: -0.03em;
}
.lm-top-rate-card:first-child .rate-val { color: var(--accent); }
.lm-top-rate-card .rate-per {
    font-size: 11px;
    color: var(--text-subtle);
    text-transform: uppercase;
    letter-spacing: .07em;
    font-weight: 600;
    margin-top: 3px;
}
.lm-top-badge {
    position: absolute;
    top: 10px; right: 10px;
    background: var(--accent);
    color: #fff;
    font-size: 9px;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: .06em;
}

/* Info strip */
.lm-rates-info {
    display: flex;
    gap: 20px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}
.lm-rates-info-item {
    flex: 1;
    min-width: 180px;
    background: var(--surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-lg);
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
}
.lm-rates-info-icon {
    width: 36px; height: 36px;
    background: var(--accent-glow);
    border: 1px solid var(--accent);
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    color: var(--accent);
    font-size: 15px;
    flex-shrink: 0;
}
.lm-rates-info-item h5 { font-size: 13px; font-weight: 700; color: var(--text); margin: 0 0 3px; }
.lm-rates-info-item p  { font-size: 12px; color: var(--text-subtle); margin: 0; line-height: 1.5; }

/* Tabs */
.lm-rates-tabs {
    display: flex;
    gap: 4px;
    border-bottom: 1px solid var(--border-subtle);
    margin-bottom: 24px;
}
.lm-rates-tabs a {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-subtle);
    padding: 10px 18px;
    border-radius: var(--radius) var(--radius) 0 0;
    border-bottom: 2px solid transparent;
    margin-bottom: -1px;
    transition: all .15s;
    display: inline-flex;
    align-items: center;
    gap: 7px;
}
.lm-rates-tabs a:hover { color: var(--text-muted); }
.lm-rates-tabs a.active {
    color: var(--accent) !important;
    border-bottom-color: var(--accent);
    background: var(--accent-glow);
}

/* Table */
.lm-rates-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    overflow: hidden;
    margin-bottom: 24px;
}
.lm-rates-table { width: 100%; border-collapse: collapse; margin: 0; }
.lm-rates-table thead tr {
    background: var(--surface-2);
    border-bottom: 1px solid var(--border-subtle);
}
.lm-rates-table thead th {
    font-size: 11px;
    font-weight: 700;
    color: var(--text-subtle);
    text-transform: uppercase;
    letter-spacing: .08em;
    padding: 14px 20px;
    text-align: left;
}
.lm-rates-table thead th:not(:first-child) { text-align: center; }
.lm-rates-table tbody tr { border-bottom: 1px solid var(--border-subtle); transition: .15s; }
.lm-rates-table tbody tr:last-child { border-bottom: none; }
.lm-rates-table tbody tr:hover { background: var(--surface-2); }
.lm-rates-table tbody td {
    padding: 14px 20px;
    color: var(--text-muted);
    font-size: 13px;
    vertical-align: middle;
}
.lm-rates-table tbody td:not(:first-child) { text-align: center; }
.lm-rates-table .flag-icon { margin-right: 10px; font-size: 16px; border-radius: 2px; }
.lm-rate-badge {
    display: inline-block;
    background: var(--accent-glow);
    color: var(--accent);
    border: 1px solid rgba(99,102,241,.2);
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
}
.lm-rate-badge.top { background: rgba(34,197,94,.1); color: var(--success); border-color: rgba(34,197,94,.2); }
.lm-rates-table .country-name { color: var(--text); font-weight: 500; }

/* CTA */
.lm-rates-cta {
    background: var(--surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--radius-xl);
    padding: 40px;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-top: 32px;
}
.lm-rates-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 60% at 50% 100%, rgba(99,102,241,.08) 0%, transparent 70%);
}
.lm-rates-cta h3 { font-size: 24px; font-weight: 800; color: var(--text); letter-spacing: -0.03em; margin-bottom: 10px; position: relative; }
.lm-rates-cta p  { font-size: 15px; color: var(--text-muted); margin-bottom: 24px; position: relative; }
.lm-rates-cta .lm-cta-btn {
    background: var(--accent);
    color: #fff !important;
    border: none;
    border-radius: var(--radius-lg);
    padding: 14px 32px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all .2s;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    position: relative;
}
.lm-rates-cta .lm-cta-btn:hover { background: var(--accent-hover); box-shadow: 0 0 0 6px var(--accent-glow); }
</style>

<!-- Hero -->
<div class="lm-rates-hero">
    <h2><?= __('Transparent') ?> <span class="hero-accent"><?= __('Publisher Payout Rates') ?></span></h2>
    <p><?= __('Earn more per click than any competitor. We pay you for every legitimate visitor — worldwide.') ?></p>
</div>

<!-- Top 5 rates -->
<?php if (!empty($topRates)) : ?>
<div class="lm-top-rates">
    <?php $i = 0; foreach ($topRates as $code => $val) :
        $isTop = ($i === 0);
    ?>
    <div class="lm-top-rate-card">
        <?php if ($isTop) : ?><span class="lm-top-badge"><?= __('Top Rate') ?></span><?php endif; ?>
        <span class="flag-icon flag-icon-<?= strtolower($code) ?>"></span>
        <div class="country-name"><?= $countries[$code] ?? $code ?></div>
        <div class="rate-val"><?= displayMobile($val, $mode) ?></div>
        <div class="rate-per"><?= __('per 1000 views') ?></div>
    </div>
    <?php $i++; endforeach; ?>
</div>
<?php endif; ?>

<!-- Info strip -->
<div class="lm-rates-info">
    <div class="lm-rates-info-item">
        <div class="lm-rates-info-icon"><i class="fa fa-calendar"></i></div>
        <div>
            <h5><?= __('When do I get paid?') ?></h5>
            <p><?= __('Withdraw anytime. Processed within 24 hours on working days.') ?></p>
        </div>
    </div>
    <div class="lm-rates-info-item">
        <div class="lm-rates-info-icon"><i class="fa fa-mobile"></i></div>
        <div>
            <h5><?= __('UPI &amp; Bank Transfers') ?></h5>
            <p><?= __('GPay, PhonePe, Paytm UPI, NEFT/IMPS direct to your account.') ?></p>
        </div>
    </div>
    <div class="lm-rates-info-item">
        <div class="lm-rates-info-icon"><i class="fa fa-shield"></i></div>
        <div>
            <h5><?= __('Fraud Protection') ?></h5>
            <p><?= __('Bot clicks and proxy traffic are filtered. Only real views counted.') ?></p>
        </div>
    </div>
    <div class="lm-rates-info-item">
        <div class="lm-rates-info-icon"><i class="fa fa-inr"></i></div>
        <div>
            <h5><?= __('Minimum Withdrawal') ?></h5>
            <p><?= display_price_currency(get_option('minimum_withdrawal_amount')) . ' ' . __('minimum — no lock-in periods.') ?></p>
        </div>
    </div>
</div>

<!-- Rates tables -->
<?php if (!empty($types)) : ?>

<div class="payout-rates">
    <!-- Tab nav -->
    <div class="lm-rates-tabs">
        <?php $first = true; foreach ($types as $typeId => $typeLabel) :
            $icon = ['banner' => 'fa-image', 'interstitial' => 'fa-desktop', 'popup' => 'fa-window-restore'][$typeId] ?? 'fa-ad';
        ?>
        <a href="#lm-tab-<?= $typeId ?>" class="lm-tab-link <?= $first ? 'active' : '' ?>" data-tab="lm-tab-<?= $typeId ?>">
            <i class="fa <?= $icon ?>"></i> <?= $typeLabel ?>
        </a>
        <?php $first = false; endforeach; ?>
    </div>

    <!-- Tab panes -->
    <?php $first = true; foreach ($types as $typeId => $typeLabel) : ?>
    <div id="lm-tab-<?= $typeId ?>" class="lm-tab-pane" style="<?= $first ? '' : 'display:none;' ?>">
        <div class="lm-rates-table-wrap table-responsive">
            <table class="lm-rates-table">
                <thead>
                    <tr>
                        <th><?= __('Country') ?></th>
                        <th><?= __('Desktop') ?></th>
                        <th><?= __('Mobile / Tablet') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rates = getSortedRates($mode, $typeId);
                    $row = 0;
                    foreach ($rates as $key => $value) :
                        if (!hasValue($value, $mode)) continue;
                        $isTopRow = ($row < 3);
                    ?>
                    <tr>
                        <td>
                            <span class="flag-icon flag-icon-<?= strtolower($key) ?>"></span>
                            <span class="country-name">
                                <?= $key === 'all' ? __('Worldwide (All Countries)') : ($countries[$key] ?? $key) ?>
                            </span>
                        </td>
                        <td><span class="lm-rate-badge <?= $isTopRow ? 'top' : '' ?>"><?= displayDesktop($value, $mode) ?></span></td>
                        <td><span class="lm-rate-badge <?= $isTopRow ? 'top' : '' ?>"><?= displayMobile($value, $mode) ?></span></td>
                    </tr>
                    <?php $row++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php $first = false; endforeach; ?>
</div>

<?php endif; ?>

<!-- CTA -->
<div class="lm-rates-cta">
    <h3><?= __('Ready to Start Earning?') ?></h3>
    <p><?= __('Create your free account in 60 seconds. No credit card. No hidden fees. Just money.') ?></p>
    <a href="<?= build_main_domain_url('/auth/register') ?>" class="lm-cta-btn">
        <i class="fa fa-rocket"></i> <?= __('Start Earning Free') ?>
    </a>
</div>

<script>
/* Simple tab switcher */
document.addEventListener('DOMContentLoaded', function () {
    var links = document.querySelectorAll('.lm-tab-link');
    links.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            links.forEach(function (l) { l.classList.remove('active'); });
            document.querySelectorAll('.lm-tab-pane').forEach(function (p) { p.style.display = 'none'; });
            link.classList.add('active');
            var target = document.getElementById(link.getAttribute('data-tab'));
            if (target) target.style.display = 'block';
        });
    });
});
</script>
