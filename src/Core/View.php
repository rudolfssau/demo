<?php

declare(strict_types=1);

namespace Main\Core;

use Exception;

class View
{
    /**
     * Constant for defining the location of view files.
     */
    private string $template_directory = "../src/App/Views/";

    /**
     * Given the file location, returns a new view.
     *
     * @param string $view
     * @param array $args
     * @return string
     * @throws Exception
     */
    public function make(string $view, array $args = []): string
    {
        return $this->render($view, $args);
    }

    /**
     * render() is responsible for rendering view files.
     * It searches if the file is present, and afterward it loads it.
     *
     * @throws Exception
     */
    public function render(string $view, array $args = []): string
    {
        extract($args, EXTR_SKIP);
        ob_start();
        $string = $this->template_directory . $view;
        $file = $string;
        if (!is_readable($file)) {
            throw new Exception("$file not found");
        }
        require $file;
        $viewObject = ob_get_contents();

        return (string) $viewObject;
    }
}

