<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('imoveis', function (Blueprint $table) {
            $table->id();
            $table->string('seq')->unique();
            $table->string('setor')->nullable();
            $table->string('quadra')->nullable();
            $table->string('lote')->nullable();
            $table->foreignId('owner_id')->constrained();
            $table->string('latitude', 15)->nullable();
            $table->string('longitude', 15)->nullable();
           
            $table->unsignedInteger('creator_id');
            

            #relacionamento apenas pela ID
            #$table->foreign('owner_id')->references('id')->on('owners')->onDelete('restrict');
            #a linha de baixo já faz o relacionamento com a id da tabela owners 
            #(Por isso é importante as tabelas estarem em ingles)
           
           

            $table->timestamps();

            #$table->foreign('cpf_id')->references('id')->on('owners')->onDelete('restrict');
            #$table->foreign('name_owner_id')->references('id')->on('owners')->onDelete('restrict');
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
        Schema::dropIfExists('imoveis');
    }
};

