# Watercooler

The goal of Watercooler is to provide a publishing and discussion platform for communities.

Targeted features include:

- Article publishing
- Podcast publishing
- Discussion forums
- Private messages

## Installation

[First, install BLT dependencies](http://blt.readthedocs.io/en/latest/INSTALL/#installing-requirements).

Then, build the project with Composer and setup the Drupal VM.

```
composer install;
composer blt-alias;
blt vm;
blt local:setup;
```

## Running tests

Running the included Behat tests:

`drush @watercooler.local ssh blt tests:behat`

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

# Built with BLT

Please see the [BLT documentation](http://blt.readthedocs.io/en/latest) for information on build, testing, and deployment processes.

# Resources

* GitHub - https://github.com/jrbeeman/watercooler
* TravisCI - (TODO: link me!)
