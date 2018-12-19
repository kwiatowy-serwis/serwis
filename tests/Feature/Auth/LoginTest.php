<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanViewALoginForm()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testUserCannotViewALoginFormWhenAuthenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }

    public function testUserCanLoginWithCorrectCredentials()
    {
        $user = factory(User::class)->create([
             'password' => bcrypt($password = 'i-love-laravel'),
         ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function testUserCannotLoginWithIncorrectPassword()
    {
        $user = factory(User::class)->create([
             'password' => bcrypt('i-love-laravel'),
         ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testRememberMeFunctionality()
    {
        $user = factory(User::class)->create([
             'id' => random_int(1, 100),
             'password' => bcrypt($password = 'i-love-laravel'),
         ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);

        $response->assertRedirect('/home');
        // cookie assertion goes here
        $this->assertAuthenticatedAs($user);
    }

    public function testUserCannotLoginWithEmailThatNotExist()
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'email@fake.com',
            'password' => 'test',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCanLogout()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->post('/logout');
        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function testUserCannotLogoutWhenAuthenticated()
    {

        $response = $this->post('/logout');
        $response->assertRedirect('/');
        $this->assertGuest();
    }


    public function testUserCannotLoginMoreThanFiveTimes()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('testPassword'),
            'email' => 'fake@login.com'
        ]);

        foreach (range(0, 5) as $i)
        {
            $response = $this->from('/login')->post('/login', [
                'email' => $user->email,
                'password' => 'invalidPass'
            ]);
        }

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');



        $this->assertContains('Too many login attempts.',
          collect($response
                      ->baseResponse
                      ->getSession()
                      ->get('errors')
                      ->getBag('default')
                      ->get('email')
          )->first());

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));

    }

}
