<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Bnomei\Collect;
use PHPUnit\Framework\TestCase;

final class CollectTest extends TestCase
{
    public function testConstruct()
    {
        $pvc = new Collect();
        $this->assertInstanceOf(Collect::class, $pvc);
    }

    public function testMax()
    {
        $this->assertEquals(30, page('animals')->children()->collect()->pluck('content.speed')->first());
        $this->assertEquals(40, page('animals')->children()->collect()->pluck('content')->max('speed'));
        $this->assertEquals(40, page('animals')->children()->collect()->max('content.speed'));
        $this->assertEquals(40, page('animals')->children()->_max('content.speed'));
    }

    public function testImplode()
    {
        $this->assertEquals(
            implode(', ', page('animals')->children()->pluck('tags', ', ', true)),
            page('animals')->children()
                ->collect()
                ->pluck('content.tags')
                ->flatMap(fn ($item) => explode(', ', $item))
                ->unique()
                ->implode(', ')
        );
    }

    public function testContains()
    {
        $this->assertEquals(
            page('animals')->children()->filterBy('name', '==', 'simba')->count() > 0,
            page('animals')->children()
                ->collect()
                ->contains('content.name', 'simba')
        );

        $this->assertEquals(
            page('animals')->children()->filterBy('name', '==', 'simba')->count() > 0,
            page('animals')->children()
                ->_()
                ->contains('content.name', 'simba')
        );

        $this->assertEquals(
            page('animals')->children()->filterBy('name', '==', 'simba')->count() > 0,
            page('animals')->children()
                //->collect()
                ->_contains('content.name', 'simba')
        );
    }

    public function testLaravelCollectionMethods()
    {
        $this->assertEquals(
            page('animals')->children()->last()->id(),
            page('animals')->children()
                ->_()
                ->pluck('id')
                ->last()
        );

        $this->assertEquals(
            page('animals')->children()->last()->id(),
            page('animals')->children()
                // ->_()
                ->_pluck('id')
                ->last()
        );
    }

    public function testPrimitive()
    {
        $template = page('animals')->children()
            ->collect()->pluck('template')->first();
        $this->assertIsObject($template);

        $template = page('animals')->children()
            ->collect(true)->pluck('template')->first();
        $this->assertIsArray($template);
        $this->assertCount(0, $template); // template has no toArray
    }
}
