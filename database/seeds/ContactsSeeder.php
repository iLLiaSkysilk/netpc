<?php

use App\Contact;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $faker = Faker\Factory::create();
    	for ($i = 0; $i < 500; $i++){
		    $contact = new Contact();
		    $contact->setAttribute('name', $faker->firstNameMale);
		    $contact->setAttribute('surname', $faker->lastName);
		    $contact->setAttribute('email', $faker->email);
		    $contact->setAttribute('phone_number', $faker->e164PhoneNumber);
		    $contact->setAttribute('address', $faker->address);
		    $contact->setAttribute('dob', $faker->date);
		    $contact->save();
	    }
    }
}
