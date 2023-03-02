<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnReturnsHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('returns_header', function($table){
            $table->string('device_issue')->nullable()->after('summary_of_concern');
            $table->string('repair_technician')->nullable()->after('repair_strategy');
            $table->string('technician_mc_in')->nullable()->after('warranty_status');
            $table->string('frontliner _mc_in')->nullable()->after('technician_mc_in');
            $table->string('other_problem_details')->nullable()->after('other_diagnostic');
            $table->string('other_problem_details_other')->nullable()->after('other_problem_details');
            $table->string('quotation')->nullable()->after('warranty_expiration_date');
            $table->string('wur_sur')->nullable()->after('technician_mc_in');
            $table->string('gsx_no')->nullable()->after('gsx_status');
            $table->string('requote')->nullable()->after('gsx_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::table('returns_header', function($table){
            $table->dropColumn('device_issue');
            $table->dropColumn('repair_technician');
            $table->dropColumn('technician_mc_in');
            $table->dropColumn('frontliner_mc_in');
            $table->dropColumn('other_problem_details');
            $table->dropColumn('other_problem_details_other');
            $table->dropCoulmn('quotation');
            $table->dropColumn('wur_sur');
            $table->dropColumn('gsx_no');
            $table->dropColumn('requote');
        });
    }
}
