<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 */
class CreatePriceWatcherTable extends Migration
{
    protected $table = 'price_watcher';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create($this->table, function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('item_id')->comment('商品id');
            $table->decimal('price', 11, 3)->comment('价格');
            $table->date('price_date')->comment('日期');
            $table->unsignedInteger('created_at')->default(0);
            $table->unsignedInteger('updated_at')->nullable();
            $table->unsignedInteger('deleted_at')->nullable();

            $table->unique(["item_id", "price_date"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
