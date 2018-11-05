<?php

namespace App\GraphQL\Query;

use App\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'created_at' => ['name' => 'created_at', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $fields = $info->getFieldSelection($depth = 3);

        if (isset($args['id'])) {
            $users = User::where('id', $args['id']);
        } elseif (isset($args['email'])) {
            $users = User::where('email', $args['email']);
        } else {
            $users = User::query();
        }

        foreach ($fields as $field => $keys) {
            if ($field === 'comments') {
                $users->with('comments');
            }
        }

        return $users->get();
    }
}
