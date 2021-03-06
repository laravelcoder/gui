<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bc7df3c56810RelationshipsToTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function(Blueprint $table) {
            if (!Schema::hasColumn('tasks', 'status_id')) {
                $table->integer('status_id')->unsigned()->nullable();
                $table->foreign('status_id', '218022_5bbfb9470aee1')->references('id')->on('task_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('tasks', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '218022_5bbfb94720853')->references('id')->on('users')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function(Blueprint $table) {
            if(Schema::hasColumn('tasks', 'status_id')) {
                $table->dropForeign('218022_5bbfb9470aee1');
                $table->dropIndex('218022_5bbfb9470aee1');
                $table->dropColumn('status_id');
            }
            if(Schema::hasColumn('tasks', 'user_id')) {
                $table->dropForeign('218022_5bbfb94720853');
                $table->dropIndex('218022_5bbfb94720853');
                $table->dropColumn('user_id');
            }
            
        });
    }
}
