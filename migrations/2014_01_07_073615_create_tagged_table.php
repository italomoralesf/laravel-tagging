<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaggedTable extends Migration {

	public function up() {
		Schema::create('tagged', function(Blueprint $table) {

			$table->increments('id');

			$table->integer('taggable_id')->unsigned()->index();
			$table->string('taggable_type', 125)->index();

			$table->string('tag_name', 125);
			$table->string('tag_slug', 125)->index();

		});
	}

	public function down() {
		Schema::drop('tagged');
	}
}
