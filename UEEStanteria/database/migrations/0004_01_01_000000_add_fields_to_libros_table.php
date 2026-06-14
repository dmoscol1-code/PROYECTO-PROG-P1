<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('libros', function (Blueprint $table) {
            $table->string('autor')->nullable()->after('titulo');
            $table->string('editorial')->nullable()->after('autor');
            $table->string('categoria')->nullable()->after('editorial');
            $table->integer('anio_publicacion')->nullable()->after('categoria');
            $table->string('isbn')->nullable()->after('anio_publicacion');
            $table->integer('paginas')->nullable()->after('isbn');
            $table->string('idioma')->nullable()->after('paginas');
            $table->integer('inventario')->default(0)->after('idioma');
            $table->decimal('precio', 10, 2)->nullable()->after('inventario');
            $table->string('edicion')->nullable()->after('precio');
        });
    }

    public function down()
    {
        Schema::table('libros', function (Blueprint $table) {
            $table->dropColumn([
                'autor',
                'editorial',
                'categoria',
                'anio_publicacion',
                'isbn',
                'paginas',
                'idioma',
                'inventario',
                'precio',
                'edicion',
            ]);
        });
    }
};
