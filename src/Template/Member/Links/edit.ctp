<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Link $link
 * @var \App\Model\Entity\Plan $logged_user_plan
 */
$this->assign('title', __('Edit Link: {0}', $link->alias));
$this->assign('description', '');
$this->assign('content_title', __('Edit Link: {0}', $link->alias));
?>

<style>
/* ── Edit Link — Modern Card ──────────────────────────────── */
.lm-edit-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
    margin-bottom: 20px;
}
.lm-edit-card-header {
    padding: 20px 28px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    font-family: 'Inter', sans-serif;
}
.lm-edit-card-header .fa { color: #22c55e; }
.lm-edit-card-body { padding: 28px; }

.lm-form-group { margin-bottom: 22px; }
.lm-form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 7px;
    font-family: 'Inter', sans-serif;
    text-transform: none;
    letter-spacing: 0;
}
.lm-form-group label .badge-plan {
    display: inline-block;
    background: #22c55e;
    color: #fff;
    font-size: 10px;
    padding: 2px 8px;
    border-radius: 20px;
    font-weight: 600;
    margin-left: 6px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.lm-input {
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 14px;
    font-family: 'Inter', sans-serif;
    color: #1e293b;
    background: #fff;
    box-shadow: none;
    transition: border-color .2s, box-shadow .2s;
}
.lm-input:focus {
    outline: none;
    border-color: #22c55e;
    box-shadow: 0 0 0 3px rgba(34,197,94,.12);
}
.lm-input:disabled { background: #f8fafc; color: #94a3b8; cursor: not-allowed; }
.lm-textarea { min-height: 90px; resize: vertical; }
.lm-help { font-size: 12px; color: #94a3b8; margin-top: 6px; font-family: 'Inter', sans-serif; }

/* Password toggle */
.lm-pw-wrap { position: relative; }
.lm-pw-wrap .lm-input { padding-right: 48px; }
.lm-pw-toggle {
    position: absolute;
    right: 14px; top: 50%;
    transform: translateY(-50%);
    background: none; border: none;
    color: #94a3b8; cursor: pointer;
    font-size: 16px; padding: 4px;
    line-height: 1;
}
.lm-pw-toggle:hover { color: #22c55e; }

/* Pixel code field */
.lm-pixel-notice {
    background: #fffbeb;
    border: 1px solid #fde68a;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 12px;
    color: #92400e;
    margin-top: 8px;
    display: flex;
    gap: 8px;
    align-items: flex-start;
}

/* Submit */
.lm-btn-submit {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 13px 36px;
    font-size: 15px;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(34,197,94,.3);
    transition: transform .15s, box-shadow .2s;
}
.lm-btn-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(34,197,94,.4);
}

/* Ad type toggle */
.lm-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 40px !important;
}
</style>

<div class="lm-edit-card">
    <div class="lm-edit-card-header">
        <i class="fa fa-pencil"></i>
        <?= __('Edit Link: {0}', '<code style="font-size:14px;color:#22c55e;">' . h($link->alias) . '</code>') ?>
    </div>
    <div class="lm-edit-card-body">

        <?= $this->Form->create($link, ['novalidate' => true]); ?>
        <?= $this->Form->hidden('id'); ?>

        <!-- Long URL -->
        <div class="lm-form-group">
            <label for="url"><?= __('Long URL') ?></label>
            <input
                type="url"
                id="url"
                name="url"
                class="lm-input"
                value="<?= h($link->url) ?>"
                <?= ((bool)$logged_user_plan->edit_long_url) ? '' : 'disabled' ?>
            >
            <?php if (!(bool)$logged_user_plan->edit_long_url) : ?>
                <p class="lm-help"><i class="fa fa-lock"></i> <?= __('Upgrade your plan to edit the destination URL.') ?></p>
            <?php endif; ?>
        </div>

        <!-- Title -->
        <div class="lm-form-group">
            <label for="title"><?= __('Title') ?> <span style="color:#94a3b8;font-weight:400;">(<?= __('optional') ?>)</span></label>
            <input type="text" id="title" name="title" class="lm-input"
                   value="<?= h($link->title) ?>"
                   placeholder="<?= __('e.g. My Promo Link') ?>">
        </div>

        <!-- Description -->
        <div class="lm-form-group">
            <label for="description"><?= __('Description') ?> <span style="color:#94a3b8;font-weight:400;">(<?= __('optional') ?>)</span></label>
            <textarea id="description" name="description" class="lm-input lm-textarea"
                      placeholder="<?= __('Short description shown in link stats') ?>"><?= h($link->description) ?></textarea>
        </div>

        <!-- Expiration Date -->
        <?php if ((bool)$logged_user_plan->link_expiration) : ?>
        <div class="lm-form-group">
            <label>
                <?= __('Expiration Date & Time') ?>
                <span class="badge-plan"><?= __('Pro') ?></span>
            </label>
            <div class="input-group" style="display:flex;gap:8px;">
                <input type="text"
                       id="expiration-picker"
                       name="expiration"
                       class="lm-input"
                       style="flex:1;"
                       placeholder="<?= __('Pick a date & time — leave blank to never expire') ?>"
                       value="<?= $link->expiration ? h($link->expiration->format('Y-m-d H:i')) : '' ?>"
                       autocomplete="off">
                <button type="button" id="clear-expiration-btn"
                        style="border:1px solid #e2e8f0;border-radius:10px;padding:0 14px;background:#f8fafc;color:#64748b;cursor:pointer;font-size:13px;font-family:'Inter',sans-serif;white-space:nowrap;">
                    <i class="fa fa-times"></i> <?= __('Clear') ?>
                </button>
            </div>
        </div>
        <?php endif; ?>

        <!-- Password Protection -->
        <div class="lm-form-group">
            <label for="link_password_raw">
                <i class="fa fa-lock" style="color:#22c55e;margin-right:4px;"></i>
                <?= __('Password Protection') ?>
                <span style="color:#94a3b8;font-weight:400;font-size:12px;">— <?= __('visitors must enter this to access your link') ?></span>
            </label>
            <div class="lm-pw-wrap">
                <input type="password"
                       id="link_password_raw"
                       name="link_password_raw"
                       class="lm-input"
                       placeholder="<?= !empty($link->link_password) ? __('••••••••  (set — enter new password to change, leave blank to keep)') : __('Leave blank for no password') ?>"
                       autocomplete="new-password">
                <button type="button" class="lm-pw-toggle" id="lm-pw-show" title="<?= __('Show/hide password') ?>">
                    <i class="fa fa-eye" id="lm-pw-eye"></i>
                </button>
            </div>
            <?php if (!empty($link->link_password)) : ?>
                <p class="lm-help" style="color:#22c55e;">
                    <i class="fa fa-check-circle"></i>
                    <?= __('This link is currently password-protected. Leave blank to keep the existing password.') ?>
                </p>
                <label style="margin-top:8px;cursor:pointer;">
                    <input type="checkbox" name="remove_password" value="1" id="remove-password">
                    <span style="font-size:13px;color:#ef4444;font-weight:500;margin-left:4px;">
                        <i class="fa fa-unlock"></i> <?= __('Remove password protection') ?>
                    </span>
                </label>
            <?php endif; ?>
        </div>

        <!-- Retargeting Pixel -->
        <div class="lm-form-group">
            <label for="pixel_code">
                <i class="fa fa-bullseye" style="color:#22c55e;margin-right:4px;"></i>
                <?= __('Retargeting Pixel Code') ?>
                <span style="color:#94a3b8;font-weight:400;font-size:12px;">— <?= __('fired when visitor views your short link') ?></span>
            </label>
            <textarea id="pixel_code" name="pixel_code" class="lm-input lm-textarea"
                      placeholder="<?= __('Paste your Facebook Pixel, Google Tag, TikTok Pixel, or any <script> code here…') ?>"
                      style="font-family: 'Courier New', monospace; font-size: 13px;"><?= h($link->pixel_code) ?></textarea>
            <div class="lm-pixel-notice">
                <i class="fa fa-warning" style="margin-top:2px;flex-shrink:0;"></i>
                <span>
                    <?= __('Only paste pixel codes from trusted platforms (Meta, Google, TikTok, etc.). The code runs on the interstitial/banner page shown to your visitors.') ?>
                </span>
            </div>
        </div>

        <!-- Ad Type -->
        <?php
        $ads_options = get_allowed_ads();
        if (count($ads_options) > 1) :
        ?>
        <div class="lm-form-group">
            <label for="ad_type"><?= __('Advertising Type') ?></label>
            <select id="ad_type" name="ad_type" class="lm-input lm-select">
                <?php foreach ($ads_options as $val => $label) : ?>
                    <option value="<?= h($val) ?>" <?= $link->ad_type == $val ? 'selected' : '' ?>>
                        <?= h($label) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php else : ?>
            <?= $this->Form->hidden('type', ['value' => get_option('member_default_redirect', 1)]); ?>
        <?php endif; ?>

        <button type="submit" class="lm-btn-submit">
            <i class="fa fa-save" style="margin-right:8px;"></i>
            <?= __('Save Changes') ?>
        </button>

        <?= $this->Form->end(); ?>
    </div>
</div>

<?php $this->start('scriptBottom'); ?>
<!-- Flatpickr CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
      integrity="sha512-MQXduO8IQnJVq1qmySpN87SQEiNOAfGVy3yEBnvqMKMTaGmXPYhAZEzxkRKGdeMWrW/dXMcQiMcebHAKHtEA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
        integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFsZOU9HqKFxjGkB6ROpFo2uqPD58+iMEUFBYBEACtZmQky2eu=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
(function () {
    'use strict';

    /* ── Flatpickr ── */
    var pickerEl = document.getElementById('expiration-picker');
    if (pickerEl) {
        var picker = flatpickr(pickerEl, {
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            minDate:    'today',
            time_24hr:  true,
            allowInput: true,
        });
        var clearBtn = document.getElementById('clear-expiration-btn');
        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                picker.clear();
                pickerEl.value = '';
            });
        }
    }

    /* ── Password show/hide toggle ── */
    var pwInput = document.getElementById('link_password_raw');
    var pwBtn   = document.getElementById('lm-pw-show');
    var pwEye   = document.getElementById('lm-pw-eye');
    if (pwInput && pwBtn) {
        pwBtn.addEventListener('click', function () {
            var isText = pwInput.type === 'text';
            pwInput.type = isText ? 'password' : 'text';
            pwEye.className = isText ? 'fa fa-eye' : 'fa fa-eye-slash';
        });
    }

    /* ── Remove password checkbox disables the new-password field ── */
    var removeChk = document.getElementById('remove-password');
    if (removeChk && pwInput) {
        removeChk.addEventListener('change', function () {
            pwInput.disabled = this.checked;
            if (this.checked) { pwInput.value = ''; }
        });
    }
}());
</script>
<?php $this->end(); ?>
