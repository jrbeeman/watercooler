<?php

namespace Drupal\decoda\Plugin\Filter;

use Drupal\Core\Form\FormStateInterface;
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
 *   settings = {
 *     "decoda_filters" = {},
 *     "decoda_config_path" = "",
 *     "decoda_emoticons_path" = ""
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
        'CensorHook' => $this->t('Censored words'),
      ),
      '#default_value' => $this->settings['decoda_filters'],
    );

    $form['decoda_config_path'] = array(
      '#title' => $this->t('Custom configuration path path'),
      '#description' => $this->t('See README.md for more information on how to use this setting.'),
      '#type' => 'textfield',
      '#default_value' => $this->settings['decoda_config_path'],
    );

    $form['decoda_emoticons_path'] = array(
      '#title' => $this->t('Emoticons folder path'),
      '#description' => $this->t('Setting this value will enable the emoticons filter. This folder must be a web-accessible path.'),
      '#type' => 'textfield',
      '#default_value' => $this->settings['decoda_emoticons_path'],
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $decoda = new Decoda\Decoda();

    if ($this->settings['decoda_config_path']) {
      $decoda->addPath($this->settings['decoda_config_path']);
    }

    $decoda->addFilter(new Decoda\Filter\DefaultFilter());
    $decoda->addFilter(new Decoda\Filter\UrlFilter());
    $decoda->addFilter(new Decoda\Filter\TextFilter());

    if ($this->settings['decoda_filters']['EmailFilter']) {
      $decoda->addFilter(new Decoda\Filter\EmailFilter());
    }

    if ($this->settings['decoda_filters']['ImageFilter']) {
      $decoda->addFilter(new Decoda\Filter\ImageFilter());
    }

    if ($this->settings['decoda_filters']['BlockFilter']) {
      $decoda->addFilter(new Decoda\Filter\BlockFilter());
    }

    if ($this->settings['decoda_filters']['VideoFilter']) {
      $decoda->addFilter(new Decoda\Filter\VideoFilter());
    }

    if ($this->settings['decoda_filters']['CodeFilter']) {
      $decoda->addFilter(new Decoda\Filter\CodeFilter());
    }

    if ($this->settings['decoda_filters']['QuoteFilter']) {
      $decoda->addFilter(new Decoda\Filter\QuoteFilter());
    }

    if ($this->settings['decoda_filters']['ListFilter']) {
      $decoda->addFilter(new Decoda\Filter\ListFilter());
    }

    if ($this->settings['decoda_filters']['TableFilter']) {
      $decoda->addFilter(new Decoda\Filter\TableFilter());
    }

    if ($this->settings['decoda_filters']['CensorHook']) {
      $decoda->addHook(new Decoda\Hook\CensorHook());
    }

    if ($this->settings['decoda_emoticons_path']) {
      $decoda->addHook(new Decoda\Hook\EmoticonHook(array('path' => $this->settings['decoda_emoticons_path'])));
    }

    $decoda->addHook(new Decoda\Hook\ClickableHook());
    $decoda->reset($text);
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
