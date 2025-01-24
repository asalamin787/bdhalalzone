<?php

namespace App\Models\Traits;

use App\Models\Meta;
use Illuminate\Support\Facades\Cache;
use Error;
use Exception;

trait HasMeta
{
    public function metas()
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    /**
     * Create or Update Single Meta
     *
     * @param  string $key
     * @param  mixed $value
     * @return bool
     */
    public function createMeta(string $key, $value): bool
    {
        try {
            // Update or create the meta
            $this->metas()->updateOrCreate(['column_name' => $key], ['column_value' => $value]);
            
            // Clear the cache for the specific meta key
            Cache::forget($this->getMetaCacheKey($key));

            return true;
        } catch (Exception | Error $e) {
            return false;
        }
    }

    /**
     * Create or Update Multiple Meta 
     *
     * @param  array $data
     * @return bool
     */
    public function createMetas(array $data): bool
    {
        try {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $value = json_encode($value);
                } elseif (is_file($value)) {
                    if ($this->metas()->where('column_name', $key)->exists()) {
                        $previousValue = $this->metas()->where('column_name', $key)->first();
                        if (file_exists($previousValue->column_value)) {
                            unlink($previousValue->column_value);
                        }
                    }
                    $value = $value->store('metas');
                }

                // Update or create the meta
                $this->metas()->updateOrCreate(['column_name' => $key], ['column_value' => $value]);

                // Clear the cache for the specific meta key
                Cache::forget($this->getMetaCacheKey($key));
            }
            return true;
        } catch (Exception | Error $e) {
            return false;
        }
    }

    /**
     * Get a Meta value
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        if (in_array($key, $this->meta_attributes)) {
            // Attempt to get the meta value from cache
            return Cache::remember($this->getMetaCacheKey($key), 100, function () use ($key) {
                return $this->metas()->where('column_name', $key)->value('column_value') ?? null;
            });
        }

        return parent::__get($key);
    }

    /**
     * Generate a cache key for a meta attribute
     *
     * @param  string $key
     * @return string
     */
    protected function getMetaCacheKey(string $key): string
    {
        return 'meta_' . $this->getTable() . '_' . $this->id . '_' . $key;
    }
}
