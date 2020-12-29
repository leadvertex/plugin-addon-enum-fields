<?php
/**
 * Created for plugin-addon-enum-fields
 * Date: 29.12.2020
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace Leadvertex\Plugin\Addon\EnumFields;


use Leadvertex\Plugin\Components\Access\Token\GraphqlInputToken;
use Leadvertex\Plugin\Components\ApiClient\ApiClient;

class FieldsFetcherHelper
{

    protected static ?array $data;

    public static function fetch(array $types): array
    {
        if (!isset(self::$data)) {

            $token = GraphqlInputToken::getInstance();
            $client = new ApiClient(
                $token->getBackendUri() . 'companies/stark-industries/CRM',
                (string) $token->getOutputToken()
            );

            $response = $client->query("
                query {
                    fieldsFetcher(filters: {archived: false}) {
                        fields {
                            name
                            label
                            __typename
                        }
                    }
                }
            ", []);

            self::$data = $response->getData()['fieldsFetcher']['fields'];
        }

        return array_filter(
            self::$data,
            function ($value) use ($types) {
                return in_array($value['__typename'], $types);
            }
        );
    }

}