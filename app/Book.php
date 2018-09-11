<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = 'book_id';
    public function users()
    {

        return $this->belongsToMany('App\User' ,'orders','book_id','username');
    }
    public function addBook($arr){
        try {
        DB::table('books')->insert([
            'name'              =>$arr['name'],
            'author'            =>$arr['author'],
            'publishing_year'   =>$arr['publishingyear'],
            'quantity'          =>$arr['quantity']
        ]);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
    public function deleteBook($book_id){
        try {
            DB::table('books')->where('book_id', $book_id)->delete();
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

}
