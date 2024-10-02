<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id(); // Crée une colonne id auto-incrémentée
            $table->string('name'); // Colonne pour le nom de l'équipement
            $table->string('type'); // Colonne pour le type d'équipement
            $table->date('purchase_date'); // Colonne pour la date d'achat
            $table->string('image_path')->nullable(); // Colonne pour le chemin de l'image
            $table->timestamps(); // Colonne pour les timestamps created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipment'); // Supprime la table si la migration est annulée
    }
}
