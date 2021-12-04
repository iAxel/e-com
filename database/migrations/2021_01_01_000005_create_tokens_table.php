<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateTokensTable extends Migration
{
    /**
     * @var string
     */
    protected string $table = 'tokens';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('value');

            $table->unsignedBigInteger('user_id');
            $table->ipAddress('user_ip');
            $table->string('user_agent');

            $table->timestamp('used_at')->nullable();
            $table->timestamp('expired_at')->nullable();
        });

        Schema::table($this->table, function (Blueprint $table) {
            $table->unique('value');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
