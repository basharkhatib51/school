<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

/**
 * @method foreignId(string $string)
 * @method timestamps()
 * @method timestamp(string $string)
 */
class AudiTableServiceProvider extends ServiceProvider
{
    public function register()
    {
        Blueprint::macro('audiTable', function () {

            $this->foreignId('created_by')->nullable()->constrained('users');
            $this->foreignId('updated_by')->nullable()->constrained('users');
            $this->foreignId('deleted_by')->nullable()->constrained('users');
            $this->timestamps();
            $this->timestamp('deleted_at')->nullable();
        });


    }
}
