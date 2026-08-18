Schema::create('pickup_slots', function (Blueprint $table) {
    $table->id();

    $table->date('date');

    $table->time('start_time');

    $table->time('end_time');

    $table->unsignedInteger('max_orders')->default(10);

    $table->boolean('active')->default(true);

    $table->timestamps();

    $table->unique([
        'date',
        'start_time',
        'end_time',
    ]);
});