<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('bnomei/collect', [
    'options' => [

    ],
    'collectionMethods' => [
            'collect' => function (bool $primitive = false) {
                $data = $this->toArray();
                if ($primitive) {
                    $data = json_decode(json_encode($data), true);
                }
                return collect($data);
            },
            '_' => function (bool $primitive = false) {
                return $this->collect($primitive);
            },
        ] + \Bnomei\Collect::collectionMethods(),
]);
