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
    }

    public function testGetJson(): void
    {
        $testData = [
            'foo' => 'bar'
        ];

        $this->mockResolver(function () use ($testData) {
            return $testData;
        });

        $this->schema = /** @lang GraphQL */'
            scalar Json @scalar(class: "Marqant\\\LighthouseJson\\\GraphQL\\\Scalars\\\JSON")

            type Query {
                getJson: Json! @mock
            }
        ';

        $this->setUpTestSchema();

        $response = $this->graphQL(/** @lang GraphQL */ '
            {
                getJson
            }
        ');

        $response->assertStatus(200);

        // TODO: Extend test for exact data match

        // $response->assertExactJson([
        //     'data' => [
        //         'getJson' => $testData
        //     ]
        // ]);
    }
}
