<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddColumnImageSvgToAssignCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assign_certificate', function (Blueprint $table) {
            $table->longtext('image_svg')->nullable()->after('date_completion');
            $table->longtext('image_json')->nullable()->after('image_svg');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assign_certificate', function (Blueprint $table) {
            //
        });
    }
}
