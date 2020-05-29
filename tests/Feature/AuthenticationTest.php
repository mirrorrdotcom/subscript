<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_needs_to_login_to_access_dashboard()
    {
        $this->get("/")->assertRedirect("/login");
    }

    protected function login(string $email, string $password = "password")
    {
        return $this->from("/login")
            ->post("/login", [ "email" => $email, "password" => $password ]);
    }

    /** @test */
    public function user_sees_login_form()
    {
        $this->get("/login")
            ->assertOk()
            ->assertSeeText("Login")
            ->assertSeeText("Email Address")
            ->assertSeeText("Password")
            ->assertSeeText("Login");
    }

    /** @test */
    public function user_cannot_login_without_email()
    {
        $response = $this->login("");

        $response->assertRedirect("/login")
            ->assertSessionHasErrors("email");

        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_without_password()
    {
        $response = $this->login("test@email.com", "");

        $response->assertRedirect("/login")
            ->assertSessionHasErrors("password");

        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_with_invalid_email()
    {
        $user = factory(User::class)->create();

        $response = $this->login("invalid@email.com");

        $response->assertRedirect("/login")
            ->assertSessionHasErrors("error");

        $this->assertGuest();
    }

    /** @test */
    public function user_cannot_login_with_invalid_password()
    {
        $user = factory(User::class)->create();

        $response = $this->login($user->email, "incorrect-password");

        $response->assertRedirect("/login")
            ->assertSessionHasErrors("error");

        $this->assertGuest();
    }

    /** @test */
    public function user_logs_in_and_is_redirected_to_dashboard()
    {
        $user = factory(User::class)->create();

        $response = $this->login($user->email);

        $response->assertRedirect("/");

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function authenticated_user_is_redirected_to_dashboard()
    {
        $user = factory(User::class)->create();

        $this->be($user);

        $response = $this->login($user->email);

        $response->assertRedirect("/");
    }
}
