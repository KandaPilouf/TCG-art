<h1>CARD ATTRIBUTES</h1>
<p class="admin-sub">Add universes, styles, colors, variants and tags.</p>

<div class="attr-grid">
    <?php foreach (attribute_types() as $type => $meta) { ?>
        <section class="attr-card">
            <h2><?= escape($meta['label']) ?></h2>

            <ul class="attr-list">
                <?php foreach ($lists[$type] as $row) { ?>
                    <li><?= escape($row['value']) ?></li>
                <?php } ?>
                <?php if (empty($lists[$type])) { ?>
                    <li class="attr-empty">None yet.</li>
                <?php } ?>
            </ul>

            <form class="attr-form" method="POST" action="/admin/attributes/add">
                <input type="hidden" name="type" value="<?= escape($type) ?>">
                <input type="text" name="value" placeholder="New <?= escape(rtrim($meta['label'], 's')) ?>" maxlength="100" required>
                <button type="submit">Add</button>
            </form>
        </section>
    <?php } ?>
</div>
