<?php

namespace App\GraphQL\Enums;

use Folklore\GraphQL\Support\EnumType;

class CommentStatusEnum extends EnumType
{
    protected $enumObject = true;

    protected $attributes = [
        'name' => 'CommentStatus',
        'description' => 'Comment status enum'
    ];

    public function values()
    {
        return [
            'APPROVED' => '1',
            'REJECT' => '0'
        ];
    }
}
