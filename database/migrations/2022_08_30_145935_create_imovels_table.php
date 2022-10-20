<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('imovels', function (Blueprint $table) {
            $table->id();
            $table->string('seq')->unique();
            $table->string('setor')->nullable();
            $table->string('quadra')->nullable();
            $table->string('lote')->nullable();
            $table->unsignedInteger('cpf_id');
          
            $table->unsignedInteger('name_owner_id');
            
            $table->string('latitude', 15)->nullable();
            $table->string('longitude', 15)->nullable();
            $table->unsignedInteger('creator_id');
           
           

            $table->timestamps();

            $table->foreign('cpf_id')->references('id')->on('owners')->onDelete('restrict');
            $table->foreign('name_owner_id')->references('id')->on('owners')->onDelete('restrict');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('restrict');
          

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imovels');
    }
};

