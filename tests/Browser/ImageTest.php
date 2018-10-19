<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ImageTest extends DuskTestCase
{

    public function testCreateImage()
    {
        $admin = \App\User::find(1);
        $image = factory('App\Image')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $image) {
            $browser->loginAs($admin)
                ->visit(route('admin.images.index'))
                ->clickLink('Add new')
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.images.index')
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Image::first()->image . "']")
                ->logout();
        });
    }

    public function testEditImage()
    {
        $admin = \App\User::find(1);
        $image = factory('App\Image')->create();
        $image2 = factory('App\Image')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $image, $image2) {
            $browser->loginAs($admin)
                ->visit(route('admin.images.index'))
                ->click('tr[data-entry-id="' . $image->id . '"] .btn-info')
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.images.index')
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Image::first()->image . "']")
                ->logout();
        });
    }

    public function testShowImage()
    {
        $admin = \App\User::find(1);
        $image = factory('App\Image')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $image) {
            $browser->loginAs($admin)
                ->visit(route('admin.images.index'))
                ->click('tr[data-entry-id="' . $image->id . '"] .btn-primary')

                ->logout();
        });
    }

}
