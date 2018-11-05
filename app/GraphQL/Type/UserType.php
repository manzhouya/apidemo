<?php

namespace App\GraphQL\Type;

use App\GraphQL\Fields\PictureField;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class UserType extends BaseType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A User'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of the user'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The email of the user'
            ],
            'comments' => [
                'type' => Type::listOf(GraphQL::type('Comment')),
                'description' => 'The comments by the user'
            ],
            'picture' => PictureField::class
        ];
    }

    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return strtolower($root->created_at);
    }

    protected function resolveCommentsField($root, $args)
    {
        if (isset($args['id'])) {
            return $root->comments->where('id', $args['id']);
        }

        return $root->comments;
    }
}
