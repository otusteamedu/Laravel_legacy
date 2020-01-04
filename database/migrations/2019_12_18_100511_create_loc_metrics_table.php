<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loc_metrics', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('commit_id');
            $table->unsignedInteger('directories')->default(0)->comment('Directories');
            $table->unsignedInteger('files')->default(0)->comment('Files');
            $table->unsignedInteger('loc')->default(0)->comment('Lines of Code (LOC)');
            $table->unsignedInteger('lloc')->default(0)->comment('Logical Lines of Code (LLOC)');
            $table->unsignedInteger('lloc_classes')->default(0)->comment('Classes Length (LLOC)');
            $table->unsignedInteger('lloc_functions')->default(0)->comment('Functions Length (LLOC)');
            $table->unsignedInteger('lloc_global')->default(0)->comment('LLOC outside functions or classes');
            $table->unsignedInteger('cloc')->default(0)->comment('Comment Lines of Code (CLOC)');
            $table->unsignedInteger('ccn')->default(0)->comment('');
            $table->unsignedInteger('ccn_methods')->default(0)->comment('');
            $table->unsignedInteger('interfaces')->default(0)->comment('Interfaces');
            $table->unsignedInteger('traits')->default(0)->comment('Traits');
            $table->unsignedInteger('classes')->default(0)->comment('Classes');
            $table->unsignedInteger('abstract_classes')->default(0)->comment('Abstract Classes');
            $table->unsignedInteger('concrete_classes')->default(0)->comment('Concrete Classes');
            $table->unsignedInteger('functions')->default(0)->comment('Functions');
            $table->unsignedInteger('named_functions')->default(0)->comment('Named Functions');
            $table->unsignedInteger('anonymous_functions')->default(0)->comment('Anonymous Functions');
            $table->unsignedInteger('methods')->default(0)->comment('Methods');
            $table->unsignedInteger('public_methods')->default(0)->comment('Public Methods');
            $table->unsignedInteger('non_public_methods')->default(0)->comment('Non-Public Methods');
            $table->unsignedInteger('non_static_methods')->default(0)->comment('Non-Static Methods');
            $table->unsignedInteger('static_methods')->default(0)->comment('Static Methods');
            $table->unsignedInteger('constants')->default(0)->comment('Constants');
            $table->unsignedInteger('class_constants')->default(0)->comment('Class Constants');
            $table->unsignedInteger('global_constants')->default(0)->comment('Global Constants');
            $table->unsignedInteger('test_classes')->default(0)->comment('Test Classes');
            $table->unsignedInteger('test_methods')->default(0)->comment('Test Methods');
            $table->float('ccn_by_lloc')->default(0)->comment('Average Complexity per LLOC');
            $table->float('lloc_by_nof')->default(0)->comment('Average Function Length (LLOC)');
            $table->unsignedInteger('method_calls')->default(0)->comment('Method Calls');
            $table->unsignedInteger('static_method_calls')->default(0)->comment('Static Method Calls');
            $table->unsignedInteger('instance_method_calls')->default(0)->comment('Non-Static Method Calls');
            $table->unsignedInteger('attribute_accesses')->default(0)->comment('Attribute Accesses');
            $table->unsignedInteger('static_attribute_accesses')->default(0)->comment('Static Attribute Accesses');
            $table->unsignedInteger('instance_attribute_accesses')->default(0)->comment('Non-Static Attribute Accesses');
            $table->unsignedInteger('global_accesses')->default(0)->comment('Global Accesses');
            $table->unsignedInteger('global_variable_accesses')->default(0)->comment('Global Variable Accesses');
            $table->unsignedInteger('super_global_variable_accesses')->default(0)->comment('Super-Global Variable Accesses');
            $table->unsignedInteger('global_constant_accesses')->default(0)->comment('Global Constant Accesses');
            $table->unsignedInteger('class_ccn_min')->default(0)->comment('Minimum Class Complexity');
            $table->float('class_ccn_avg')->default(0)->comment('Average Complexity per Class');
            $table->unsignedInteger('class_ccn_max')->default(0)->comment('Maximum Class Complexity');
            $table->unsignedInteger('class_lloc_min')->default(0)->comment('Minimum Class Length');
            $table->float('class_lloc_avg')->default(0)->comment('Average Class Length');
            $table->unsignedInteger('class_lloc_max')->default(0)->comment('Maximum Class Length');
            $table->unsignedInteger('method_ccn_min')->default(0)->comment('Minimum Method Complexity');
            $table->float('method_ccn_avg')->default(0)->comment('Average Complexity per Method');
            $table->unsignedInteger('method_ccn_max')->default(0)->comment('Maximum Method Complexity');
            $table->unsignedInteger('method_lloc_min')->default(0)->comment('Minimum Method Length');
            $table->float('method_lloc_avg')->default(0)->comment('Average Method Length');
            $table->unsignedInteger('method_lloc_max')->default(0)->comment('Maximum Method Length');
            $table->unsignedInteger('namespaces')->default(0)->comment('Namespaces');
            $table->unsignedInteger('ncloc')->default(0)->comment('Non-Comment Lines of Code (NCLOC)');
            $table->timestamps();

            $table->foreign('commit_id')
                ->on('commits')
                ->references('id')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loc_metrics');
    }
}
