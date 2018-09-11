<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = array(
            "In Search of Lost Time"=> array("Marcel Proust",1913,1),
            "Don Quixote"=> array("Miguel de Cervantes",2005,6),
            "Ulysses"=> array("James Joyce",2013,4),
            "The Great Gatsby"=> array("F. Scott Fitzgerald",2004,1),
            "Moby Dick"=> array("Herman Melville",1999,1),
            "Hamlet "=> array("William Shakespeare",2003,3),
            "Hamlet "=> array("William Shakespeare",1997,5),
            "War and Peace"=> array("Leo Tolstoy",1913,1),
            "The Odyssey"=> array("Homer",1998,2)
        );
        foreach ($books as $key => $val) {
            DB::table('books')->insert([
                'name' => $key,
                'author' => $val[0],
                'publishing_year' => $val[1],
                'quantity' => $val[2]
            ]);
        }
    }
}
