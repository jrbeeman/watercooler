# Projects to port


## BBCode + BBCode CKEditor Plugin

- Use [Decoda](https://packagist.org/packages/mjohnson/decoda)
- Use [BBCode CKEditor Plugin](http://ckeditor.com/addon/bbcode)
- Need to figure out how to define dependencies in a custom module, but have composer still install them. For now, just add dependencies to top-level composer.json.
- Smiley alternative: [Emojione](https://packagist.org/packages/emojione/emojione)
- Wordfilter alternative: [Ban Builder](https://github.com/snipe/banbuilder)


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