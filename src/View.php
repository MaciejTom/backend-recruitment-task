<?php

declare(strict_types=1);

namespace App;

class View
{
    public function render(array $param): void
    {
        include_once('./templates/layout.php');
    }
}
