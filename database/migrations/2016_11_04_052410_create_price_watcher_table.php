<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

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

            $table->timestamps();
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
