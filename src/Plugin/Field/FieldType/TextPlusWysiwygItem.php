<?php

namespace Drupal\urban_double_field\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'urban_double_field_text_plus_wysiwyg' field type.
 *
 * @FieldType(
 *   id = "urban_double_field_text_plus_wysiwyg",
 *   label = @Translation("Text Plus WYSIWYG"),
 *   category = @Translation("General"),
 *   default_widget = "urban_double_field_text_plus_wysiwyg",
 *   default_formatter = "urban_double_field_text_plus_wysiwyg_default"
 * )
 */
class TextPlusWysiwygItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    if ($this->title !== NULL) {
      return FALSE;
    }
    elseif ($this->text !== NULL) {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    $properties['title'] = DataDefinition::create('string')
      ->setLabel(t('Title'));
    $properties['text'] = DataDefinition::create('string')
      ->setLabel(t('Text'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();

    // @todo Add more constraints here.
    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    $columns = [
      'title' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'text' => [
        'type' => 'text',
        'size' => 'big',
      ],
    ];

    $schema = [
      'columns' => $columns,
      // @DCG Add indexes here if necessary.
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {

    $random = new Random();

    $values['title'] = $random->word(mt_rand(1, 255));

    $values['text'] = $random->paragraphs(5);

    return $values;
  }

}
