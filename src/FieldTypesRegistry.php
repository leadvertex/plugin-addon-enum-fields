<?php
/**
 * Created for plugin-addon-enum-fields
 * Date: 28.12.2020
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace Leadvertex\Plugin\Addon\EnumFields;


use XAKEPEHOK\EnumHelper\EnumHelper;

class FieldTypesRegistry extends EnumHelper
{
    const ADDRESS = 'AddressField';
    const BOOLEAN = 'BooleanField';
    const DATETIME = 'DateTimeField';
    const EMAIL = 'EmailField';
    const ENUM = 'EnumField';
    const FILE = 'FileField';
    const FLOAT = 'FloatField';
    const HUMAN_NAME = 'HumanNameField';
    const IMAGE = 'ImageField';
    const INTEGER = 'IntegerField';
    const PHONE = 'PhoneField';
    const STRING = 'StringField';
    const USER = 'UserField';

    public static function values(): array
    {
        return [
            self::ADDRESS,
            self::BOOLEAN,
            self::DATETIME,
            self::EMAIL,
            self::ENUM,
            self::FILE,
            self::FLOAT,
            self::HUMAN_NAME,
            self::IMAGE,
            self::INTEGER,
            self::PHONE,
            self::STRING,
            self::USER,
        ];
    }
}