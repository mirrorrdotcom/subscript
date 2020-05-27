<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Traits\CommandValidationErrors;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MakeUserCommand extends Command
{
    use CommandValidationErrors;

    protected $signature = 'make:user';
    protected $description = 'Create a new user and store it to the database.';
    protected array $rules;

    public function __construct()
    {
        parent::__construct();

        $this->setValidationRules();
    }

    public function handle()
    {
        $data = $this->promptData();

        $validator = $this->validate($data);

        if ($validator->fails()) {
            $this->error($this->errorsToString($validator->errors()));
            return;
        }

        $this->createUser($data);

        $this->info("User created successfully!");
    }

    private function setValidationRules()
    {
        $this->rules = [
            "first_name" => [ "required", "min:2", "max:255" ],
            "last_name" => [ "required", "min:2", "max:255" ],
            "email" => [
                "required",
                "email",
                Rule::unique("users", "email")
                    ->where(fn($q) => $q->whereNull("deleted_at"))
            ],
            "password" => [ "required", "min:8", "max:255" ],
        ];
    }

    private function promptData(): array
    {
        return [
            "first_name" => $this->ask("First Name"),
            "last_name" => $this->ask("Last Name"),
            "email" => $this->ask("Email Address"),
            "password" => $this->secret("Password"),
            "email_verified_at" => Carbon::now()
        ];
    }

    private function validate(array $data): ValidatorContract
    {
        return Validator::make($data, $this->rules);
    }

    private function createUser(array $data): User
    {
        $data["password"] = Hash::make($data["password"]);

        return User::create($data);
    }
}
