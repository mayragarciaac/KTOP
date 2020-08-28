<?php
use Illuminate\Database\Seeder;
use App\category_list;
use App\categories;

class categoriesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('category_lists')->delete();
        category_list::create(array(
            'name'     => 'Telefónos Móviles'
        ));
        category_list::create(array(
            'name'     => 'Televisores'
        ));
        category_list::create(array(
            'name'     => 'Ordenadores'
        ));
        category_list::create(array(
            'name'     => 'Gafas de Sol'
        ));
        category_list::create(array(
            'name'     => 'Mochilas'
        ));

        $category_list = category_list::all();
        if (count($category_list) > 0){
            //type categories 1=> text, 2=> boolean, create table for this
            DB::table('categories')->delete();
            foreach($category_list as $category){
                if(strpos((string) $category['name'],'viles')){
                    categories::create(array(
                        'name'     => 'operatingSystem ',
                        'father'     => $category['id'],
                        'type'      => 1,
                        'level'     => 0
                    ));
                    categories::create(array(
                        'name'     => 'memory ',
                        'father'     => $category['id'],
                        'type'      => 1,
                        'level'     => 10
                    ));
                    categories::create(array(
                        'name'     => 'battery ',
                        'father'     => $category['id'],
                        'type'      => 1,
                        'level'     => 0
                    ));
                    categories::create(array(
                        'name'     => 'GPS ',
                        'father'     => $category['id'],
                        'type'      => 2,
                        'level'     => 10
                    ));
                    categories::create(array(
                        'name'     => '5Gready ',
                        'father'     => $category['id'],
                        'type'      => 2,
                        'level'     => 0
                    ));
                }
                else{
                    categories::create(array(
                        'name'     => 'cat para '.$category['name'],
                        'father'     => $category['id'],
                        'type'      => 1,
                        'level'     => 0
                    ));
                    categories::create(array(
                        'name'     => 'cat2 para '.$category['name'],
                        'father'     => $category['id'],
                        'type'      => 1,
                        'level'     => 10
                    ));
                }
                
            }
        }
        

    }

}

