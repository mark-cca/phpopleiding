<?php

/**
 * De HTML klasse.
 */
class HTML
{
    /**
     * Toont de opgegeven pagina.
     *
     * @param string $page De naam van de pagina.
     */
    public function toon($page)
    {
        include __DIR__ . "/../../public/views/partials/mum-$page.php";
    }
}