<?php

return [

    'app' => [
        'name' => 'toot',
        'company' => 'NFIM Food Services',
        'meta' => [
            'author' => 'Klarizon Emar Motol',
            'description' => 'Cashless Payment System using Digital Wallet (Toot Card)',
            'keywords' => 'rfid, smart card, cashless payment, digital payment, electronic payment, food',
        ],
    ],

    'merchandises' => [
        'default_image_name' => 'default-merchandise-image',
    ],

    'status' => [
        'VALID',
        'INVALID',
        'CORRECT',
        'INCORRECT',
        'PENDING',
        'PAID',
        'CANCELED',
        'INSUFFICIENT_BALANCE',
        'SUCCESS',
        'QUEUED',
        'DONE',
        'ON_HOLD',
        'EMPTY',
        'TO_MANY_CARD_TAP',
    ],

    'payment_method' => [
        'CASH',
        'TOOT_CARD',
    ],
];