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
        Schema::create('user_conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_id');
            $table->unsignedBigInteger('to_id');
            $table->text('message')->nullable();
            $table->enum('type', ['text', 'media'])->default('text');
            $table->enum('read_status', ['read', 'unread'])->default('unread');
            $table->enum('status', ['active', 'inactive', 'deleted']);
            $table->enum('chat_type', ['video-call', 'text-chat']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_conversations');
    }
};
