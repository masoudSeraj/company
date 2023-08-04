<?php namespace Sunnyr\Company\Http\Services;

use Sunnyr\Company\Models\Settings;

class SettingsService
{
    public function activeSettings(): ?Settings
    {
        return Settings::where('is_active', 1)?->first();
    }

    public function postsToDisaplay() :int
    {
        return $this->activeSettings() ? $this->activeSettings()->settings['post-count'] : 7;
    }
}

