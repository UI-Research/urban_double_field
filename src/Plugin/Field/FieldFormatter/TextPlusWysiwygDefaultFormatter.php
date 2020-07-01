<?php

namespace Drupal\urban_double_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'urban_double_field_text_plus_wysiwyg_default' formatter.
 *
 * @FieldFormatter(
 *   id = "urban_double_field_text_plus_wysiwyg_default",
 *   label = @Translation("Default"),
 *   field_types = {"urban_double_field_text_plus_wysiwyg"}
 * )
 */
class TextPlusWysiwygDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {

      $title = $item->title;
      $text = $item->text;

      $element[$delta] = [
        '#type'  => 'item',
        '#title' => $title,
        '#text'  => $text,
        '#theme' => 'urban_double_field',
      ];

    }

    return $element;
  }

}
