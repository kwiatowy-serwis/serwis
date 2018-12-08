<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;


    public function getRegisterRoute()
    {
        return route('register');
    }

    public function getHomeRoute()
    {
        return route('home');
    }

    public function testUserCanSeeRegisterForm()
    {
        $response = $this->get($this->getRegisterRoute());
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    public function testUserCannotSeeRegisterFormWhenAuthenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get($this->getRegisterRoute());
        $response->assertRedirect($this->getHomeRoute());
    }

    public function testUserCanRegisterWithCorrectCredentials()
    {
        $name = 'testname';
        $email = 'test@email.com';
        $password = 'securePassword';

        $response = $this->from($this->getRegisterRoute())->post($this->getRegisterRoute(),[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        ]);

        $response->assertRedirect($this->getHomeRoute());
        $this->assertCount(1, $users = User::all());
        $this->assertAuthenticatedAs($user = $users->first());
        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertTrue(Hash::check($password, $user->password));
    }


    public function testUserCannotRegisterWithIncorrectEmail()
    {
        $name = 'testname';
        $email = 'testEmail';
        $password = 'securePassword';

        $response = $this->from($this->getRegisterRoute())->post($this->getRegisterRoute(),[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => 'differentConfirmPassword'
        ]);

        $this->assertCount(0, $users = User::all());

        $response->assertRedirect($this->getRegisterRoute());
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));

        $this->assertGuest();
    }


    public function testUserCannotRegisterWithoutName()
    {
        $name = '';
        $email = 'test@email.com';
        $password = 'securePassword';

        $response = $this->from($this->getRegisterRoute())->post($this->getRegisterRoute(),[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => 'differentConfirmPassword'
        ]);

        $this->assertCount(0, $users = User::all());

        $response->assertRedirect($this->getRegisterRoute());
        $response->assertSessionHasErrors('name');

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));

        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutEmail()
    {
        $name = 'testname';
        $email = '';
        $password = 'securePassword';

        $response = $this->from($this->getRegisterRoute())->post($this->getRegisterRoute(),[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => 'differentConfirmPassword'
        ]);

        $this->assertCount(0, $users = User::all());

        $response->assertRedirect($this->getRegisterRoute());
        $response->assertSessionHasErrors('email');

        $this->assertTrue(session()->hasOldInput('name'));

        $this->assertFalse(session()->hasOldInput('password'));

        $this->assertGuest();
    }


    public function testUserCannotRegisterWhenConfirmPasswordIsDifferent()
    {
        $name = 'testname';
        $email = 'test@email.com';
        $password = 'securePassword';

        $response = $this->from($this->getRegisterRoute())->post($this->getRegisterRoute(),[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => 'differentConfirmPassword'
        ]);

        $this->assertCount(0, User::all());
        $response->assertRedirect($this->getRegisterRoute());
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutPasswordConfirmation()
    {
        $name = 'testname';
        $email = 'test@email.com';
        $password = 'securePassword';

        $response = $this->from($this->getRegisterRoute())->post($this->getRegisterRoute(),[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => ''
        ]);

        $this->assertCount(0, User::all());
        $response->assertRedirect($this->getRegisterRoute());
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutPassword()
    {
        $name = 'testname';
        $email = 'test@email.com';
        $password = '';

        $response = $this->from($this->getRegisterRoute())->post($this->getRegisterRoute(),[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => 'confirmation'
        ]);

        $this->assertCount(0, User::all());
        $response->assertRedirect($this->getRegisterRoute());
        $response->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('name'));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertGuest();
    }
}
