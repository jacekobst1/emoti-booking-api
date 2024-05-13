<?php

declare(strict_types=1);

namespace App\Modules\Auth\Domain\Models;

use App\Modules\Auth\Models\IdeHelperRole;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @mixin IdeHelperRole
 */
class Role extends SpatieRole
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'uuid';
}
