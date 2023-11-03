<?php
/**
 * Created for plugin-addon-enum-fields
 * Date: 29.12.2020
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace Leadvertex\Plugin\Addon\EnumFields;


use Leadvertex\Plugin\Components\Access\Token\GraphqlInputToken;
use Leadvertex\Plugin\Components\ApiClient\ApiClient;

class CustomerFieldsFetcherHelper extends FieldsFetcherHelper
{

    protected static ?array $data;

    protected static function fetch(): array
    {
        if (!isset(self::$data)) {

            $token = GraphqlInputToken::getInstance();
            $client = new ApiClient(
                "{$token->getBackendUri()}companies/{$token->getPluginReference()->getCompanyId()}/CRM",
                (string)$token->getOutputToken()
            );

            $response = $client->query("
                query {
                  fields {
                    customerFieldsFetcher(filters: { include: { archived: false } }) {
                      fields {
                        name
                        label
                        __typename
                      }
                    }
                  }
                }
            ", []);

            self::$data = $response->getData()['fields']['customerFieldsFetcher']['fields'];
        }

        return self::$data;
    }

}