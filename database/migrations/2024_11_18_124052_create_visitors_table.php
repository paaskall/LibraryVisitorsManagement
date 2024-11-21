<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('visitors', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('member_id')->nullable();
        $table->string('phone')->nullable();
        $table->string('purpose'); // Tujuan kunjungan
        $table->text('notes')->nullable();
        $table->timestamp('check_in')->useCurrent();
        $table->timestamp('check_out')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
