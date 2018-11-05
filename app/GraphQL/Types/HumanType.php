<?php

namespace App\GraphQL\Types;

use GraphQL;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class HumanType extends GraphQLType
{

    protected $attributes = [
        'name' => 'Human',
        'description' => 'A human.'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the human.',
            ],
            'appearsIn' => [
                'type' => Type::nonNull(Type::listOf(GraphQL::type('Episode'))),
                'description' => 'A list of episodes in which the human has an appearance.'
            ],
            'totalCredits' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The total amount of credits this human owns.'
            ]
        ];
    }

    public function interfaces()
    {
        return [
            GraphQL::type('Character')
        ];
    }
}