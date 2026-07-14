<div id="home_left">
    <p class="eyebrow">Trading card art gallery</p>
    <h1>TCG ARTS</h1>
    <h3>collect your art</h3>
    <?php
    if (isset($_SESSION['is_connected'])) {
        echo "<h4> Hello " . $_SESSION['name'] . "</h4>";
    }
    ?>

    <form method="GET" action="/catalogue">
        <input list="card_name" type="text" name="q" placeholder="search cards">
        <datalist id="card_name">
            <?php foreach ($cards as $list_card) { ?>
                <option value="<?= $list_card['name'] ?>"></option>
            <?php } ?>
        </datalist>
        <button type="submit">
            <svg width="17" height="18" viewBox="0 0 17 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.2167 17.25L9.44167 11.2125C8.98333 11.5958 8.45625 11.8993 7.86042 12.1229C7.26458 12.3465 6.63056 12.4583 5.95833 12.4583C4.29306 12.4583 2.88383 11.8552 1.73067 10.649C0.5775 9.44278 0.000611596 7.9695 4.85009e-07 6.22917C-0.000610626 4.48883 0.576278 3.01556 1.73067 1.80933C2.88506 0.603111 4.29428 0 5.95833 0C7.62239 0 9.03192 0.603111 10.1869 1.80933C11.3419 3.01556 11.9185 4.48883 11.9167 6.22917C11.9167 6.93194 11.8097 7.59479 11.5958 8.21771C11.3819 8.84062 11.0917 9.39167 10.725 9.87083L16.5 15.9083L15.2167 17.25ZM5.95833 10.5417C7.10417 10.5417 8.07828 10.1226 8.88067 9.28433C9.68306 8.44611 10.0839 7.42772 10.0833 6.22917C10.0827 5.03061 9.68183 4.01254 8.88067 3.17496C8.0795 2.33738 7.10539 1.91794 5.95833 1.91667C4.81128 1.91539 3.83747 2.33482 3.03692 3.17496C2.23636 4.0151 1.83517 5.03317 1.83333 6.22917C1.8315 7.42517 2.2327 8.44355 3.03692 9.28433C3.84114 10.1251 4.81495 10.5442 5.95833 10.5417Z" fill="currentColor" />
            </svg>
        </button>
    </form>

    <a class="home-cta" href="/catalogue">Browse the catalogue →</a>

    <dl class="home-stats">
        <div>
            <dt data-count="<?= (int) $stats['cards'] ?>">0</dt>
            <dd>Cards</dd>
        </div>
        <div>
            <dt data-count="<?= (int) $stats['universes'] ?>">0</dt>
            <dd>Universes</dd>
        </div>
        <div>
            <dt data-count="<?= (int) $stats['styles'] ?>">0</dt>
            <dd>Styles</dd>
        </div>
        <div>
            <dt data-count="<?= (int) $stats['artists'] ?>">0</dt>
            <dd>Artists</dd>
        </div>
    </dl>
</div>
<div id="home_right">
    <div class="hero-float">
        <figure title="main home card" class="hero-card">
            <img src=<?php echo $card['img']; ?> alt=<?php echo $card['name']; ?>>
            <span class="hero-shine" aria-hidden="true"></span>
            <figcaption>
                <span class="hero-name"><?php echo $card['name']; ?></span>
                <span>Artist: <?php echo $card['artist']; ?></span>
            </figcaption>
        </figure>
    </div>
    <div class="btn-pos">
        <a class="btn-card" href="/catalogue/show/<?php echo $card['slug'] ?>">Show card</a>
    </div>
</div>

<script>
// Count-up on the home stats, once, respecting reduced-motion.
(function () {
    var dts = document.querySelectorAll('.home-stats dt');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    dts.forEach(function (dt) {
        var target = parseInt(dt.dataset.count, 10) || 0;
        if (reduce || target === 0) { dt.textContent = target; return; }
        var start = null, dur = 1100;
        function step(t) {
            if (!start) start = t;
            var p = Math.min((t - start) / dur, 1);
            dt.textContent = Math.round((1 - Math.pow(1 - p, 3)) * target);
            if (p < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    });
})();
</script>
