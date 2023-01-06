<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use PDOException;

class UserController extends Controller
{

    public function index()
    {
        # code...
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
