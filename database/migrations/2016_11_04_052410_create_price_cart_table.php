<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 */
class CreatePriceCartTable extends Migration
{
    protected $table = 'price_cart';
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
            $table->string('name')->comment('商品名称');
            $table->string('raw_url')->comment('商品原始地址');
            $table->string('watch_url')->comment('查询地址');
            $table->text("desc")->nullable();

            $table->timestamps();
            $table->unique('raw_url');
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
