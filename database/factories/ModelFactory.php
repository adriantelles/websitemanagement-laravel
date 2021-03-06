<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    static $is_verified;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'is_verified' => $is_verified ?: $is_verified = true,
    ];
});

$factory->define(App\Ticket::class, function (Faker\Generator $faker) {
    static $user_id;
    static $message;

    return [
        'title' => $faker->sentence(),
        'user_id' => $user_id ?: $user_id = factory(App\User::class)->create()->id,
        'message' => $message ?: $message = $faker->paragraph()
    ];
});

$factory->define(App\TicketMessage::class, function (Faker\Generator $faker) {
    static $ticket_id;
    static $user_id;
    static $message;

    return [
        'ticket_id' => $ticket_id ?: $ticket_id = 0,
        'user_id' => $user_id ?: $user_id = 0,
        'message' => $message ?: $message = $faker->paragraph()
    ];
});

$factory->define(App\TicketFile::class, function (Faker\Generator $faker) {
    static $name;
    static $user_id;
    static $ticket_id;
    static $ticket_message_id;

    return [
        'name' => $name ?: '',
        'path' => 'somefakefile.jpg',
        'url' => 'somefakefile.jpg',
        'user_id' => $user_id ?: $user_id = 0,
        'ticket_id' => $ticket_id ?: $ticket_id = 0,
        'ticket_message_id' => $ticket_message_id ?: $ticket_message_id = 0,
        'token' => str_random(40)
    ];
});

$factory->define(App\Invoice::class, function (Faker\Generator $faker) {
    static $client_id;

    return [
        'client_id' => $client_id ?: $client_id = factory(App\InvoiceClient::class)->create()->id,
        'date_issued' => $faker->date('d/m/Y'),
        'note' => $faker->sentence(),
        'days_until_due' => 30,
    ];
});

$factory->define(App\InvoiceItem::class, function (Faker\Generator $faker) {
    static $invoice_id;

    $quantity = $faker->numberBetween(1, 10);
    $cost = $faker->randomFloat(2, 1, 50);

    return [
        'description' => $faker->sentence(),
        'quantity' => $quantity,
        'cost' => $cost
    ];
});

$factory->define(App\InvoicePayment::class, function (Faker\Generator $faker) {
    static $user;

    return [
        'date_paid' => $faker->date,
        'amount_paid' => $faker->randomFloat(2, 1, 50),
        'note' => $faker->sentence()
    ];
});

$factory->define(App\InvoiceClient::class, function (Faker\Generator $faker) {
    static $user;

    return [
        'user_id' => $user ?: $user = factory(App\User::class)->create()->id,
        'name' => $faker->company,
        'email' => $faker->email,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'country' => $faker->country,
        'postcode' => $faker->postcode,
    ];
});

$factory->define(App\RemoteServer::class, function (Faker\Generator $faker) {
    static $active;

    return [
        'uid' => $faker->numberBetween(1, 1000),
        'domain' => $faker->domainName,
        'username' => $faker->userName,
        'plan-name' => 'some_plan',
        'max-emails' => $faker->numberBetween(1, 10),
        'disk-used' => $faker->numberBetween(1, 1000),
        'disk-limit' => 1000,
        'active' => $active ?: $active = 1
    ];
});