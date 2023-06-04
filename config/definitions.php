<?php

return [
    'Calculator' => \DI\create('\Boatrace\Ninja\Calculator')->constructor(
        \DI\get('MainCalculator')
    ),
    'MainCalculator' => function ($container) {
        return $container->get('\Boatrace\Ninja\MainCalculator');
    },
];
