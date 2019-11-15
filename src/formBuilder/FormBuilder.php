<?php

namespace abstractCRUD\formBuilder;

use abstractCRUD\models\IBackendModel;
use yii\base\Model;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;
use yii\widgets\InputWidget;
use yii\base\InvalidConfigException;

/**
 * Class FormBuilder
 * @package backend\components
 */
class FormBuilder extends ActiveForm implements IFormBuilder
{
    const INPUT_CHECKBOX = 'checkbox';
    const INPUT_CHECKBOX_LIST = 'checkboxList';
    const INPUT_FILE = 'fileInput';
    const INPUT_HIDDEN = 'hiddenInput';
    const INPUT_INPUT = 'input';
    const INPUT_LIST_BOX = 'listBox';
    const INPUT_RADIO = 'radio';
    const INPUT_RADIO_LIST = 'radioList';
    const INPUT_TEXT = 'textInput';
    const INPUT_TEXTAREA = 'textarea';
    const INPUT_PASSWORD = 'passwordInput';
    const INPUT_DROPDOWN_LIST = 'dropdownList';
    const INPUT_WIDGET = 'widget';
    const INPUT_RAW = 'raw';

    /**
     * @param Model|IBackendModel $model
     * @return string|null
     * @throws InvalidConfigException
     */
    public function renderForm(Model $model)
    {
        $config = $model->getFormConfig();
        $form = null;
        foreach ($config as $attribute => $options) {
            $form .= $this->renderField($model, $attribute, $options);
        }
        return $form;
    }


    /**
     * @param Model|IBackendModel $model
     * @param string $attribute
     * @param array $options
     *
     * @return ActiveField
     * @throws InvalidConfigException
     */
    public function renderField(Model $model, $attribute, array $options = [])
    {
        $fieldOptions = $options['fieldOptions'] ?? [];
        $field = $this->field($model, $attribute, $fieldOptions);

        if ($label = $options['label'] ?? null) {
            $field->label($label, $options['labelOptions'] ?? []);
        }
        if ($hint = $options['hint'] ?? null) {
            $field->hint($hint, $options['hintOptions'] ?? []);
        }

        $type = $options['type'] ?? static::INPUT_TEXT;
        $fieldTypeOptions = $options['fieldTypeOptions'] ?? [];
        $this->prepareField($model, $field, $type, $fieldTypeOptions);

        return $field;
    }

    /**
     * @param Model|IBackendModel $model
     * @param ActiveField $field
     * @param $type
     * @param array $fieldTypeOptions
     * @throws InvalidConfigException
     */
    protected function prepareField(Model $model, ActiveField $field, string $type, array $fieldTypeOptions)
    {
        $options = $fieldTypeOptions['options'] ?? [];
        $items = $fieldTypeOptions['items'] ?? [];
        $enclosedByLabel = $options['enclosedByLabel'] ?? null;
        $input_type = $options['input_type'] ?? 'text';
        switch ($type) {
            case static::INPUT_HIDDEN:
            case static::INPUT_TEXT:
            case static::INPUT_TEXTAREA:
            case static::INPUT_PASSWORD:
            case static::INPUT_FILE:
                $field->$type($options);
                break;

            case static::INPUT_DROPDOWN_LIST:
            case static::INPUT_LIST_BOX:
            case static::INPUT_CHECKBOX_LIST:
            case static::INPUT_RADIO_LIST:
                $field->$type($items, $options);
                break;

            case static::INPUT_CHECKBOX:
                $field->$type($options, $enclosedByLabel ?? false);
                break;

            case static::INPUT_RADIO:
                $field->$type($options, $enclosedByLabel ?? true);
                break;

            case static::INPUT_INPUT:
                $field->$type($input_type, $options);
                break;

            case static::INPUT_WIDGET:
                $widgetClass = $this->getWidgetClass($options);
                $field->$type($widgetClass, $options);
                break;

            case static::INPUT_RAW:
                $value = is_callable($options['value']) ? call_user_func($options['value'], $model, $field) : $options['value'];
                $field->parts['{input}'] = $value;
                break;

            default:
                throw new InvalidConfigException("Invalid input type '{$type}' configured for the attribute.");
        }
    }

    /**
     * @param Model $model
     * @param array $tabConfig
     * @return string
     * @throws InvalidConfigException
     */
    public function prepareRows(Model $model, array $tabConfig): string
    {
        $content = '';
        foreach ($tabConfig as $attribute => $element) {
            $content .= $this->renderField($model, $attribute, $element);
        }

        return $content;
    }

    /**
     * @param array $settings
     * @return mixed
     * @throws InvalidConfigException
     */
    protected function getWidgetClass(array $settings)
    {
        $widgetClass = ArrayHelper::getValue($settings, 'class');
        if (empty($widgetClass) && !$widgetClass instanceof InputWidget) {
            throw new InvalidConfigException(
                "A valid 'widgetClass' must be setup and extend from '\\yii\\widgets\\InputWidget'."
            );
        }
        return $widgetClass;
    }

    /**
     * @param array $settings
     * @return mixed|string
     */
    protected function getValue(array $settings)
    {
        $value = ArrayHelper::getValue($settings, 'value', '');
        if (is_callable($value)) {
            return call_user_func($value);
        } elseif (!is_string($value)) {
            return '';
        }
        return $value;
    }
}
