<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_add_is_approved_to_ratings_table.php

public function up()
{
    Schema::table('ratings', function (Blueprint $table) {
        $table->boolean('is_approved')->default(false)->after('comment');
    });
}

public function down()
{
    Schema::table('ratings', function (Blueprint $table) {
        $table->dropColumn('is_approved');
    });
}

};
