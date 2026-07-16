<script>document.documentElement.classList.add('js-cards')</script>

<?php if (!empty($featured)) { ?>
    <section id="featured">
        <a class="featured-art" data-quickview href="/catalogue/show/<?= escape($featured['slug']) ?>">
            <img src="<?= escape($featured['img']) ?>" alt="<?= escape($featured['name']) ?>">
        </a>
        <div class="featured-body">
            <p class="eyebrow">Featured card</p>
            <h2><?= escape($featured['name']) ?></h2>
            <div class="featured-tags">
                <?php foreach (['universe', 'style', 'color', 'variant'] as $k) {
                    if (!empty($featured[$k])) { ?>
                        <span><?= escape($featured[$k]) ?></span>
                <?php }
                } ?>
            </div>
            <a class="featured-cta" data-quickview href="/catalogue/show/<?= escape($featured['slug']) ?>">View card</a>
        </div>
    </section>
<?php } ?>

<div id="filters">
    <form action="/catalogue" method="GET">
        <input list="card_name" type="text" name="q" placeholder="Search cards" value="<?= isset($_GET['q']) ? escape($_GET['q']) : '' ?>">

        <label for="tags"></label>
        <select name="tags">
            <option value="">All tags</option>
            <?php foreach ($tags as $tag) { ?>
                <option value="<?= $tag['id'] ?>" <?= (isset($_GET['tags']) && $_GET['tags'] == $tag['id']) ? 'selected' : '' ?>>
                    <?= escape($tag['tag']) ?>
                </option>
            <?php } ?>
        </select>

        <label for="styles"></label>
        <select name="style">
            <option value="">All styles</option>
            <?php
            foreach ($styles as $style) { ?>
                <option value="<?= $style['id'] ?>" <?= (isset($_GET['style']) && $_GET['style'] == $style['id']) ? 'selected' : '' ?>>
                    <?= escape($style['style']) ?>
                </option>
            <?php } ?>
        </select>

        <label for="universe"></label>
        <select name="universe">
            <option value="">All universe</option>
            <?php
            foreach ($universes as $universe) { ?>
                <option value="<?= $universe['id'] ?>" <?= (isset($_GET['universe']) && $_GET['universe'] == $universe['id']) ? 'selected' : '' ?>>
                    <?= escape($universe['universe']) ?>
                </option>
            <?php } ?>
        </select>

        <label for="color"></label>
        <select name="color">
            <option value="">All colors</option>
            <?php
            foreach ($colors as $color) { ?>
                <option value="<?= $color['id'] ?>" <?= (isset($_GET['color']) && $_GET['color'] == $color['id']) ? 'selected' : '' ?>>
                    <?= escape($color['color']) ?>
                </option>
            <?php
            }
            ?>
        </select>

        <label for="artist"></label>
        <select name="artist">
            <option value="">All artists</option>
            <?php foreach ($artists as $artist) { ?>
                <option value="<?= $artist['id'] ?>" <?= (isset($_GET['artist']) && $_GET['artist'] == $artist['id']) ? 'selected' : '' ?>>
                    <?= escape($artist['artist']) ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Search</button>
    </form>
</div>

<?php
// Build the active-filter chips (label + a link that removes just that filter).
$params = [
    'q'        => trim($_GET['q'] ?? ''),
    'tags'     => $_GET['tags'] ?? '',
    'style'    => $_GET['style'] ?? '',
    'universe' => $_GET['universe'] ?? '',
    'color'    => $_GET['color'] ?? '',
    'artist'   => $_GET['artist'] ?? '',
];
$has_filters = implode('', $params) !== '';

$remove_url = function ($drop) use ($params) {
    $kept = array_filter(
        $params,
        fn($v, $k) => $v !== '' && $k !== $drop,
        ARRAY_FILTER_USE_BOTH
    );
    return '/catalogue' . ($kept ? '?' . http_build_query($kept) : '');
};

$chips = [];
if ($params['q'] !== '') {
    $chips[] = ['label' => 'Search: ' . $params['q'], 'key' => 'q'];
}
foreach ([['tags', $tags, 'tag'], ['style', $styles, 'style'], ['universe', $universes, 'universe'], ['color', $colors, 'color'], ['artist', $artists, 'artist']] as [$key, $rows, $field]) {
    if ($params[$key] === '') {
        continue;
    }
    foreach ($rows as $row) {
        if ((string) $row['id'] === (string) $params[$key]) {
            $chips[] = ['label' => $row[$field], 'key' => $key];
            break;
        }
    }
}

// primary-color name -> accent hue for the card's top border (fallback: gold).
$color_hex = [
    'red' => '#c0392b', 'yellow' => '#c9a84c', 'blue' => '#2c6fb0',
    'green' => '#3a8f5b', 'black' => '#2b2d33', 'white' => '#cdbfa6',
    'purple' => '#7d5ba6', 'orange' => '#d08234', 'pink' => '#c96f9c',
    'cyan' => '#3bb2c4', 'gold' => '#c9a84c', 'silver' => '#9aa2ad',
    'crimson' => '#a01d2e', 'teal' => '#2b8f8f', 'violet' => '#8b5cf6',
    'brown' => '#8a5a3c',
];
?>

<?php if ($chips) { ?>
    <div id="active-filters">
        <?php foreach ($chips as $chip) { ?>
            <a class="chip" href="<?= escape($remove_url($chip['key'])) ?>">
                <span><?= escape($chip['label']) ?></span>
                <span class="chip-x" aria-hidden="true">&times;</span>
            </a>
        <?php } ?>
    </div>
<?php } ?>

<div id="catalogue-toolbar">
    <p class="results-count"><span class="count-num"><?= count($cards) ?></span> <?= count($cards) === 1 ? 'card' : 'cards' ?></p>
    <?php if ($has_filters) { ?>
        <a class="clear-filters" href="/catalogue">Clear filters</a>
    <?php } ?>
</div>

<div id="cards">
    <?php
    if (empty($cards)) { ?>
        <p class="no-results">No cards match your filters. Try clearing a filter or searching a different name.</p>
    <?php } else foreach ($cards as $index => $card) {
        $accent = $color_hex[strtolower(trim($card['color'] ?? ''))] ?? 'var(--accent-color)';
    ?>
        <figure style="--i: <?= $index % 12 ?>; --card-accent: <?= $accent ?>">
            <div class="card-frame" data-view="/catalogue/show/<?= escape($card['slug']) ?>">
                <img loading="lazy" src="<?= escape($card['img']) ?>" alt="<?= escape($card['name']) ?>">
                <div class="card-overlay">
                    <div class="card-meta">
                        <?php if (!empty($card['variant'])) { ?>
                            <span class="rarity"><?= escape($card['variant']) ?></span>
                        <?php } ?>
                        <h3><?= escape($card['name']) ?></h3>
                        <span class="artist">Artist: <?= escape($card['artist']) ?></span>
                    </div>
                    <div class="card-actions">
                        <a class="act-view" data-quickview href="/catalogue/show/<?= escape($card['slug']) ?>">View</a>
                        <?php if (!empty($_SESSION['is_connected'])) { ?>
                            <form class="add-deck" action="/decks/add_card" method="POST">
                                <input type="hidden" name="redirect" value="<?= escape($_SERVER['REQUEST_URI']) ?>">
                                <input type="hidden" name="card_id" value="<?= $card['id'] ?>">
                                <select name="deck_id" aria-label="Add <?= escape($card['name']) ?> to a deck">
                                    <option value="" disabled selected>&#65291; Add to deck</option>
                                    <?php foreach ($user_decks as $deck) { ?>
                                        <option value="<?= $deck['id'] ?>"><?= escape($deck['name']) ?></option>
                                    <?php } ?>
                                </select>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </figure>
    <?php
    }
    ?>
</div>

<div id="quickview" class="qv" hidden>
    <div class="qv-backdrop" data-qv-close></div>
    <div class="qv-panel" role="dialog" aria-modal="true" aria-label="Card details">
        <button class="qv-close" type="button" data-qv-close aria-label="Close">&times;</button>
        <div class="qv-content"></div>
    </div>
</div>

<script>
    (function () {
        var grid = document.getElementById('cards');
        if (!grid) return;
        var cards = grid.querySelectorAll('figure');

        // Scroll-reveal stagger.
        if (!('IntersectionObserver' in window)) {
            cards.forEach(function (f) { f.classList.add('in'); });
        } else {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
                });
            }, { rootMargin: '0px 0px -8% 0px' });
            cards.forEach(function (f) { io.observe(f); });
        }

        // Skeleton: drop the shimmer once each card image is ready.
        grid.querySelectorAll('.card-frame').forEach(function (frame) {
            var img = frame.querySelector('img');
            if (!img) return;
            if (img.complete && img.naturalWidth) {
                frame.classList.add('loaded');
            } else {
                img.addEventListener('load', function () { frame.classList.add('loaded'); });
                img.addEventListener('error', function () { frame.classList.add('loaded'); });
            }
        });

        // Add-to-deck: picking a deck submits immediately (no separate button).
        grid.addEventListener('change', function (e) {
            if (e.target.matches('.add-deck select') && e.target.value) {
                e.target.form.submit();
            }
        });

        // Quick view: open card detail in a modal instead of navigating.
        var qv = document.getElementById('quickview');
        var content = qv ? qv.querySelector('.qv-content') : null;
        var lastTrigger = null;

        function openQV(url) {
            fetch(url).then(function (r) { return r.text(); }).then(function (html) {
                var doc = new DOMParser().parseFromString(html, 'text/html');
                var item = doc.getElementById('item_page');
                content.innerHTML = '';
                if (item) content.appendChild(document.importNode(item, true));
                qv.hidden = false;
                requestAnimationFrame(function () { qv.classList.add('open'); });
                document.body.style.overflow = 'hidden';
                qv.querySelector('.qv-close').focus();
            }).catch(function () { window.location = url; });
        }

        function closeQV() {
            qv.classList.remove('open');
            document.body.style.overflow = '';
            setTimeout(function () { qv.hidden = true; content.innerHTML = ''; }, 250);
            if (lastTrigger) lastTrigger.focus();
        }

        if (qv && 'fetch' in window) {
            document.addEventListener('click', function (e) {
                var a = e.target.closest('[data-quickview]');
                if (a) {
                    e.preventDefault();
                    lastTrigger = a;
                    openQV(a.getAttribute('href'));
                    return;
                }
                // Clicking anywhere on a card (except its action controls) opens quick view.
                var frame = e.target.closest('.card-frame[data-view]');
                if (frame && !e.target.closest('.card-actions')) {
                    e.preventDefault();
                    lastTrigger = frame.querySelector('.act-view') || frame;
                    openQV(frame.getAttribute('data-view'));
                }
            });
            qv.addEventListener('click', function (e) {
                if (e.target.hasAttribute('data-qv-close')) closeQV();
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !qv.hidden) closeQV();
            });
        }
    })();
</script>
