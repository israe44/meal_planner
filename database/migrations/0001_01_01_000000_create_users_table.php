<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique(); //no two users can have the same email
            $table->timestamp('email_verified_at')->nullable(); //can be empty 
            $table->string('password');
            $table->rememberToken(); //used for remember me checkbox in login form, it generates a token to keep the user logged in
            $table->timestamps(); //created_at and updated_at columns
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

#SOME USEFUL COMMANDS 

# Run all pending migrations
 #php artisan migrate

# Undo last batch
#php artisan migrate:rollback

# Undo ALL migrations and re-run them all
#php artisan migrate:fresh

# Same as fresh but also runs seeders 
#php artisan migrate:fresh --seed

# Check status of all migrations
#php artisan migrate:status