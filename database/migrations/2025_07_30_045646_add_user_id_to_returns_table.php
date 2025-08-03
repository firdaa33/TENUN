<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::table('returns', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->after('order_id');
    });
}

public function down()
{
    Schema::table('returns', function (Blueprint $table) {
        $table->dropColumn('user_id');
    });
}
};
