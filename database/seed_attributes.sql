-- Seed & enrich card attributes. Idempotent: safe to run more than once.
-- Run once via phpMyAdmin or:  mysql -u root tcg_card_art < database/seed_attributes.sql
--
-- Phase A: UNIQUE constraint + bulk values on the 5 lookup tables.
-- Phase B: promote `artist` from free text to its own lookup table.
--
-- INSERT IGNORE relies on the UNIQUE keys below to skip rows that already exist,
-- so the ALTER TABLE statements must come first.

-- =====================================================================
-- PHASE A — lookup tables
-- =====================================================================

ALTER TABLE `universe` ADD UNIQUE KEY IF NOT EXISTS `uq_universe` (`universe`);
ALTER TABLE `style`    ADD UNIQUE KEY IF NOT EXISTS `uq_style` (`style`);
ALTER TABLE `color`    ADD UNIQUE KEY IF NOT EXISTS `uq_color` (`color`);
ALTER TABLE `variant`  ADD UNIQUE KEY IF NOT EXISTS `uq_variant` (`variant`);
ALTER TABLE `tag`      ADD UNIQUE KEY IF NOT EXISTS `uq_tag` (`tag`);

INSERT IGNORE INTO `universe` (`universe`) VALUES
  ('Star Wars'), ('Marvel'), ('DC'), ('Lord of the Rings'), ('Zelda'),
  ('Final Fantasy'), ('Warhammer 40k'), ('Elder Scrolls'), ('Witcher'),
  ('Dune'), ('Naruto'), ('One Piece'), ('Dragon Ball'), ('Yu-Gi-Oh'),
  ('Hearthstone'), ('Diablo'), ('World of Warcraft'), ('Genshin Impact'),
  ('Elden Ring'), ('Bloodborne');

INSERT IGNORE INTO `style` (`style`) VALUES
  ('Realism'), ('Cel-shaded'), ('Watercolor'), ('Oil painting'), ('Pixel art'),
  ('Ink/Sumi-e'), ('Art nouveau'), ('Gothic'), ('Surrealism'), ('Impressionism'),
  ('Concept art'), ('Comic/Western'), ('Anime/Manga'), ('Minimalist'),
  ('Baroque'), ('Cyberpunk'), ('Steampunk'), ('Vaporwave');

INSERT IGNORE INTO `color` (`color`) VALUES
  ('Green'), ('Black'), ('White'), ('Pink'), ('Cyan'), ('Gold'), ('Silver'),
  ('Crimson'), ('Teal'), ('Violet'), ('Brown');

INSERT IGNORE INTO `variant` (`variant`) VALUES
  ('Legendary'), ('Mythic'), ('Uncommon'), ('Secret Rare'), ('Full Art'),
  ('Alternate Art'), ('Promo'), ('Foil'), ('Holographic'), ('First Edition'),
  ('Prototype');

INSERT IGNORE INTO `tag` (`tag`) VALUES
  ('dragon'), ('mecha'), ('forest'), ('ocean'), ('fire'), ('ice'), ('undead'),
  ('warrior'), ('mage'), ('rogue'), ('demon'), ('angel'), ('portrait'),
  ('landscape'), ('battle'), ('magic'), ('nature'), ('space'), ('neon'),
  ('armor'), ('beast'), ('spirit'), ('weapon'), ('ruins');

-- =====================================================================
-- PHASE B — promote artist to a lookup table
-- =====================================================================

CREATE TABLE IF NOT EXISTS `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_artist` (`artist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A few clean starter artists (the rest are backfilled from cards below, but
-- only on the first run — see the guard).
INSERT IGNORE INTO `artist` (`artist`) VALUES
  ('Greg Rutkowski'), ('Yoshitaka Amano'), ('Rebecca Guay'), ('John Avon'),
  ('Terese Nielsen'), ('Kekai Kotaki'), ('Raymond Swanland'), ('Chris Rahn');

-- Add the FK column (no-op if already present).
ALTER TABLE `card` ADD COLUMN IF NOT EXISTS `artist_id` int(11) DEFAULT NULL;

-- Backfill + drop the old text column, but ONLY while it still exists. Wrapped
-- in a prepared statement gated on information_schema so a re-run on an
-- already-migrated DB skips these steps instead of erroring on `card.artist`.
SET @has_artist := (
  SELECT COUNT(*) FROM information_schema.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'card' AND COLUMN_NAME = 'artist'
);
SET @migrate := IF(@has_artist > 0,
  'INSERT IGNORE INTO artist (artist)
     SELECT DISTINCT artist FROM card WHERE artist IS NOT NULL AND artist <> ""',
  'DO 0');
PREPARE s FROM @migrate; EXECUTE s; DEALLOCATE PREPARE s;

SET @link := IF(@has_artist > 0,
  'UPDATE card c JOIN artist a ON c.artist = a.artist SET c.artist_id = a.id',
  'DO 0');
PREPARE s FROM @link; EXECUTE s; DEALLOCATE PREPARE s;

-- The code reads/writes artist_id now; drop the old text column.
ALTER TABLE `card` DROP COLUMN IF EXISTS `artist`;
