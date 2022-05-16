# Kirby 3 Collect

![Release](https://flat.badgen.net/packagist/v/bnomei/kirby3-collect?color=ae81ff)
![Downloads](https://flat.badgen.net/packagist/dt/bnomei/kirby3-collect?color=272822)
[![Build Status](https://flat.badgen.net/travis/bnomei/kirby3-collect)](https://travis-ci.com/bnomei/kirby3-collect)
[![Coverage Status](https://flat.badgen.net/coveralls/c/github/bnomei/kirby3-collect)](https://coveralls.io/github/bnomei/kirby3-collect) 
[![Maintainability](https://flat.badgen.net/codeclimate/maintainability/bnomei/kirby3-collect)](https://codeclimate.com/github/bnomei/kirby3-collect) 
[![Twitter](https://flat.badgen.net/badge/twitter/bnomei?color=66d9ef)](https://twitter.com/bnomei)

Extends Kirby collections with all Laravel collection methods

## Commercial Usage

> <br>
> <b>Support open source!</b><br><br>
> This plugin is free but if you use it in a commercial project please consider to sponsor me or make a donation.<br>
> If my work helped you to make some cash it seems fair to me that I might get a little reward as well, right?<br><br>
> Be kind. Share a little. Thanks.<br><br>
> &dash; Bruno<br>
> &nbsp; 

| M | O | N | E | Y |
|---|----|---|---|---|
| [Github sponsor](https://github.com/sponsors/bnomei) | [Patreon](https://patreon.com/bnomei) | [Buy Me a Coffee](https://buymeacoff.ee/bnomei) | [Paypal dontation](https://www.paypal.me/bnomei/15) | [Hire me](mailto:b@bnomei.com?subject=Kirby) |

## Installation

- unzip [master.zip](https://github.com/bnomei/kirby3-collect/archive/master.zip) as folder `site/plugins/kirby3-collect` or
- `git submodule add https://github.com/bnomei/kirby3-collect.git site/plugins/kirby3-collect` or
- `composer require bnomei/kirby3-collect`

## Why Laravel collections?

This is a plugin for those that create web-projects in Kirby that have to manipulate lots of array data and want to [refactor to collections](https://adamwathan.me/refactoring-to-collections/) to avoid excessive use of `foreach`-loops and `if`-clauses.

## Usage

See official Laravel docs on how to use the [collect](https://laravel.com/docs/9.x/collections)-helper and the collection methods.

all, average, avg, **chunk**, chunkWhile, collapse, collect, combine, concat, contains, containsStrict, **count**, countBy, crossJoin, dd, diff, diffAssoc, diffKeys, doesntContain, dump  duplicates, duplicatesStrict, each, eachSpread, every, except, filter, **first**, firstOrFail, firstWhere, flatMap, flatten, **flip**, forget, forPage, **get**, **groupBy**, **has**, implode, intersect, intersectByKeys, **isEmpty**, isNotEmpty, join, keyBy, keys, last, lazy, macro, make, **map**, mapInto, mapSpread, mapToGroups, mapWithKeys, max, median, merge, mergeRecursive, min, mode, **nth**, only, pad, partition, pipe, pipeInto, pipeThrough, **pluck**, pop, **prepend**, pull, push, put, **random**, range, reduce, reduceSpread, reject, replace, replaceRecursive, reverse  **search**, shift, **shuffle**, sliding, skip, skipUntil, skipWhile, **slice**, sole, some, **sort**, **sortBy**, sortByDesc, sortDesc, sortKeys, sortKeysDesc, sortKeysUsing, splice, split, splitIn  sum, take, takeUntil, takeWhile, tap, times, **toArray**, **toJson**, transform, undot, union, unique, uniqueStrict, unless, unlessEmpty, unlessNotEmpty, unwrap, **values**, **when**, whenEmpty, whenNotEmpty, where, whereStrict, whereBetween, whereIn, whereInStrict, whereInstanceOf, whereNotBetween, whereNotIn, whereNotInStrict, whereNotNull, whereNull, wrap, zip

The methodnames in bold indicate that Kirby has a similar collection method. It also features to [some additional methods](https://getkirby.com/docs/reference/objects/cms/collection).

### Laravel collections from an array

You can also get a laravel collection object from any array.

```php
$laravelCollection = collect($array);
```

### Create a Laravel collection from a Kirby collection

```php
// retrieve a kirby collection
$kirbyCollection = site()->index()->children();

// get a laravel collection object from a kirby collection
$laravelCollection = $kirbyCollection->collect();
$laravelCollection = $kirbyCollection->_();
```

### Primitive data-types only

You can also convert all objects into primitive types using json encoding and decoding. But be warned that most of Kirby's core objects will not ([yet](https://kirby.nolt.io/431)) automatically serialize themselves.

```php 
$laravelCollection = $kirbyCollection->collect(true); 
$laravelCollection = $kirbyCollection->_(true);
```

### When to use Laravel collection methods (and when not)

To achieve certain common use-cases the Laravel collections methods are a bit more explicit than Kirby's collection methods.

```php
$mostPopularPage = $kirbyCollection
    ->sortBy('viewcount')
    ->last()
    ->viewcount()
    ->toInt();
    
$mostPopularPage = $kirbyCollection
    ->collect()
    ->max('content.viewcount');
```

```php
$hasProductWithBookcase = $kirbyCollection
    ->filterBy('product', '==', 'Bookcase')
    ->count() > 0;
    
$hasProductWithBookcase = $kirbyCollection
    ->collect()
    ->contains('content.product', 'Bookcase');
```

But keep in mind that Kirby's collection methods have been tailored to work with the core objects like `Page` and make some tasks very easy where using Laravel collection methods would be more tedious.

```php
$allTags = $kirbyCollection
    ->pluck('tags', ', ', true);
    
$allTags = $kirbyCollection
    ->collect()
    ->pluck('content.tags')
    ->flatMap(fn($item) => explode(', ', $item))
    ->unique();
```

### Underscore shorthand

Instead of calling the `->collect()`/`_()` collection method evert time you can also use underscore to **start** with laravel collections object. But any further method calls do not need the `_` prefix.

```php
$mostPopularPage = $kirbyCollection
    ->_max('content.viewcount');

$hasProductWithBookcase = $kirbyCollection
    ->_contains('content.product', 'Bookcase');

$allTags = $kirbyCollection
    ->_pluck('content.tags')
    ->flatMap(fn($item) => explode(', ', $item))
    ->unique();
```

## Dependencies

- [illuminate/collections](https://github.com/illuminate/collections)

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/bnomei/kirby3-collect/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
