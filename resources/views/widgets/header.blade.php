<?php $navbar = new Illuminate\Support\Fluent([
    'id'    => 'securex',
    'title' => 'Security',
    'url'   => handles('blupl::securex/member'),
    'menu'  => view('blupl/securex::widgets._menu'),
]); ?>

@decorator('navbar', $navbar)
