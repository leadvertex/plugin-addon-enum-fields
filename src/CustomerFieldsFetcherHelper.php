<?php
/**
 * Created for plugin-addon-enum-fields
 * Date: 29.12.2020
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace Leadvertex\Plugin\Addon\EnumFields;


use Leadvertex\Plugin\Components\Access\Token\GraphqlInputToken;
use Leadvertex\Plugin\Components\ApiClient\ApiClient;

class CustomerFieldsFetcherHelper
{

    protected static ?array $data;

    public static function getType(string $type): array
    {
        $data = [];
        $fields = self::fetch();

        foreach ($fields as $field) {
            if ($field['__typename'] === $type) {
                $data[$field['name']] = $field['label'];
            }
        }

        return $data;
    }

    public static function getTypes(array $types): array
    {
        $data = [];
        $fields = self::fetch();

        foreach ($fields as $field) {
            if (in_array($field['__typename'], $types)) {
                $data[$field['__typename']][$field['name']] = $field['label'];
            }
        }

        return $data;
    }

    protected static function fetch(): array
    {
        if (!isset(self::$data)) {

            $token = GraphqlInputToken::getInstance();
            $client = new ApiClient(
                "{$token->getBackendUri()}companies/{$token->getPluginReference()->getCompanyId()}/CRM",
                (string) $token->getOutputToken()
            );

            $response = $client->query("
                query {
                    customerFieldsFetcher(filters: {include: { archived: false }}) {
                        fields {
                            name
                            label
                            __typename
                        }
                    }
                }
            ", []);

            self::$data = $response->getData()['customerFieldsFetcher']['fields'];
        }

        return self::$data;
    }

}