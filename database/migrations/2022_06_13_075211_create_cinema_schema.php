<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /** ToDo: Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different showrooms

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        //* As a user I want to see which films can be watched and at what times
        //As a user I want to only see the shows which are not booked out
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('movieid');
            $table->string('moviename');
            $table->date('releasedate');
            $table->string('hours');
            $table->string('genre');
            $table->string('ratings');
            $table->timestamps();
        });

        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('eventid'); //this is tied to events that have date,time, location, audience and type
            $table->string('bookingstatus'); //this shows the status of the movie if it has been bookout or not
            $table->timestamps();
            $table->foreignId('eventid')->constrained()->onDelete('cascade');
        });


     //   **Show administration**
    // * As a cinema owner I want to run different films at different times
    // * As a cinema owner I want to run multiple films at the same time in different showrooms

    Schema::create('films', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('filmid');
        $table->string('filmtitle');
        $table->date('releasedate');
        $table->string('hours');
        $table->string('genre');
        $table->string('ratings');
        $table->datetime('viewtime'); //time is set for the film, the same time or different time
        $table->bigInteger('showroomid'); //this links to showroom schems
        $table->timestamps();
        $table->foreignId('showroomid')->constrained()->onDelete('cascade');
    });

  //**Pricing** 
  //* As a cinema owner I want to get paid differently per show
  //* As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat
  
  //NB: Extension of the show schema, in practice they will be one  with the one shown above
  Schema::create('shows', function (Blueprint $table) {
    $table->showid();
    $table->bigInteger('eventid'); //this is tied to events that have date,time, location, audience and type
    $table->string('bookingstatus'); //this shows the status of the movie if it has been bookout or not
    $table->string('price'); //price per show
    $table->bigInteger('seat_type'); //seat type per show
    $table->timestamps();
    $table->foreignId('eventid')->constrained()->onDelete('cascade');
    $table->foreignId('seat_type')->constrained()->onDelete('cascade');
});


    //**Seating**
    //// * As a user I want to book a seat
     //* As a user I want to book a vip seat/couple seat/super vip/whatever
    // * As a user I want to see which seats are still available
   //  * As a user I want to know where I'm sitting on my ticket
   //  * As a cinema owner I dont want to configure the seating for every show
   Schema::create('seats', function (Blueprint $table) {
    $table->id();
    $table->bigInteger('seatid'); //this is tied to events that have date,time, location, audience and type
    $table->bigInteger('seat_type'); //seat type per show
    $table->string('seatstatus'); //this shows the status of the movie if it has been bookout or not
    $table->string('seatposition'); //this shows the status of the movie if it has been bookout or not
    $table->string('seatshowid'); //price per show
    $table->timestamps();
    $table->foreignId('showid')->constrained()->onDelete('cascade');
     
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
