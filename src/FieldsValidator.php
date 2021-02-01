<?php
/**
 * Created for plugin-addon-enum-fields
 * Date: 28.12.2020
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace Leadvertex\Plugin\Addon\EnumFields;


use Leadvertex\Plugin\Components\Form\Components\ValidatorInterface;
use Leadvertex\Plugin\Components\Form\FieldDefinitions\FieldDefinition;
use Leadvertex\Plugin\Components\Form\FieldDefinitions\ListOfEnumDefinition;
use Leadvertex\Plugin\Components\Form\FormData;
use Leadvertex\Plugin\Components\Translations\Translator;

class FieldsValidator implements ValidatorInterface
{

    private array $types;
    private bool $allowNull;

    public function __construct(array $types, bool $allowNull)
    {
        $this->types = $types;
        $this->allowNull = $allowNull;
    }

    /**
     * @param $values
     * @param ListOfEnumDefinition|FieldDefinition $definition
     * @param FormData $data
     * @return array
     */
    public function __invoke($values, FieldDefinition $definition, FormData $data): array
    {
        $errors = [];

        if (is_null($values) && $this->allowNull === false) {
            $errors[] = Translator::get(
                'plugin-addon-enum-fields',
                'Value can not be null'
            );
        }

        if (!is_array($values)) {
            $errors[] = Translator::get(
                'plugin-addon-enum-fields',
                'Incorrect value'
            );
            return $errors;
        }

        $limit = $definition->getLimit();
        $count = count($values);

        if ($count < $limit->getMin()) {
            $errors[] = Translator::get(
                'plugin-addon-enum-fields',
                'You should choose minimum of {option} option(s)',
                ['option' => $limit->getMin()]
            );
        }

        if ($count > $limit->getMin()) {
            $errors[] = Translator::get(
                'plugin-addon-enum-fields',
                'You should choose less than {option} option(s)',
                ['option' => $limit->getMax()]
            );
        }

        if ($count > $limit->getMin()) {
            $errors[] = Translator::get(
                'plugin-addon-enum-fields',
                'You should choose less than {option} option(s)',
                ['option' => $limit->getMax()]
            );
        }

        $fields = array_column(FieldsFetcherHelper::fetch($this->types), 'name');
        foreach ($values as $value) {
            if (!in_array($values, $fields)) {
                $errors[] = Translator::get(
                    'plugin-addon-enum-fields',
                    'Invalid value "{value}"',
                    ['value' => (string) $value]
                );
            }
        }

        return $errors;
    }
}