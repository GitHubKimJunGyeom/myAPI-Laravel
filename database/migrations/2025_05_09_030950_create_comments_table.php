<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // 로그인 사용자 (nullable 허용 X)
            $table->foreignId('user_id')->nullable();

            // 익명 사용자용
            $table->string('nickname')->nullable();
            $table->string('password_hash')->nullable();

            // 댓글 내용
            $table->text('content');

            // 페이지 ID (노션 기준)
            $table->string('page_id');

            // 대댓글 (자기 참조, 외래키)
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('comments');

            // 소프트 삭제 및 타임스탬프
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
