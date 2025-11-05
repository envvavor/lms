<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->default(0)->after('description'); 
            // 15 total digit, 2 digit desimal, default 0
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
};
