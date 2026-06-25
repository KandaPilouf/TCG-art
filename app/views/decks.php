<div id="decks-list">
    <div id="title">
        <h1>Deck page</h1>
    </div>

    <form method="POST" action="/decks/add">
        <input name="new_deck" placeholder="Deck name" required>
        <button type="submit">Create a collection</button>
    </form>

    <div id="content">
        <?php
        foreach ($decks as $deck) { ?>
            <a href="/decks/show/<?= $deck['id'] ?>"><?= $deck['name'] ?></a>
        <?php
        }
        ?>
    </div>
</div>