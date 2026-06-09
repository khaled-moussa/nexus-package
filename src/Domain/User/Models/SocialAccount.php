<?php

namespace Nexus\Domain\User\Models;

use Nexus\Domain\User\Models\Builders\SocialAccountQueryBuilder;
use Nexus\Domain\User\Models\Concerns\HasSocialAccountRelation;
use Nexus\Support\Concerns\HasUuid;
use Nexus\Support\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class SocialAccount extends BaseModel
{
    use HasFactory;
    use HasUuid;
    use HasSocialAccountRelation;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): SocialAccountQueryBuilder
    {
        return new SocialAccountQueryBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return (string) $this->uuid;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }
}