<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message success alert alert-success mt-2" onclick="this.classList.add('hidden')"><?= $message ?></div>
