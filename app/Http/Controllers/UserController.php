<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;

class UserController extends Controller
{

    public function index()
    {
        // There is 3 types of quering DB
        // raw sql queries on DB facade
        // Queries Builder
        // Elequent ORM

        /**
         * There is 3 types of quering DB :
         * 1- raw sql queries on DB facade (for simple application)
         * 2- Queries Builder (for big project - powerful method)
         * 3- Elequent ORM (for big project - powerful method)
         * Also we can use PDO library
         */


        // PDO
        // dump('PDO:');

        // $pdo = DB::connection('sqlite')->getPdo();
        // $users = $pdo->query('select * from users')->fetchAll();
        //  dump($users);


        // Raw sql queries on DB facade
        dump('Raw sql queries on DB facade:');

        // $users = DB::select('select * from users where id = ? or name = ?', [1, "Ali's Missaoui"]); // First type of binding
        // $users = DB::select('select * from users where id = :id or name = :user_name', ['id' => 1, 'user_name' => "Ali's Missaoui"]); // Second type of binding
        $users = Db::select('select * from users');
        // dump($users);

        //  DB::delete('delete from users where id = ? ', [3]);
        //  DB::statement('truncate table users');


        // Queries Builder
        dump('Queries Builder:');

        $users = DB::table('users')->select()->get();
        // dump($users);

        // Elequent ORM
        dump('Elequent ORM:');

        $users = User::all();
        // dump($users);








        /*
        $users = DB::select('select * from users ');
        // dump('mysql:' , $users);

        $users = DB::connection('sqlite')->select('select * from users ');
        // dump('sqlite:' , $users);
        */
    }



    /**
     *  Transactions are used
     *  whene we make operation
     *  on more than one table/column in the DB.
     *  It prevents from data inconsistency
     *
     *  The most basic usage of this is financial transaction when the
     *  2 tables need to be updated equals
     *
     */
    public function db_transactions()
    {

        dump('transaction');

        /**
         * Transaction method will rollBack automatically DB if one of his queries
         * has a problem or an error
         */
        DB::transaction(function () {

            /**
             *  It's safer to make additional checking with try catch for example.
             *  If we catch an issue should throw an exception
             *  and rollBack the DB.
             */
            try {

                DB::table('users')
                ->delete();

                $result = DB::table('users')
                ->where('id', 11)
                ->update([
                    'name' => 'hoalala 2'
                ]);

                /**
                 *  Invoke an exception So should execute catch bloc
                 *  That means rollBack DB.
                 */
                if (!$result) {
                    throw new Exception('Error Updating user name.');
                }

            } catch (Exception $e) {
                dump($e->getMessage());
                // rollBack manually
                DB::rollBack();
            }

        }, 5); // optional second argument, how many times a transaction should be reattempted

    }


    public function create_db($name)
    {
        try {

            $dbc = new PDO('mysql:host='. env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'));

            $charset = config('database.connections.mysql.charset');
            $collation = config('database.connections.mysql.collation');

            $query = "CREATE DATABASE IF NOT EXISTS $name CHARACTER SET $charset COLLATE $collation;";

            $dbc->exec($query);

        } catch (PDOException $ex) {

            echo $ex->getMessage();
        }
    }
}
