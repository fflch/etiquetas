<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class etiquetasTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_paginaInicial(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
             ->pause(3000)
                ->assertSee('Fazer upload de arquivo csv');
        });
    }

}
