<?php
/**
 * @var \App\View\AppView $this
 * @var array $a
 * @var array $b
 */
$lang = locale_get_default();
$countries = get_countries(true);
?>
<link rel="stylesheet" href="https://fastly.jsdelivr.net/gh/lipis/flag-icon-css@3.3.0/css/flag-icon.min.css"/>

<style>
/* Modern Payout Rates UI */
.rates-header-card {
    background: linear-gradient(135deg, #0f172a, #1e1b4b);
    border-radius: 16px;
    padding: 30px;
    color: #fff;
    margin-bottom: 30px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(15,23,42,0.15);
}
.rates-header-card h3 {
    color: #fff;
    margin-top: 0;
    margin-bottom: 15px;
    font-size: 24px;
}
.rates-header-card p {
    color: rgba(255,255,255,0.7);
    margin-bottom: 0;
    font-size: 16px;
}
.top-rates-grid {
    display: flex;
    gap: 20px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}
.top-rate-card {
    flex: 1;
    min-width: 250px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s;
}
.top-rate-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-color: #22c55e;
}
.top-rate-card .flag-icon {
    font-size: 40px;
    border-radius: 4px;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.top-rate-card h4 {
    margin: 0 0 15px;
    font-size: 18px;
    color: #0f172a;
}
.top-rate-card .rate-value {
    font-size: 28px;
    font-weight: 800;
    color: #22c55e;
}
.top-rate-card .rate-label {
    font-size: 12px;
    text-transform: uppercase;
    color: #64748b;
    letter-spacing: 1px;
    margin-top: 5px;
}

/* Tabs Redesign */
.nav-tabs.modern-tabs {
    border-bottom: 2px solid #e2e8f0;
    margin-bottom: 25px;
    display: flex;
    justify-content: center;
}
.nav-tabs.modern-tabs > li {
    margin-bottom: -2px;
}
.nav-tabs.modern-tabs > li > a {
    border: none;
    background: transparent;
    color: #64748b;
    font-weight: 600;
    font-size: 16px;
    padding: 12px 24px;
    border-bottom: 2px solid transparent;
    border-radius: 0;
    transition: all 0.2s;
}
.nav-tabs.modern-tabs > li > a:hover {
    color: #0f172a;
    background: transparent;
    border-bottom-color: #cbd5e1;
}
.nav-tabs.modern-tabs > li.active > a,
.nav-tabs.modern-tabs > li.active > a:focus,
.nav-tabs.modern-tabs > li.active > a:hover {
    border: none;
    background: transparent;
    color: #22c55e;
    border-bottom: 2px solid #22c55e;
}

/* Modern Table */
.modern-table-wrap {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
}
.table.modern-table {
    margin-bottom: 0;
}
.table.modern-table thead > tr > th {
    border-bottom: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #475569;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 16px 20px;
    font-weight: 700;
}
.table.modern-table tbody > tr > td {
    padding: 16px 20px;
    vertical-align: middle;
    border-top: 1px solid #e2e8f0;
    color: #1e293b;
    font-weight: 500;
}
.table.modern-table tbody > tr:hover > td {
    background: #f8fafc;
}
.table.modern-table .flag-icon {
    margin-right: 12px;
    font-size: 18px;
    border-radius: 2px;
}
.rate-badge {
    background: #f0fdf4;
    color: #16a34a;
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 700;
    display: inline-block;
}
</style>

<div class="rates-header-card">
    <h3><?= __('Industry Leading Payout Rates') ?></h3>
    <p><?= __('We pay you for every legitimate visitor you bring to your links. Check our dynamic rates below.') ?></p>
</div>

<?php 
// Helper to get prices based on earning mode
function getSortedRates($mode, $type) {
    if ($mode === 'simple') {
        $price = get_option('payout_rates_' . $type, []);
        uasort($price, function ($a, $b) {
            if (!isset($a[3]) || !isset($b[3])) return 0;
            if ($a[3] === $b[3]) return 0;
            return ($a[3] < $b[3]) ? 1 : -1;
        });
        return $price;
    } else {
        $price = get_option($type . '_price', []);
        uasort($price, function ($a, $b) {
            if (!isset($a[3]['publisher']) || !isset($b[3]['publisher'])) return 0;
            if ($a[3]['publisher'] == $b[3]['publisher']) return 0;
            return ($a[3]['publisher'] < $b[3]['publisher']) ? 1 : -1;
        });
        return $price;
    }
}

function displayDesktop($val, $mode) {
    return display_price_currency($mode === 'simple' ? $val[2] : $val[2]['publisher']);
}
function displayMobile($val, $mode) {
    return display_price_currency($mode === 'simple' ? $val[3] : $val[3]['publisher']);
}
function hasValue($val, $mode) {
    if ($mode === 'simple') return !empty($val[2]) || !empty($val[3]);
    return !empty($val[2]['publisher']) || !empty($val[3]['publisher']);
}

$mode = get_option('earning_mode');
$types = [];
if (get_option('enable_banner', 'yes') === 'yes') $types['banner'] = __('Banner');
if (get_option('enable_interstitial', 'yes') === 'yes') $types['interstitial'] = __('Interstitial');
if (get_option('enable_popup', 'yes') === 'yes') $types['popup'] = __('Popup');

// Find top 3 rates from the first available type to show in highlights
$topRates = [];
if (!empty($types)) {
    $firstType = array_key_first($types);
    $allRates = getSortedRates($mode, $firstType);
    $count = 0;
    foreach($allRates as $key => $value) {
        if (!hasValue($value, $mode) || $key === 'all') continue;
        $topRates[$key] = $value;
        $count++;
        if ($count >= 3) break;
    }
}
?>

<?php if (!empty($topRates)): ?>
<div class="top-rates-grid">
    <?php foreach($topRates as $countryCode => $val): ?>
    <div class="top-rate-card">
        <span class="flag-icon flag-icon-<?= strtolower($countryCode) ?>"></span>
        <h4><?= $countries[$countryCode] ?? $countryCode ?></h4>
        <div class="rate-value"><?= displayMobile($val, $mode) ?></div>
        <div class="rate-label"><?= __('Per 1000 Views') ?></div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php if (!empty($types)) : ?>
<div class="payout-rates-container">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs modern-tabs" role="tablist">
        <?php $active = true; foreach($types as $typeId => $typeLabel): ?>
            <li role="presentation" class="<?= $active ? 'active' : '' ?>">
                <a href="#tab-<?= $typeId ?>" aria-controls="tab-<?= $typeId ?>" role="tab" data-toggle="tab">
                    <?= $typeLabel ?>
                </a>
            </li>
        <?php $active = false; endforeach; ?>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <?php $active = true; foreach($types as $typeId => $typeLabel): ?>
            <div role="tabpanel" class="tab-pane <?= $active ? 'active' : '' ?>" id="tab-<?= $typeId ?>">
                <div class="modern-table-wrap table-responsive">
                    <table class="table modern-table">
                        <thead>
                            <tr>
                                <th><?= __('Country') ?></th>
                                <th style="text-align: center;"><?= __('Desktop') ?></th>
                                <th style="text-align: center;"><?= __('Mobile / Tablet') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $rates = getSortedRates($mode, $typeId);
                            foreach ($rates as $key => $value) : 
                                if (!hasValue($value, $mode)) continue;
                            ?>
                                <tr>
                                    <td>
                                        <span class="flag-icon flag-icon-<?= strtolower($key) ?>"></span>
                                        <?= $key === 'all' ? __('Worldwide Deal (All Countries)') : ($countries[$key] ?? $key) ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <span class="rate-badge"><?= displayDesktop($value, $mode) ?></span>
                                    </td>
                                    <td style="text-align: center;">
                                        <span class="rate-badge"><?= displayMobile($value, $mode) ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php $active = false; endforeach; ?>
    </div>
</div>
<?php endif; ?>
