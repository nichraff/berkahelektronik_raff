<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            if (!Schema::hasColumn('carts', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id')->index();
            }
        });

        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id')->index();
            }
            if (!Schema::hasColumn('transactions', 'paid_at')) {
                $table->timestamp('paid_at')->nullable();
            }
        });

        // Foreign keys dibuat hanya bila kolom ada dan tabel users tersedia.
        if (Schema::hasTable('users') && Schema::hasColumn('carts', 'user_id')) {
            try {
                Schema::table('carts', function (Blueprint $table) {
                    $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
                });
            } catch (Throwable $e) {
                // Dapat sudah ada pada database yang sebelumnya dimigrasikan.
            }
        }

        if (Schema::hasTable('users') && Schema::hasColumn('transactions', 'user_id')) {
            try {
                Schema::table('transactions', function (Blueprint $table) {
                    $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
                });
            } catch (Throwable $e) {
                // Dapat sudah ada pada database yang sebelumnya dimigrasikan.
            }
        }

        
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            try { $table->dropForeign(['user_id']); } catch (Throwable $e) {}
            if (Schema::hasColumn('carts', 'user_id')) $table->dropColumn('user_id');
        });

        Schema::table('transactions', function (Blueprint $table) {
            try { $table->dropForeign(['user_id']); } catch (Throwable $e) {}
            if (Schema::hasColumn('transactions', 'user_id')) $table->dropColumn('user_id');
            if (Schema::hasColumn('transactions', 'paid_at')) $table->dropColumn('paid_at');
        });
    }
};
