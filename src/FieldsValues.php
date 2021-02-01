<?php
/**
 * Created for plugin-addon-enum-fields
 * Date: 28.12.2020
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace Leadvertex\Plugin\Addon\EnumFields;


use Leadvertex\Plugin\Components\Form\FieldDefinitions\ListOfEnum\Values\StaticValues;
use Leadvertex\Plugin\Components\Translations\Translator;

class FieldsValues extends StaticValues
{

    public function __construct(array $types)
    {
        $values = [];
        foreach (FieldsFetcherHelper::getTypes($types) as $type => $fields) {

            $group = FieldTypesRegistry::switchCase($type, [
                FieldTypesRegistry::ADDRESS    => Translator::get('plugin-addon-enum-fields', 'Address fields'),
                FieldTypesRegistry::BOOLEAN    => Translator::get('plugin-addon-enum-fields', 'Boolean fields'),
                FieldTypesRegistry::DATETIME   => Translator::get('plugin-addon-enum-fields', 'Datetime fields'),
                FieldTypesRegistry::EMAIL      => Translator::get('plugin-addon-enum-fields', 'Email fields'),
                FieldTypesRegistry::ENUM       => Translator::get('plugin-addon-enum-fields', 'Enum fields'),
                FieldTypesRegistry::FILE       => Translator::get('plugin-addon-enum-fields', 'File fields'),
                FieldTypesRegistry::FLOAT      => Translator::get('plugin-addon-enum-fields', 'Float fields'),
                FieldTypesRegistry::HUMAN_NAME => Translator::get('plugin-addon-enum-fields', 'Human name fields'),
                FieldTypesRegistry::IMAGE      => Translator::get('plugin-addon-enum-fields', 'Image fields'),
                FieldTypesRegistry::INTEGER    => Translator::get('plugin-addon-enum-fields', 'Integer fields'),
                FieldTypesRegistry::PHONE      => Translator::get('plugin-addon-enum-fields', 'Phone fields'),
                FieldTypesRegistry::STRING     => Translator::get('plugin-addon-enum-fields', 'String fields'),
                FieldTypesRegistry::USER       => Translator::get('plugin-addon-enum-fields', 'User fields'),
            ]);

            foreach ($fields as $name => $title) {
                $values[$name] = [
                    'title' => $title,
                    'group' => $group,
                ];
            }
        }

        parent::__construct($values);
    }

}