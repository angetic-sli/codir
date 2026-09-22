<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('taches', function (Blueprint $table) {
            $table->unsignedInteger('ordre')->default(0)->after('activite_id');
            $table->index(['reunion_id', 'ordre']);
        });

        $reunionIds = DB::table('taches')->distinct()->pluck('reunion_id');
        foreach ($reunionIds as $reunionId) {
            $taches = DB::table('taches')
                ->where('reunion_id', $reunionId)
                ->orderBy('id')
                ->pluck('id');

            foreach ($taches as $position => $tacheId) {
                DB::table('taches')
                    ->where('id', $tacheId)
                    ->update(['ordre' => $position + 1]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('taches', function (Blueprint $table) {
            $table->dropIndex(['reunion_id', 'ordre']);
            $table->dropColumn('ordre');
        });
    }
};
