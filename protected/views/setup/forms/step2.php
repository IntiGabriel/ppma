<?php

return array(
    'elements' => array(
        'server' => array(
            'type'  => 'text',
            'size'  => '60',
        ),
        'username' => array(
            'type'  => 'text',
            'size'  => '60',
        ),
        'password' => array(
            'type'  => 'password',
            'size'  => '60',
        ),
        'name' => array(
            'type'  => 'text',
            'size'  => '60',
        ),
        'timezone' => array(
            'type' => 'dropdownlist',
            'items' => TimeZones::$zones
        ),
        '<br style="clear:both" />'
    ),

    'buttons'=>array(
        'create' => array(
            'type'  => 'submit',
            'label' => 'Create Config',
            'class' => 'button radius',
        ),
    ),
);