<?php

declare(strict_types=1);

namespace Bnomei;

use Kirby\Cms\Collection;

final class Collect
{
    public static function call(Collection $collection, string $method, $args)
    {
        $collection = collect($collection->toArray());
        if (!is_array($args)) {
            $args = [$args];
        }
        var_dump($collection);
        return $collection->{$method}(...$args);
    }

    public static function collectionMethods(): array
    {
        $methodNames = [
            'all', 'average', 'avg',
            'chunk', 'chunkWhile', 'collapse', 'collect', 'combine', 'concat', 'contains', 'containsStrict', 'count', 'countBy', 'crossJoin',
            'dd', 'diff', 'diffAssoc', 'diffKeys', 'doesntContain', 'dump  duplicates', 'duplicatesStrict',
            'each', 'eachSpread', 'every', 'except',
            'filter', 'first', 'firstOrFail', 'firstWhere', 'flatMap', 'flatten', 'flip', 'forget', 'forPage',
            'get', 'groupBy',
            'has', 'implode', 'intersect', 'intersectByKeys', 'isEmpty', 'isNotEmpty',
            'join',
            'keyBy', 'keys',
            'last', 'lazy',
            'macro', 'make', 'map', 'mapInto', 'mapSpread', 'mapToGroups', 'mapWithKeys', 'max', 'median', 'merge', 'mergeRecursive', 'min', 'mode',
            'nth',
            'only',
            'pad', 'partition', 'pipe', 'pipeInto', 'pipeThrough', 'pluck', 'pop', 'prepend', 'pull', 'push', 'put',
            'random', 'range', 'reduce', 'reduceSpread', 'reject', 'replace', 'replaceRecursive', 'reverse ',
            'search', 'shift', 'shuffle', 'sliding', 'skip', 'skipUntil', 'skipWhile', 'slice', 'sole', 'some', 'sort', 'sortBy', 'sortByDesc', 'sortDesc', 'sortKeys', 'sortKeysDesc', 'sortKeysUsing', 'splice', 'split', 'splitIn', 'sum',
            'take', 'takeUntil', 'takeWhile', 'tap', 'times', 'toArray', 'toJson', 'transform',
            'undot', 'union', 'unique', 'uniqueStrict', 'unless', 'unlessEmpty', 'unlessNotEmpty', 'unwrap',
            'values',
            'when', 'whenEmpty', 'whenNotEmpty', 'where', 'whereStrict', 'whereBetween', 'whereIn', 'whereInStrict', 'whereInstanceOf', 'whereNotBetween', 'whereNotIn', 'whereNotInStrict', 'whereNotNull', 'whereNull', 'wrap',
            'zip'
        ];

        $methods = [];
        foreach ($methodNames as $methodName) {
            $methods['_' . $methodName] = function (...$args) use ($methodName) {
                return Collect::call($this, $methodName, $args);
            };
        }

        return $methods;
    }
}
