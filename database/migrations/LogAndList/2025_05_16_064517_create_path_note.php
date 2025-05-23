<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'logandlist';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('path_notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content_ko');
            $table->text('content_ja');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('path_notes');
    }
};
