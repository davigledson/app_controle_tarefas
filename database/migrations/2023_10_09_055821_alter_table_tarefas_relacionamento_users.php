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
        //
        Schema::table('tarefas', function(Blueprint $table){
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // nullable - vai comecar null
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('tarefas',function(Blueprint $table){
            $table->dropForeign('tarefas_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
