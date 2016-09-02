<?php

namespace Drupal\decoda\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;
use Decoda;

/**
 * Provides a filter using the Decoda BBCode filter.
 *
 * @Filter(
 *   id = "filter_decoda",
 *   module = "decoda",
 *   title = @Translation("Decoda BBCode"),
 *   description = @Translation("Allows content to be submitted using BBCode, which is filtered into valid HTML."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * )
 */
class FilterDecoda extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $decoda = new Decoda\Decoda();
    $decoda->defaults();
    $decoda->reset($text);
    $decoda->addHook(new Decoda\Hook\EmoticonHook(array('path' => '/sites/default/emoticons/')));
    $result = $decoda->parse();

    return new FilterProcessResult($result);
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    return $this->t('You can use <a href="@reference">BBCode syntax</a> to format and style the text.', array(
      '@reference' => 'https://en.wikipedia.org/wiki/BBCode',
    ));
  }

}
