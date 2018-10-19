<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class IndustryTest extends DuskTestCase
{

    public function testCreateIndustry()
    {
        $admin = \App\User::find(1);
        $industry = factory('App\Industry')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $industry) {
            $browser->loginAs($admin)
                ->visit(route('admin.industries.index'))
                ->clickLink('Add new')
                ->type("name", $industry->name)
                ->type("slug", $industry->slug)
                ->press('Save')
                ->assertRouteIs('admin.industries.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $industry->name)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $industry->slug)
                ->logout();
        });
    }

    public function testEditIndustry()
    {
        $admin = \App\User::find(1);
        $industry = factory('App\Industry')->create();
        $industry2 = factory('App\Industry')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $industry, $industry2) {
            $browser->loginAs($admin)
                ->visit(route('admin.industries.index'))
                ->click('tr[data-entry-id="' . $industry->id . '"] .btn-info')
                ->type("name", $industry2->name)
                ->type("slug", $industry2->slug)
                ->press('Update')
                ->assertRouteIs('admin.industries.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $industry2->name)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $industry2->slug)
                ->logout();
        });
    }

    public function testShowIndustry()
    {
        $admin = \App\User::find(1);
        $industry = factory('App\Industry')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $industry) {
            $browser->loginAs($admin)
                ->visit(route('admin.industries.index'))
                ->click('tr[data-entry-id="' . $industry->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $industry->name)
                ->assertSeeIn("td[field-key='slug']", $industry->slug)
                ->logout();
        });
    }

}
