<?php

namespace Main\App\Controllers;

use Exception;
use Main\Core\View;

class Products extends Controller
{
    /**
     * @param View $view
     */
    public function __construct (protected readonly View $view)
    {
    }

    /**
     * Renders page view file.
     *
     * @return string
     * @throws Exception
     */
    public function __invoke(): string
    {
        return $this->view->make('Products/index.php');
    }
}
