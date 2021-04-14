<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            "title" => "Matter heart run",
            "description" => "The Mater Cardiac Program began 20 years ago, when The Mater Hospital realized that very little cardiac work of good quality was being carried out in the country. Patients who were financially endowed had to go overseas for treatment. Large majority, many of them children, had no recourse to quality Medicare and were destined to a sickly life and premature death.",
            "start_time" => "2021-07-22T08:00",
            "end_time" => "2021-07-22T17:00",
            "image" => "images/matter.jpg",
            "address" => "Matter Hospital",
            "city" => "Nairobi",
            "user_id" => 1
        ]);
        Event::create([
            "title" => "Nairobi half marathon",
            "description" => "The Standard Chartered Bank, with the support of event organizers, Athletics Kenya, have built an event that has become internationally renowned and has placed Kenya on the international map. The Marathon is the flagship project for our ‘Futuremakers’ initiative; a new global campaign by Standard Chartered Bank to open opportunities for the next generation to learn, earn and grow.",
            "start_time" => "2021-10-10T08:00",
            "end_time" => "2021-10-10T17:00",
            "image" => "images/nairobi.jpeg",
            "address" => "Standard Chartered",
            "city" => "Nairobi",
            "user_id" => 2
        ]);
        Event::create([
            "title" => "Kabarak university marathon",
            "description" => "The Half marathon seeks to increase student sponsorship with a focus  on needy students enrolled for various courses offered in Kabarak University.",
            "start_time" => "2021-06-01T08:00",
            "end_time" => "2021-06-01T17:00",
            "image" => "images/nairobi.jpg",
            "address" => "Eldoret university",
            "city" => "Eldoret",
            "user_id" => 3
        ]);
        Event::create([
            "title" => "Eldoret city",
            "description" => "Eldoret City Marathon was founded in 2018 as a platform for launching the careers of young and unknown long-distance running talents while simultaneously promoting the conservation of the environment. Kenya is blessed with so many talented long distance runners that many potentially world-beating marathoners lack global opportunities due to being in the shadows of the more prominent world record holders, Olympians, world championship competitors, and those under the management of well-connected agents and/or managers.",
            "start_time" => "2021-06-03T08:00",
            "end_time" => "2021-06-03T17:00",
            "image" => "images/eldoret.jpeg",
            "address" => "Eldoret University",
            "city" => "Eldoret University",
            "user_id" => 3
        ]);
        Event::create([
            "title" => "Ndakaini half marathon",
            "description" => "Run for Water, Run for Life acted as a clarion call for thousands of athletes who turned up at Ndakaini on 12th September 2015 for the 12th edition of Ndakaini Half Marathon. Well, some of the participants were not athletes but their love for nature drove them to support the call to conserve the Ndakaini Dam, a major source of water for Nairobi County.",
            "start_time" => "2021-04-03T08:00",
            "end_time" => "2021-04-03T17:00",
            "image" => "images/ndakaini.jpeg",
            "address" => "Ndakaini",
            "city" => "Murang'a",
            "user_id" => 1
        ]);
        Event::create([
            "title" => "Amazing Maasai Marathon",
            "description" => "In 2011, the Amazing Maasai ULTRA kicked off its inaugural event with about 100 local Maasai and 18 runners from abroad, mostly our friends we begged to come",
            "start_time" => "2021-08-14T08:00",
            "end_time" => "2021-08-14T17:00",
            "image" => "images/maasai.jpg",
            "address" => "Narok",
            "city" => "Narok",
            "user_id" => 3
        ]);
    }
}
