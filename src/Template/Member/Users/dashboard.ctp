<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $logged_user
 * @var \App\Model\Entity\Plan $logged_user_plan
 * @var \App\Model\Entity\Announcement[]|\Cake\Collection\CollectionInterface $announcements
 * @var mixed $CurrentMonthDays
 * @var mixed $referral_earnings
 * @var mixed $total_earnings
 * @var mixed $total_views
 * @var mixed $year_month
 */
$this->assign('title', __('Dashboard'));
$this->assign('description', '');
$this->assign('content_title', __('Dashboard'));
?>

<style>
/* ── Dashboard Modern Overrides ───────────────────────────── */
body.skin-blue .content-wrapper,
body.skin-blue-light .content-wrapper,
.content-wrapper { background: #f8fafc; }

/* Stat cards */
.lm-stat-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
    display: flex;
    align-items: center;
    gap: 16px;
    transition: transform .2s, box-shadow .2s;
}
.lm-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,.08);
}
.lm-stat-icon {
    width: 52px; height: 52px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}
.lm-stat-icon.green  { background: #f0fdf4; color: #16a34a; }
.lm-stat-icon.blue   { background: #eff6ff; color: #2563eb; }
.lm-stat-icon.purple { background: #faf5ff; color: #7c3aed; }
.lm-stat-icon.orange { background: #fff7ed; color: #ea580c; }
.lm-stat-body h3 {
    margin: 0 0 4px;
    font-size: 26px;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.03em;
    font-family: 'Inter', sans-serif;
}
.lm-stat-body p {
    margin: 0;
    font-size: 13px;
    color: #64748b;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.06em;
}

/* Month selector */
.lm-month-select {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 10px 16px;
    font-size: 14px;
    font-family: 'Inter', sans-serif;
    color: #1e293b;
    box-shadow: 0 1px 2px rgba(0,0,0,.04);
    cursor: pointer;
    min-width: 220px;
}
.lm-month-select:focus { outline: none; border-color: #22c55e; box-shadow: 0 0 0 3px rgba(34,197,94,.15); }

/* Chart container */
.lm-chart-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
}
.lm-chart-card h3 {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 20px;
    font-family: 'Inter', sans-serif;
    display: flex;
    align-items: center;
    gap: 8px;
}
.lm-chart-card h3 .fa { color: #22c55e; }
.lm-chart-timezone {
    font-size: 12px;
    color: #94a3b8;
    margin-top: 10px;
    text-align: right;
}

/* Stats table */
.lm-stats-table { width: 100%; border-collapse: collapse; font-family: 'Inter', sans-serif; }
.lm-stats-table thead th {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #64748b;
    padding: 12px 16px;
    border-bottom: 1px solid #e2e8f0;
    background: #f8fafc;
}
.lm-stats-table tbody td {
    padding: 12px 16px;
    font-size: 14px;
    color: #1e293b;
    border-bottom: 1px solid #f1f5f9;
}
.lm-stats-table tbody tr:last-child td { border-bottom: none; }
.lm-stats-table tbody tr:hover td { background: #f8fafc; }
.lm-earn-badge {
    background: #f0fdf4;
    color: #16a34a;
    padding: 3px 10px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 13px;
    display: inline-block;
}

/* Announcements */
.lm-announce-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 0;
    margin-bottom: 20px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
}
.lm-announce-header {
    padding: 16px 24px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
    font-size: 15px;
    color: #0f172a;
    font-family: 'Inter', sans-serif;
}
.lm-announce-header .fa { color: #22c55e; }
.lm-announce-item {
    padding: 16px 24px;
    border-bottom: 1px solid #f1f5f9;
}
.lm-announce-item:last-child { border-bottom: none; }
.lm-announce-item p { margin: 0; color: #475569; font-size: 14px; line-height: 1.7; }
.lm-announce-item .announce-meta {
    font-size: 12px;
    color: #94a3b8;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.lm-announce-item strong { color: #0f172a; }
</style>

<!-- ── Month Picker ──────────────────────────────────────── -->
<div class="text-center" style="margin-bottom: 24px;">
    <?=
    $this->Form->create(null, [
        'type' => 'get',
        'url'  => ['controller' => 'Users', 'action' => 'dashboard'],
    ]);
    ?>
    <?=
    $this->Form->control('month', [
        'label'    => false,
        'options'  => $year_month,
        'value'    => ($this->request->getQuery('month')) ? h($this->request->getQuery('month')) : '',
        'class'    => 'lm-month-select',
        'onchange' => 'this.form.submit();',
    ]);
    ?>
    <?= $this->Form->button(__('Submit'), ['class' => 'hidden']); ?>
    <?= $this->Form->end(); ?>
</div>

<!-- ── Stat Cards ────────────────────────────────────────── -->
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="lm-stat-card">
            <div class="lm-stat-icon blue"><i class="fa fa-eye"></i></div>
            <div class="lm-stat-body">
                <h3><?= number_format((int)$total_views) ?></h3>
                <p><?= __('Total Views') ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="lm-stat-card">
            <div class="lm-stat-icon green"><i class="fa fa-inr"></i></div>
            <div class="lm-stat-body">
                <h3><?= display_price_currency($total_earnings) ?></h3>
                <p><?= __('Link Earnings') ?></p>
            </div>
        </div>
    </div>
    <?php if ((bool)get_option('enable_referrals', 1)) : ?>
    <div class="col-lg-3 col-sm-6">
        <div class="lm-stat-card">
            <div class="lm-stat-icon purple"><i class="fa fa-users"></i></div>
            <div class="lm-stat-body">
                <h3><?= display_price_currency($referral_earnings) ?></h3>
                <p><?= __('Referral Earnings') ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-lg-3 col-sm-6">
        <div class="lm-stat-card">
            <div class="lm-stat-icon orange"><i class="fa fa-bar-chart"></i></div>
            <div class="lm-stat-body">
                <h3><?= (!empty($total_views)) ? display_price_currency($total_earnings / $total_views * 1000) : '0.00' ?></h3>
                <p><?= __('Average CPM') ?></p>
            </div>
        </div>
    </div>
</div>

<!-- ── Announcements ────────────────────────────────────── -->
<?php if (count($announcements) > 0) : ?>
<div class="lm-announce-card">
    <div class="lm-announce-header">
        <i class="fa fa-bullhorn"></i>
        <?= __('Announcements') ?>
    </div>
    <?php foreach ($announcements as $announcement) : ?>
        <div class="lm-announce-item">
            <div class="announce-meta">
                <i class="fa fa-clock-o"></i>
                <strong><?= h($announcement->title) ?></strong>
                &mdash; <?= h($announcement->created) ?>
            </div>
            <p><?= $announcement->content ?></p>
        </div>
    <?php endforeach; ?>
    <?php unset($announcement) ?>
</div>
<?php endif; ?>

<!-- ── Analytics Chart ──────────────────────────────────── -->
<div class="lm-chart-card">
    <h3><i class="fa fa-area-chart"></i> <?= __('Daily Statistics') ?></h3>
    <div style="position: relative; height: 280px;">
        <canvas id="lm-dashboard-chart"></canvas>
    </div>
    <p class="lm-chart-timezone">
        <?= __('Data shown in {0} timezone', get_option('timezone', 'UTC')) ?>
    </p>
</div>

<!-- ── Data Table ───────────────────────────────────────── -->
<div class="lm-chart-card">
    <h3><i class="fa fa-table"></i> <?= __('Daily Breakdown') ?></h3>
    <div style="max-height: 320px; overflow-y: auto;">
        <table class="lm-stats-table">
            <thead>
                <tr>
                    <th><?= __('Date') ?></th>
                    <th><?= __('Views') ?></th>
                    <th><?= __('Link Earnings') ?></th>
                    <th><?= __('Daily CPM') ?></th>
                    <th><?= __('Referral Earnings') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($CurrentMonthDays as $key => $value) : ?>
                    <tr>
                        <td><strong><?= $key ?></strong></td>
                        <td><?= number_format((int)$value['view']) ?></td>
                        <td><span class="lm-earn-badge"><?= display_price_currency($value['publisher_earnings']) ?></span></td>
                        <td>
                            <?= (!empty($value['view']))
                                ? display_price_currency(($value['publisher_earnings'] / $value['view']) * 1000)
                                : '—' ?>
                        </td>
                        <td><?= display_price_currency($value['referral_earnings']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->start('scriptBottom'); ?>
<!-- Chart.js — modern replacement for deprecated Morris.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js" integrity="sha256-oVuOVjNOoMxpNlBb9iD36L21nEBlHE3kZI9XUzOqS/o=" crossorigin="anonymous"></script>
<script>
(function () {
    'use strict';

    /* Build labels & datasets from PHP */
    var labels   = [];
    var views    = [];
    var earnings = [];

    <?php foreach ($CurrentMonthDays as $key => $value) : ?>
        labels.push(<?= json_encode($key) ?>);
        views.push(<?= (int)$value['view'] ?>);
        earnings.push(<?= round((float)$value['publisher_earnings'], 4) ?>);
    <?php endforeach; ?>

    var ctx = document.getElementById('lm-dashboard-chart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: '<?= __('Views') ?>',
                    data: views,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,.08)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#3b82f6',
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y',
                },
                {
                    label: '<?= __('Earnings') ?>',
                    data: earnings,
                    borderColor: '#22c55e',
                    backgroundColor: 'rgba(34,197,94,.08)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#22c55e',
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y1',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    labels: {
                        font: { family: 'Inter, sans-serif', size: 13 },
                        color: '#475569'
                    }
                },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleFont: { family: 'Inter, sans-serif', weight: '600' },
                    bodyFont: { family: 'Inter, sans-serif' },
                    padding: 12,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: {
                    grid: { color: '#f1f5f9' },
                    ticks: { font: { family: 'Inter, sans-serif', size: 12 }, color: '#94a3b8' }
                },
                y: {
                    position: 'left',
                    grid: { color: '#f1f5f9' },
                    ticks: { font: { family: 'Inter, sans-serif', size: 12 }, color: '#94a3b8' }
                },
                y1: {
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    ticks: {
                        font: { family: 'Inter, sans-serif', size: 12 },
                        color: '#22c55e',
                        callback: function(val) { return val.toFixed(4); }
                    }
                }
            }
        }
    });
}());
</script>
<?php $this->end(); ?>
