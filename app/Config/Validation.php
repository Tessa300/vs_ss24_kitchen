<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $product = [
        'name' => 'required|trim',
        'price_per_unit' => 'required|numeric',
        'is_meal' => 'required|in_list[0,1]',
        'unit_symbol' => 'required|in_list[kg,l,St.,Port.]',
        'enabled' => 'required|in_list[0,1]',
    ];

    public $product_errors = [
        'name' => [
            'required' => 'Bitte geben Sie einen Namen für das Produkt an.'
        ],
        'price_per_unit' => [
            'required' => 'Bitte geben Sie einen Preis für das Produkt an.',
            'numeric' => 'Der Preis muss eine Zahl sein.'
        ],
        'is_meal' => [
            'required' => 'Bitte geben Sie an, ob das Produkt ein Gericht ist.',
            'in_list' => 'Geben Sie nur 1 oder 0 an.'
        ],
        'unit_symbol' => [
            'required' => 'Bitte geben Sie die Einheit für das Produkt an.',
            'in_list' => 'Geben Sie nur kg, l, St. oder Port. an.'
        ],
        'enabled' => [
            'required' => 'Bitte geben Sie an, ob das Produkt aktiv ist.',
            'in_list' => 'Geben Sie nur 1 oder 0 an.'
        ]
    ];

}
