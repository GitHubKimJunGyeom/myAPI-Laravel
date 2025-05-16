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

            // user_id (외래키)
            // 익명 사용자는 null
            // 익명 사용자는 user_id가 null이므로, 외래키 제약조건을 nullable로 설정
            $table->foreignUuid('user_id')->nullable();

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
            $table->timestamps();
            $table->softDeletes();
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
