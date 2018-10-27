<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VideoTest extends DuskTestCase
{

    public function testCreateVideo()
    {
        $admin = \App\User::find(1);
        $video = factory('App\Video')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $video) {
            $browser->loginAs($admin)
                ->visit(route('admin.videos.index'))
                ->clickLink('Add new')
                ->select("clip_id", $video->clip_id)
                ->type("name", $video->name)
                ->attach("video", base_path("tests/_resources/test.jpg"))
                ->type("extention", $video->extention)
                ->type("ad_duration", $video->ad_duration)
                ->press('Save')
                ->assertRouteIs('admin.videos.index')
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Video::first()->video . "']")
                ->logout();
        });
    }

    public function testEditVideo()
    {
        $admin = \App\User::find(1);
        $video = factory('App\Video')->create();
        $video2 = factory('App\Video')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $video, $video2) {
            $browser->loginAs($admin)
                ->visit(route('admin.videos.index'))
                ->click('tr[data-entry-id="' . $video->id . '"] .btn-info')
                ->select("clip_id", $video2->clip_id)
                ->type("name", $video2->name)
                ->attach("video", base_path("tests/_resources/test.jpg"))
                ->type("extention", $video2->extention)
                ->type("ad_duration", $video2->ad_duration)
                ->press('Update')
                ->assertRouteIs('admin.videos.index')
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Video::first()->video . "']")
                ->logout();
        });
    }

    public function testShowVideo()
    {
        $admin = \App\User::find(1);
        $video = factory('App\Video')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $video) {
            $browser->loginAs($admin)
                ->visit(route('admin.videos.index'))
                ->click('tr[data-entry-id="' . $video->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='clip']", $video->clip->title)
                ->assertSeeIn("td[field-key='name']", $video->name)
                ->assertSeeIn("td[field-key='extention']", $video->extention)
                ->assertSeeIn("td[field-key='ad_duration']", $video->ad_duration)
                ->logout();
        });
    }

}
