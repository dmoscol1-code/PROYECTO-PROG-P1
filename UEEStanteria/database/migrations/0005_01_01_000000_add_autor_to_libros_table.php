<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('libros', function (Blueprint $table) {
            if (!Schema::hasColumn('libros', 'autor')) {
                $table->string('autor')->nullable()->after('titulo');
            }
        });
    }

    public function down()
    {
        Schema::table('libros', function (Blueprint $table) {
            if (Schema::hasColumn('libros', 'autor')) {
                $table->dropColumn('autor');
            }
        });
    }
};
