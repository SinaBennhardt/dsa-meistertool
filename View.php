<?php

class View
{
    private $extend = null;

    public function extend(string $template): void {
        $this->extend = $template;
    }

    public function render($template, array $parameters = []): string {
        $this->extend = null;

        extract($parameters, EXTR_OVERWRITE);

        ob_start();
        require $this->getPath($template);
        $content = ob_get_clean();

        if (!$this->extend) {
            return $content;
        }

        return $this->render($this->extend, array_merge($parameters, [
            '_content' => $content
        ]));
    }

    private function getPath(string $template): string {
        return __DIR__ . '/templates/' . $template . '.php';
    }
}