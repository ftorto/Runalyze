<?php

namespace Runalyze\Sync\Provider;


interface SyncInterface
{

    /**
     * Fetch activity list of provider
     * @return
     */
    public function fetchActivityList();

    /**
     * Fetch activity of provider
     * @return
     */
    public function fetchActivity($identifier);
}