<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('families', function (Blueprint $table) {
            $table->unsignedInteger('family_number')->nullable()->after('barangay_id');
            $table->unique(['barangay_id', 'family_number']);
        });

        $barangayIds = DB::table('families')->distinct()->pluck('barangay_id');

        foreach ($barangayIds as $barangayId) {
            $families = DB::table('families')
                ->where('barangay_id', $barangayId)
                ->orderBy('id')
                ->pluck('id');

            $familyNumber = 1;
            foreach ($families as $familyId) {
                DB::table('families')
                    ->where('id', $familyId)
                    ->update(['family_number' => $familyNumber++]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('families', function (Blueprint $table) {
            $table->dropUnique(['families_barangay_id_family_number_unique']);
            $table->dropColumn('family_number');
        });
    }
};
