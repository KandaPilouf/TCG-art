<?php
// Rendered two ways: as the full /catalogue/show/<slug> page, and lifted out of
// that response into the catalogue's quickview modal. Keep it self-contained —
// no scripts (cloned scripts don't execute) and no reliance on outside markup.

// Each facet links back to the catalogue filtered by that value, so the detail
// page doubles as a way back into browsing.
$facets = [];
foreach ([
    ['Universe', 'universe', 'universe_id'],
    ['Style', 'style', 'style_id'],
    ['Color', 'color', 'primary_color_id'],
] as [$label, $name_key, $id_key]) {
    if (!empty($card[$name_key])) {
        $facets[] = [
            'label' => $label,
            'value' => $card[$name_key],
            'href'  => '/catalogue?' . http_build_query([strtolower($label) === 'color' ? 'color' : strtolower($label) => $card[$id_key]]),
        ];
    }
}
// Variant has no catalogue filter — show it as plain text, not a dead link.
if (!empty($card['variant'])) {
    $facets[] = ['label' => 'Variant', 'value' => $card['variant'], 'href' => null];
}

$tag_names = array_filter(array_map('trim', explode(',', (string) ($card['tags'] ?? ''))));
$tag_ids   = array_filter(array_map('trim', explode(',', (string) ($card['tag_ids'] ?? ''))));
$tags      = array_map(null, $tag_names, $tag_ids);
?>
<figure id="item_page">
    <div class="item-art">
        <img src="<?= escape($card['img']) ?>" alt="<?= escape($card['name']) ?>">
    </div>

    <div class="item-body">
        <p class="item-eyebrow">Card detail</p>
        <h1><?= escape($card['name']) ?></h1>
        <p class="item-artist">
            Artist:
            <a href="/catalogue?<?= escape(http_build_query(['artist' => $card['artist_id']])) ?>"><?= escape($card['artist']) ?></a>
        </p>

        <?php if ($facets) { ?>
            <dl class="item-facts">
                <?php foreach ($facets as $facet) { ?>
                    <div>
                        <dt><?= escape($facet['label']) ?></dt>
                        <dd>
                            <?php if ($facet['href']) { ?>
                                <a href="<?= escape($facet['href']) ?>"><?= escape($facet['value']) ?></a>
                            <?php } else { ?>
                                <?= escape($facet['value']) ?>
                            <?php } ?>
                        </dd>
                    </div>
                <?php } ?>
            </dl>
        <?php } ?>

        <?php if ($tags) { ?>
            <div class="item-tags">
                <?php foreach ($tags as [$tag_name, $tag_id]) {
                    if ($tag_name === null || $tag_id === null) {
                        continue;
                    } ?>
                    <a href="/catalogue?<?= escape(http_build_query(['tags' => $tag_id])) ?>"><?= escape($tag_name) ?></a>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if (!empty($_SESSION['is_connected'])) { ?>
            <form class="item-add-deck" action="/decks/add_card" method="POST">
                <input type="hidden" name="redirect" value="/catalogue/show/<?= escape($card['slug']) ?>">
                <input type="hidden" name="card_id" value="<?= escape($card['id']) ?>">
                <select name="deck_id" aria-label="Add <?= escape($card['name']) ?> to a deck" required>
                    <option value="" disabled selected>&#65291; Add to deck</option>
                    <?php foreach ($user_decks as $deck) {
                        $already = in_array($deck['id'], $decks_with_card); ?>
                        <option value="<?= escape($deck['id']) ?>" <?= $already ? 'disabled' : '' ?>>
                            <?= escape($deck['name']) ?><?= $already ? ' — already added' : '' ?>
                        </option>
                    <?php } ?>
                </select>
                <?php // Explicit button: the catalogue's auto-submit listener is bound to
                      // #cards and never reaches this form on the page or in the modal. ?>
                <button type="submit">Add</button>
            </form>
        <?php } else { ?>
            <p class="item-signin"><a href="/login">Log in</a> to add this card to a deck.</p>
        <?php } ?>

        <a class="item-back" href="/catalogue">&larr; Back to catalogue</a>
    </div>

    <?php if (!empty($related)) { ?>
        <section class="item-related">
            <h2>Related cards</h2>
            <div class="item-related-grid">
                <?php foreach ($related as $rel) { ?>
                    <a href="/catalogue/show/<?= escape($rel['slug']) ?>">
                        <img loading="lazy" src="<?= escape($rel['img']) ?>" alt="<?= escape($rel['name']) ?>">
                        <span><?= escape($rel['name']) ?></span>
                    </a>
                <?php } ?>
            </div>
        </section>
    <?php } ?>
</figure>
