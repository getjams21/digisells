<?php

class SubcategoryTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		Subcategory::create([
			'categoryID' => 1,
			'name' => 'Android',
			'description' => 'Android'
		]);
		Subcategory::create([
			'categoryID' => 1,
			'name' => 'IOS',
			'description' => 'IOS'
		]);
		Subcategory::create([
			'categoryID' => 1,
			'name' => 'Business Management Systems',
			'description' => 'Business Management Systems'
		]);
		Subcategory::create([
			'categoryID' => 1,
			'name' => 'Database',
			'description' => 'Database'
		]);
		Subcategory::create([
			'categoryID' => 1,
			'name' => 'Codes/Scripts',
			'description' => 'Codes/Scripts'
		]);
		Subcategory::create([
			'categoryID' => 1,
			'name' => 'Others',
			'description' => 'Others'
		]);
		// Arts/graphics seed
		Subcategory::create([
			'categoryID' => 2,
			'name' => 'Graphic Design',
			'description' => 'Graphic Design'
		]);
		Subcategory::create([
			'categoryID' => 2,
			'name' => 'Portraits',
			'description' => 'Portraits'
		]);
		Subcategory::create([
			'categoryID' => 2,
			'name' => 'Photographs',
			'description' => 'Photographs'
		]);
		Subcategory::create([
			'categoryID' => 2,
			'name' => 'Compositions',
			'description' => 'Compositions'
		]);
		Subcategory::create([
			'categoryID' => 2,
			'name' => 'Paintings',
			'description' => 'Paintings'
		]);
		Subcategory::create([
			'categoryID' => 2,
			'name' => '3D Modeling/Design',
			'description' => '3D Modeling/Design'
		]);
		Subcategory::create([
			'categoryID' => 2,
			'name' => 'Others',
			'description' => 'Others'
		]);
		// Business/Marketing
		Subcategory::create([
			'categoryID' => 3,
			'name' => 'Courses/Tutorials',
			'description' => 'Courses/Tutorials'
		]);
		Subcategory::create([
			'categoryID' => 3,
			'name' => 'Business Concepts',
			'description' => 'Business Concepts'
		]);
		Subcategory::create([
			'categoryID' => 3,
			'name' => 'Internet Marketing',
			'description' => 'Internet Marketing'
		]);
		Subcategory::create([
			'categoryID' => 3,
			'name' => 'WSO',
			'description' => 'WSO'
		]);
		Subcategory::create([
			'categoryID' => 3,
			'name' => 'Others',
			'description' => 'Others'
		]);
		// Domains / Websites
		Subcategory::create([
			'categoryID' => 4,
			'name' => 'Expired Domains',
			'description' => 'Expired Domains'
		]);
		Subcategory::create([
			'categoryID' => 4,
			'name' => 'Live Domains',
			'description' => 'Live Domains'
		]);
		Subcategory::create([
			'categoryID' => 4,
			'name' => 'Websites',
			'description' => 'Websites'
		]);
		Subcategory::create([
			'categoryID' => 4,
			'name' => 'Themes/Templates',
			'description' => 'Themes/Templates'
		]);
		Subcategory::create([
			'categoryID' => 4,
			'name' => 'Plugins',
			'description' => 'Plugins'
		]);
		Subcategory::create([
			'categoryID' => 4,
			'name' => 'Others',
			'description' => 'Others'
		]);
		//Entertainment
		Subcategory::create([
			'categoryID' => 5,
			'name' => 'Music',
			'description' => 'Music'
		]);
		Subcategory::create([
			'categoryID' => 5,
			'name' => 'Videos',
			'description' => 'Videos'
		]);
		Subcategory::create([
			'categoryID' => 5,
			'name' => 'Games',
			'description' => 'Games'
		]);
		Subcategory::create([
			'categoryID' => 5,
			'name' => 'Others',
			'description' => 'Others'
		]);
			
		
		// $this->call('UserTableSeeder');
	}

}
