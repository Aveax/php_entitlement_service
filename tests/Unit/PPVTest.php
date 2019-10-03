<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\User;
use App\PPV;
use App\Services\PPVService;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class PPVTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function test_get_all_ppv()
    {
        // 2 bcs two ppv are inserted automatically after table create
        $this->assertCount(2, (new PPVService)->getAllPPV());
    }

    /** @test **/
    public function test_create_ppv()
    {
        $ppv_count = count(PPV::all());

        $faker = Faker::create();

        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(['title' => $faker->regexify('[A-Za-z0-9]{10}')]);
        $request->request->add(['content' => $faker->regexify('[A-Za-z0-9]{10}')]);

        (new PPVService)->createPPV($request);

        $this->assertCount($ppv_count + 1, (new PPVService)->getAllPPV());
    }

    /** @test **/
    public function test_get_ppv()
    {
        $ppv = factory(PPV::class)->create();

        $check = $this->equals($ppv, (new PPVService)->getPPV($ppv->id));

        $this->assertTrue($check);
    }

    public function equals($first, $second)
    {
        $keys = ['id', 'title', 'content', 'updated_at', 'created_at'];
        foreach($keys as $key){
            if($first[$key] != $second[$key]){
                return false;
            }
        }
        return true;
    }

    /** @test **/
    public function test_add_permission()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $ppv = factory(PPV::class)->create();

        (new PPVService)->addPermissionForPPV($ppv->id);

        $check = $ppv->users->contains($user->id);

        $this->assertTrue($check);
    }

    /** @test **/
    public function test_remove_permission()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $ppv = factory(PPV::class)->create();
        (new PPVService)->addPermissionForPPV($ppv->id);

        $ppv->users()->detach($user->id);

        $check = $ppv->users->contains($user->id);

        $this->assertFalse($check);
    }

    /** @test **/
    public function test_check_permission_for_ppv_with_single_access()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $ppv = factory(PPV::class)->create();

        (new PPVService)->addPermissionForPPV($ppv->id);

        $permission = (new PPVService)->checkUserPermissionForPPV($ppv);

        $this->assertTrue($permission['access']);
    }

    /** @test **/
    public function test_check_if_dont_have_permission_for_ppv_with_single_access()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $ppv = factory(PPV::class)->create();

        $permission = (new PPVService)->checkUserPermissionForPPV($ppv);

        $this->assertFalse($permission['access']);
    }

    /** @test **/
    public function test_check_permission_for_ppv_with_season_pass()
    {
        $user = factory(User::class)->create();
        $user->season_pass = date('Y-m-d H:i:s ', strtotime(' + 7 days'));
        $this->actingAs($user);

        $ppv = factory(PPV::class)->create();

        $permission = (new PPVService)->checkUserPermissionForPPV($ppv);

        $this->assertTrue($permission['season_pass']);
    }

    /** @test **/
    public function test_check_if_dont_have_permission_for_ppv_with_season_pass()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $ppv = factory(PPV::class)->create();

        $permission = (new PPVService)->checkUserPermissionForPPV($ppv);

        $this->assertFalse($permission['season_pass']);
    }
}
