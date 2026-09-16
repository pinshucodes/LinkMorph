<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $logged_user
 */
$this->assign('title', __('Developer API'));
$this->assign('description', '');
$this->assign('content_title', __('Developer API'));

$base = rtrim($this->Url->build('/', true), '/');
$token = $logged_user->api_token;
?>

<style>
/* ── API Docs Modern UI ───────────────────────────────────── */
.lm-api-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
    margin-bottom: 24px;
}
.lm-api-card-header {
    padding: 18px 28px;
    border-bottom: 1px solid #e2e8f0;
    display: flex; align-items: center; gap: 10px;
    font-size: 16px; font-weight: 700; color: #0f172a;
    font-family: 'Inter', sans-serif;
    background: #f8fafc;
}
.lm-api-card-header .fa { color: #22c55e; }
.lm-api-card-body { padding: 28px; }

/* Token box */
.lm-token-box {
    background: linear-gradient(135deg, #0f172a, #1e1b4b);
    border-radius: 12px;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 0;
}
.lm-token-value {
    font-family: 'Courier New', monospace;
    font-size: 15px;
    color: #22c55e;
    flex: 1;
    word-break: break-all;
    letter-spacing: 0.03em;
}
.lm-token-copy {
    background: rgba(34,197,94,.15);
    border: 1px solid rgba(34,197,94,.3);
    border-radius: 8px;
    color: #22c55e;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
    white-space: nowrap;
    transition: background .2s;
}
.lm-token-copy:hover { background: rgba(34,197,94,.25); }

/* Method badge */
.badge-get {
    background: #dbeafe; color: #1d4ed8;
    font-size: 11px; font-weight: 700;
    padding: 3px 10px; border-radius: 6px;
    font-family: 'Inter', sans-serif;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}
.badge-post { background: #d1fae5; color: #065f46; }

/* Endpoint block */
.lm-endpoint {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px 20px;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    color: #1e293b;
    margin: 12px 0;
    word-break: break-all;
    line-height: 1.7;
}
.lm-endpoint .param-key  { color: #7c3aed; }
.lm-endpoint .param-val  { color: #22c55e; font-weight: 600; }
.lm-endpoint .param-opt  { color: #94a3b8; }

/* Response block */
.lm-response {
    background: #0f172a;
    border-radius: 10px;
    padding: 16px 20px;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    color: #94a3b8;
    margin: 12px 0;
}
.lm-response .json-key   { color: #93c5fd; }
.lm-response .json-str   { color: #86efac; }
.lm-response .json-num   { color: #fcd34d; }

/* Params table */
.lm-params-table { width: 100%; border-collapse: collapse; font-family: 'Inter', sans-serif; margin: 12px 0; }
.lm-params-table th {
    font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em;
    color: #64748b; font-weight: 700;
    padding: 10px 14px; border-bottom: 1px solid #e2e8f0;
    background: #f8fafc; text-align: left;
}
.lm-params-table td {
    padding: 12px 14px; border-bottom: 1px solid #f1f5f9;
    font-size: 13px; color: #1e293b; vertical-align: top;
}
.lm-params-table tr:last-child td { border-bottom: none; }
.tag-required { background: #fef2f2; color: #dc2626; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; }
.tag-optional { background: #f0fdf4; color: #16a34a; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; }

.lm-api-section-title {
    font-size: 18px; font-weight: 700; color: #0f172a;
    font-family: 'Inter', sans-serif;
    margin: 0 0 16px;
    display: flex; align-items: center; gap: 8px;
}
.lm-api-section-title .fa { color: #22c55e; font-size: 16px; }
.lm-api-p { font-size: 14px; color: #475569; line-height: 1.7; margin-bottom: 14px; font-family: 'Inter', sans-serif; }

.lm-notice {
    background: #eff6ff; border: 1px solid #bfdbfe;
    border-radius: 10px; padding: 14px 18px;
    font-size: 13px; color: #1d4ed8; font-family: 'Inter', sans-serif;
    display: flex; gap: 10px; align-items: flex-start;
    margin-bottom: 16px;
}
</style>

<!-- ── API Token ────────────────────────────────────────────── -->
<div class="lm-api-card">
    <div class="lm-api-card-header">
        <i class="fa fa-key"></i>
        <?= __('Your API Token') ?>
    </div>
    <div class="lm-api-card-body">
        <div class="lm-token-box">
            <span class="lm-token-value" id="lm-api-token"><?= h($token) ?></span>
            <button class="lm-token-copy" id="lm-copy-btn" onclick="copyToken()">
                <i class="fa fa-copy"></i> <?= __('Copy') ?>
            </button>
        </div>
        <p class="lm-api-p" style="margin-top:14px;margin-bottom:0;">
            <i class="fa fa-shield" style="color:#22c55e;margin-right:4px;"></i>
            <?= __('Keep this token secret. Do not expose it in client-side code. Treat it like a password.') ?>
        </p>
    </div>
</div>

<!-- ── Shorten Endpoint ─────────────────────────────────────── -->
<div class="lm-api-card">
    <div class="lm-api-card-header">
        <i class="fa fa-link"></i>
        <?= __('Shorten a URL') ?>
        <span class="badge-get">GET</span>
    </div>
    <div class="lm-api-card-body">

        <p class="lm-api-p"><?= __('Send a GET request to the endpoint below. Replace the highlighted values with your own.') ?></p>

        <!-- Endpoint -->
        <div class="lm-endpoint">
            <?= $base ?>/<span class="param-key">api</span>?<span class="param-key">api</span>=<span class="param-val"><?= h($token) ?></span>&amp;<span class="param-key">url</span>=<span class="param-val">https%3A%2F%2Fyour-long-url.com</span>&amp;<span class="param-key param-opt">alias</span>=<span class="param-opt">myalias</span>&amp;<span class="param-key param-opt">format</span>=<span class="param-opt">json</span>
        </div>

        <!-- Parameters -->
        <table class="lm-params-table">
            <thead>
                <tr>
                    <th><?= __('Parameter') ?></th>
                    <th><?= __('Type') ?></th>
                    <th><?= __('Required') ?></th>
                    <th><?= __('Description') ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>api</code></td>
                    <td>string</td>
                    <td><span class="tag-required"><?= __('Required') ?></span></td>
                    <td><?= __('Your API token from above.') ?></td>
                </tr>
                <tr>
                    <td><code>url</code></td>
                    <td>string</td>
                    <td><span class="tag-required"><?= __('Required') ?></span></td>
                    <td><?= __('The long URL to shorten. Must be URL-encoded.') ?></td>
                </tr>
                <tr>
                    <td><code>alias</code></td>
                    <td>string</td>
                    <td><span class="tag-optional"><?= __('Optional') ?></span></td>
                    <td><?= __('Custom alias for the short link (letters, numbers, hyphens). Auto-generated if omitted.') ?></td>
                </tr>
                <tr>
                    <td><code>format</code></td>
                    <td>string</td>
                    <td><span class="tag-optional"><?= __('Optional') ?></span></td>
                    <td><?= __('Response format: <code>json</code> (default) or <code>text</code> (returns just the short URL).') ?></td>
                </tr>
                <?php $allowed_ads = get_allowed_ads(); ?>
                <?php if (count($allowed_ads) > 1) : ?>
                <tr>
                    <td><code>type</code></td>
                    <td>integer</td>
                    <td><span class="tag-optional"><?= __('Optional') ?></span></td>
                    <td>
                        <?= __('Ad type:') ?>
                        <?php if (array_key_exists(1, $allowed_ads)) : ?><code>1</code> = <?= __('Interstitial') ?><?php endif; ?>
                        <?php if (array_key_exists(2, $allowed_ads)) : ?>, <code>2</code> = <?= __('Banner') ?><?php endif; ?>
                        <?php if (array_key_exists(0, $allowed_ads)) : ?>, <code>0</code> = <?= __('No Ads') ?><?php endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- JSON Response -->
        <h4 class="lm-api-section-title" style="margin-top:24px;"><i class="fa fa-check-circle"></i> <?= __('Success Response (JSON)') ?></h4>
        <div class="lm-response">
            {<br>
            &nbsp;&nbsp;<span class="json-key">"status"</span>: <span class="json-str">"success"</span>,<br>
            &nbsp;&nbsp;<span class="json-key">"shortenedUrl"</span>: <span class="json-str">"<?= $base ?>/xxxxx"</span><br>
            }
        </div>

        <h4 class="lm-api-section-title"><i class="fa fa-times-circle" style="color:#ef4444;"></i> <?= __('Error Response (JSON)') ?></h4>
        <div class="lm-response">
            {<br>
            &nbsp;&nbsp;<span class="json-key">"status"</span>: <span class="json-str">"error"</span>,<br>
            &nbsp;&nbsp;<span class="json-key">"message"</span>: <span class="json-str">"<?= __('Invalid URL.') ?>"</span><br>
            }
        </div>
    </div>
</div>

<!-- ── Code Examples ────────────────────────────────────────── -->
<div class="lm-api-card">
    <div class="lm-api-card-header">
        <i class="fa fa-code"></i>
        <?= __('Code Examples') ?>
    </div>
    <div class="lm-api-card-body">

        <!-- PHP -->
        <h4 class="lm-api-section-title"><i class="fa fa-file-code-o"></i> PHP — JSON</h4>
        <div class="lm-response">
            <span class="json-key">$api_token</span> = <span class="json-str">'<?= h($token) ?>'</span>;<br>
            <span class="json-key">$long_url</span>  = <span class="json-str">urlencode('https://your-long-url.com')</span>;<br>
            <span class="json-key">$api_url</span>   = <span class="json-str">"<?= $base ?>/api?api={$api_token}&url={$long_url}"</span>;<br>
            <br>
            <span class="json-key">$ch</span> = curl_init(<span class="json-key">$api_url</span>);<br>
            curl_setopt(<span class="json-key">$ch</span>, CURLOPT_RETURNTRANSFER, true);<br>
            curl_setopt(<span class="json-key">$ch</span>, CURLOPT_SSL_VERIFYPEER, true);<br>
            <span class="json-key">$result</span> = json_decode(curl_exec(<span class="json-key">$ch</span>), true);<br>
            curl_close(<span class="json-key">$ch</span>);<br>
            <br>
            if (<span class="json-key">$result</span>[<span class="json-str">'status'</span>] === <span class="json-str">'success'</span>) {<br>
            &nbsp;&nbsp;echo <span class="json-key">$result</span>[<span class="json-str">'shortenedUrl'</span>];<br>
            }
        </div>

        <!-- PHP Text -->
        <h4 class="lm-api-section-title" style="margin-top:20px;"><i class="fa fa-file-text-o"></i> PHP — Plain Text</h4>
        <div class="lm-response">
            <span class="json-key">$short_url</span> = file_get_contents(<span class="json-str">"<?= $base ?>/api?api=<?= h($token) ?>&url=".urlencode($long_url)."&format=text"</span>);<br>
            if (<span class="json-key">$short_url</span>) echo <span class="json-key">$short_url</span>;
        </div>

        <!-- JavaScript -->
        <h4 class="lm-api-section-title" style="margin-top:20px;"><i class="fa fa-file-code-o"></i> JavaScript (fetch)</h4>
        <div class="lm-response">
            const <span class="json-key">apiToken</span> = <span class="json-str">'<?= h($token) ?>'</span>;<br>
            const <span class="json-key">longUrl</span>  = encodeURIComponent(<span class="json-str">'https://your-long-url.com'</span>);<br>
            <br>
            fetch(<span class="json-str">`<?= $base ?>/api?api=${<span class="json-key">apiToken</span>}&url=${<span class="json-key">longUrl</span>}`</span>)<br>
            &nbsp;&nbsp;.then(r =&gt; r.json())<br>
            &nbsp;&nbsp;.then(data =&gt; {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;if (data.status === <span class="json-str">'success'</span>) console.log(data.shortenedUrl);<br>
            &nbsp;&nbsp;});
        </div>

        <!-- Python -->
        <h4 class="lm-api-section-title" style="margin-top:20px;"><i class="fa fa-file-code-o"></i> Python (requests)</h4>
        <div class="lm-response">
            import requests<br>
            <br>
            resp = requests.get(<span class="json-str">'<?= $base ?>/api'</span>, params={<br>
            &nbsp;&nbsp;<span class="json-str">'api'</span>: <span class="json-str">'<?= h($token) ?>'</span>,<br>
            &nbsp;&nbsp;<span class="json-str">'url'</span>: <span class="json-str">'https://your-long-url.com'</span>,<br>
            })<br>
            data = resp.json()<br>
            if data[<span class="json-str">'status'</span>] == <span class="json-str">'success'</span>:<br>
            &nbsp;&nbsp;print(data[<span class="json-str">'shortenedUrl'</span>])
        </div>

        <div class="lm-notice" style="margin-top:20px;">
            <i class="fa fa-info-circle" style="margin-top:2px;"></i>
            <span><?= __('Rate limiting: API calls are subject to the same daily and monthly URL limits as your plan. All API responses are CORS-enabled.') ?></span>
        </div>
    </div>
</div>

<?php $this->start('scriptBottom'); ?>
<script>
function copyToken() {
    var token = document.getElementById('lm-api-token').textContent.trim();
    navigator.clipboard.writeText(token).then(function () {
        var btn = document.getElementById('lm-copy-btn');
        btn.innerHTML = '<i class="fa fa-check"></i> Copied!';
        btn.style.background = 'rgba(34,197,94,.3)';
        setTimeout(function () {
            btn.innerHTML = '<i class="fa fa-copy"></i> Copy';
            btn.style.background = '';
        }, 2000);
    });
}
</script>
<?php $this->end(); ?>
