<?php
declare(strict_types=1);

namespace App\GraphQL\Serialize;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Serialize
 *
 * @package App\GraphQL\Serialize
 */
abstract class Serialize
{
    /**
     * @param  Collection|Model[]|null $collection
     *
     * @return Collection
     */
    public static function collection(?Collection $collection): Collection
    {
        if ($collection === null) {
            return new Collection();
        }

        return $collection->map(static::map());
    }

    /**
     * @param object $model
     *
     * @return array
     */
    public static function serialize($model): array
    {
        if ($model === null) {
            return [];
        }

        return app(static::class)->toArray($model);
    }

    /**
     * @return \Closure
     */
    public static function map(): \Closure
    {
        return function ($model) {
            return static::serialize($model);
        };
    }

    /**
     * @param object $model
     *
     * @return array
     */
    public function toArray($model): array
    {
        return $model->toArray();
    }
}