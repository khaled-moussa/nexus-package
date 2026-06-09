<?php

namespace Nexus\Support\Models;

use Nexus\Support\Concerns\HasFormatTimestamp;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasFormatTimestamp;
}
