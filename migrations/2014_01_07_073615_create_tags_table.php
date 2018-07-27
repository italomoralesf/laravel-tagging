<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration {

	public function up()
	{
		Schema::create('tags', function(Blueprint $table) {
			$table->increments('id');
			
			$table->string('slug', 125)->index();
			$table->string('name', 125);
			
			$table->integer('count')->unsigned()->default(0); // count of how many times this tag was used
		});
	}

	public function down()
	{
		Schema::drop('tags');
	}
}
