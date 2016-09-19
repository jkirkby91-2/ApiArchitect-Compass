<?php

namespace ApiArchitect\Compass\Abstracts\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class AbstractEvent
 * @package app\Compass\Abstracts\Events
 */
abstract class AbstractEvent
{
    use SerializesModels;
}
