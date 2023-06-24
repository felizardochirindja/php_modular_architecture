<?php

namespace DDD\Modules\Catalog\Business\Types;

enum CartStatus: string {
    case Complete = 'complete';
    case Pending = 'pending';
}
