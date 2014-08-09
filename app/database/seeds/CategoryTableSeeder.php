<?php

class CategoryTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		Category::create([
			'categoryName' => 'Apps/Softwares',
			'description' => 'Applications or Softwares'
			]);
		Category::create([
			'categoryName' => 'Arts/Graphics',
			'description' => 'Arts or Graphics'
			]);
		Category::create([
			'categoryName' => 'Business/Marketing',
			'description' => 'Business or Marketing'
			]);
		Category::create([
			'categoryName' => 'Domains/Websites',
			'description' => 'Domains or Websites'
			]);
		Category::create([
			'categoryName' => 'Media/Entertainment',
			'description' => 'Media or Entertainment'
			]);
		// $this->call('UserTableSeeder');
	}

}
