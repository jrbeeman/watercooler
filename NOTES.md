# Installation

```
composer install;
composer blt-alias;
blt vm;
blt local:setup;
```

# Running tests within the DrupalVM

`drush @watercooler.local ssh blt tests:behat`

# Projects to port


## BBCode + BBCode CKEditor Plugin

- DONE: Use [Decoda](https://packagist.org/packages/mjohnson/decoda)
- Use [BBCode CKEditor Plugin](http://ckeditor.com/addon/bbcode)
- Need to figure out how to define dependencies in a custom module, but have composer still install them. For now, just add dependencies to top-level composer.json.
- Smiley alternative: [Emojione](https://packagist.org/packages/emojione/emojione)


## Markdown + Markdown CKEditor Plugin

- Use [PHP Markdown](https://github.com/michelf/php-markdown)
- Use [Markdown CKEditor Plugin](http://ckeditor.com/addon/markdown)
- Will require building a new CKEditor plugin [[1]](http://drupal.stackexchange.com/questions/139075/implementing-ckeditors-plugin) [[2]](https://www.drupal.org/developing/api/8/ckeditor) [[3]](http://activelamp.com/blog/drupal/drupal8-ckeditor-plugin/)


## Fast Forum

Will require swapping the following services: 

- `Drupal\forum\ForumManager`
- `Drupal\forum\ForumIndexStorage`

References: [[1]](https://www.drupal.org/node/2026959)


## Privatemsg

TBD


# Architecture notes

## Article

- Title
- Section
- Hero
- Body w/ summary
- Scheduled updates

## Podcast

Podcasts are containers for an entire series of shows. Podcast episodes are individual instances of a podcast. e.g. "This American Life" is a podcast, and episode 123 is a podcast episode.

- Title
- Hero
- Image: The square thumbnail cover image.
- Body w/ summary: Provides Description and iTunes: Summary podcast feed fields.
- Other feed metadata
  - Category / iTunes: Category
  - iTunes: Owner
  - iTunes: Author
  - iTunes: Subtitle
  - Managing editor
  - iTunes: Keywords
  - iTunes: Explicit

## Podcast episode

- Title
- \* Hero
- Body w/ summary: Provides Description and iTunes: Summary podcast feed fields.
- \* Author
- \* Category
- \* Explicit
- \* Image
- Enclosure
- Publication date
- Scheduled updates

\* Default inherited from podcast
