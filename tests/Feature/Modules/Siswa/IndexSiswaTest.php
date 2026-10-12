<?php

namespace Tests\Feature\Modules\Siswa;

use Tests\TestCase;

class IndexSiswaTest extends TestCase
{
    /**
     * Positive Test
     * An authenticated user can open the Siswa index page.
     * @return void
     */
    public function test_siswa_index_page_is_accessible_when_logged_in(): void
    {
        $response = $this->withSession([
            'access-data' => [
                'nama' => 'Tester'
            ],
            'access-role' => 'Admin',
            'access-allowed-role' => ['Admin','Kepala Pustakawan','Pustakawan']
        ])
            ->get('/siswa');

        $response->assertStatus(200)
            ->assertSee('Daftar Siswa');
    }

    /**
     * Negative Test
     * A guest (no login session) cannot open the Siswa index page
     * and is redirected to the login page.
     * @return void
     */
    public function test_siswa_index_page_is_not_accessible_when_not_logged_in(): void
    {
        $response = $this->get('/siswa');

        $this->assertNotEquals(200, $response->getStatusCode());
        $response->assertRedirect(route('auth.login'));
    }
}
