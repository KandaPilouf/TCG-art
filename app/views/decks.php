<h1>hello deck page</h1>
<?php
foreach ($decks as $deck) {
    var_dump($deck['name']);
}
?>
<form method="POST" action="/decks/add">
    <input name="new_deck" placeholder="Deck name" required>
    <button type="submit">Create a collection</button>
</form>