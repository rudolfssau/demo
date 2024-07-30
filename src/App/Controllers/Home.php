<?php

namespace Main\App\Controllers;

use Exception;
use Main\Core\View;

class Home extends Controller
{
    /**
     * @param View $view
     */
    public function __construct (protected readonly View $view)
    {
    }

    /**
     * Responsible for rendering the Home/index.php file with the help of the view class located in src/Core.
     *
     * @return string
     * @throws Exception
     */
    public function __invoke(): string
    {
        return $this->view->make('Home/index.php');
    }
}
