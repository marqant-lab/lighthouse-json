<?php

namespace Marqant\LighthouseJson\Tests;

use Tests\TestCase;
use Nuwave\Lighthouse\Testing\MocksResolvers;
use Nuwave\Lighthouse\Testing\UsesTestSchema;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;

class JsonScalarTest extends TestCase
{
    use UsesTestSchema;
    use MakesGraphQLRequests;
    use MocksResolvers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockResolver(function () {
            return [
                'foo' => 'bar'
            ];
        });

        $this->schema = /** @lang GraphQL */'
            scalar Json @scalar(class: "Marqant\\\LighthouseJson\\\GraphQL\\\Scalars\\\JSON")

            type Query {
                getJson: Json! @mock
            }
        ';

        $this->setUpTestSchema();
    }

    public function testGetJson(): void
    {
        $response = $this->graphQL(/** @lang GraphQL */ '
            {
                getJson
            }
        ');

        dd($response->getContent());

        $response->assertStatus(200);
    }
}
