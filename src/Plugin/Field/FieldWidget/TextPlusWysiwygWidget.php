<?php

namespace Drupal\urban_double_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Defines the 'urban_double_field_text_plus_wysiwyg' field widget.
 *
 * @FieldWidget(
 *   id = "urban_double_field_text_plus_wysiwyg",
 *   label = @Translation("Text Plus WYSIWYG"),
 *   field_types = {"urban_double_field_text_plus_wysiwyg"},
 * )
 */
class TextPlusWysiwygWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $element['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => isset($items[$delta]->title) ? $items[$delta]->title : NULL,
    ];

    $element['text'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Text'),
      '#format' => 'rich_text',
      '#default_value' => isset($items[$delta]->text) ? $items[$delta]->text : NULL,
    ];

    $element['#theme_wrappers'] = ['container', 'form_element'];
    $element['#attributes']['class'][] = 'urban-double-field-text-plus-wysiwyg-elements';
    $element['#attached']['library'][] = 'urban_double_field/urban_double_field_text_plus_wysiwyg';

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function errorElement(array $element, ConstraintViolationInterface $violation, array $form, FormStateInterface $form_state) {
    return isset($violation->arrayPropertyPath[0]) ? $element[$violation->arrayPropertyPath[0]] : $element;
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    foreach ($values as $delta => $value) {
      if ($value['title'] === '') {
        $values[$delta]['title'] = NULL;
      }
      if ($value['text'] === '') {
        $values[$delta]['text'] = NULL;
      }
      else {
        $values[$delta]['text'] = $value['text']['value'];
      }
    }
    return $values;
  }

}
