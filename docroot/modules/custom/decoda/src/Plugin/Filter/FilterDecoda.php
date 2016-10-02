<?php

namespace Drupal\decoda\Plugin\Filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter using the Decoda BBCode filter.
 *
 * @Filter(
 *   id = "filter_decoda",
 *   module = "decoda",
 *   title = @Translation("Decoda BBCode"),
 *   description = @Translation("Allows content to be submitted using BBCode, which is filtered into valid HTML."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 *   settings = {
 *     "decoda_filters" = {}
 *   },
 * )
 */
class FilterDecoda extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {

    $form['decoda_filters'] = array(
      '#title' => $this->t('Optional Decoda filters'),
      '#type' => 'checkboxes',
      '#options' => array(
        'BlockFilter' => $this->t('Block elements'),
        'EmailFilter' => $this->t('Email'),
        'ListFilter' => $this->t('List'),
        'ImageFilter' => $this->t('Image'),
        'VideoFilter' => $this->t('Video'),
        'CodeFilter' => $this->t('Code'),
        'QuoteFilter' => $this->t('Quote'),
        'TableFilter' => $this->t('Table'),
      ),
      '#default_value' => isset($this->settings['decoda_filters']) ? $this->settings['decoda_filters'] : array(
        'EmailFilter',
        'BlockFilter',
        'ListFilter',
      ),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $decoda = new \Decoda\Decoda();
    $decoda->addFilter(new \Decoda\Filter\DefaultFilter());
    $decoda->addFilter(new \Decoda\Filter\UrlFilter());
    $decoda->addFilter(new \Decoda\Filter\TextFilter());

    if ($this->settings['decoda_filters']['EmailFilter']) {
      $decoda->addFilter(new \Decoda\Filter\EmailFilter());
    }

    if ($this->settings['decoda_filters']['ImageFilter']) {
      $decoda->addFilter(new \Decoda\Filter\ImageFilter());
    }

    if ($this->settings['decoda_filters']['BlockFilter']) {
      $decoda->addFilter(new \Decoda\Filter\BlockFilter());
    }

    if ($this->settings['decoda_filters']['VideoFilter']) {
      $decoda->addFilter(new \Decoda\Filter\VideoFilter());
    }

    if ($this->settings['decoda_filters']['CodeFilter']) {
      $decoda->addFilter(new \Decoda\Filter\CodeFilter());
    }

    if ($this->settings['decoda_filters']['QuoteFilter']) {
      $decoda->addFilter(new \Decoda\Filter\QuoteFilter());
    }

    if ($this->settings['decoda_filters']['ListFilter']) {
      $decoda->addFilter(new \Decoda\Filter\ListFilter());
    }

    if ($this->settings['decoda_filters']['TableFilter']) {
      $decoda->addFilter(new \Decoda\Filter\TableFilter());
    }

    $decoda->addHook(new \Decoda\Hook\CensorHook());
    $decoda->addHook(new \Decoda\Hook\ClickableHook());

    $decoda->reset($text);
    $decoda->addHook(new \Decoda\Hook\EmoticonHook(array('path' => '/sites/default/emoticons/')));
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
