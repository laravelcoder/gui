<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bc7df3c01a70RelationshipsToBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function(Blueprint $table) {
            if (!Schema::hasColumn('brands', 'clip_id')) {
                $table->integer('clip_id')->unsigned()->nullable();
                $table->foreign('clip_id', '219969_5bc7a94a07722')->references('id')->on('clips')->onDelete('cascade');
                }
                if (!Schema::hasColumn('brands', 'industry_id')) {
                $table->integer('industry_id')->unsigned()->nullable();
                $table->foreign('industry_id', '219969_5bc7a94a17249')->references('id')->on('industries')->onDelete('cascade');
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
        Schema::table('brands', function(Blueprint $table) {
            if(Schema::hasColumn('brands', 'clip_id')) {
                $table->dropForeign('219969_5bc7a94a07722');
                $table->dropIndex('219969_5bc7a94a07722');
                $table->dropColumn('clip_id');
            }
            if(Schema::hasColumn('brands', 'industry_id')) {
                $table->dropForeign('219969_5bc7a94a17249');
                $table->dropIndex('219969_5bc7a94a17249');
                $table->dropColumn('industry_id');
            }
            
        });
    }
}
