<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

#[Signature('portfolio:admin {action : grant or revoke} {email : Email address of an existing verified account}')]
#[Description('Grant or revoke access to the portfolio administration panel')]
class PromotePortfolioAdmin extends Command
{
    public function handle(): int
    {
        $arguments = [
            'action' => $this->argument('action'),
            'email' => $this->argument('email'),
        ];

        try {
            Validator::make($arguments, [
                'action' => ['required', 'in:grant,revoke'],
                'email' => ['required', 'email'],
            ])->validate();
        } catch (ValidationException $exception) {
            $this->error($exception->validator->errors()->first());

            return self::FAILURE;
        }

        $user = User::query()->where('email', $arguments['email'])->first();

        if (! $user) {
            $this->error('No account exists with that email address.');

            return self::FAILURE;
        }

        if ($arguments['action'] === 'grant' && ! $user->hasVerifiedEmail()) {
            $this->error('Verify the account email before granting administrator access.');

            return self::FAILURE;
        }

        $user->forceFill(['is_admin' => $arguments['action'] === 'grant'])->save();
        $this->info($arguments['action'] === 'grant' ? 'Administrator access granted.' : 'Administrator access revoked.');

        return self::SUCCESS;
    }
}
