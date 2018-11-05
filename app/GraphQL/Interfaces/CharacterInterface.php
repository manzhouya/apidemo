<?php

namespace App\GraphQL\Interfaces;

use Folklore\GraphQL\Support\InterfaceType;
use GraphQL;
use GraphQL\Type\Definition\Type;

class CharacterInterface extends InterfaceType {
    protected $attributes = [
        'name' => 'Character',
        'description' => 'Character interface',
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the character.'
            ],
            'appearsIn' => [
                'type' => Type::nonNull(Type::listOf(GraphQL::type('Episode'))),
                'description' => 'A list of episodes in which the character has an appearance.'
            ],
        ];
    }

    public function resolveType($root)
    {
        // Use the resolveType to resolve the Type which is implemented trough this interface
        $type = $root['type'];
        if ($type === 'human') {
            return GraphQL::type('Human');
        } else if  ($type === 'droid') {
            return GraphQL::type('Droid');
        }
    }
}
