<?php

use Illuminate\Database\Migrations\Migration;

class RunSql extends Migration {

    function up()
    {
        $fullSchema = file_get_contents(dirname(__FILE__) . '/mysunles_app.sql');
        $queries = array_filter(explode(';', $fullSchema));

        foreach ($queries as $query) {
            $query = trim($query);
            try {
                if (!empty($query)) {
                    DB::statement($query, []);
                }

            } catch (Exception $e) {
                echo $e->getMessage()."\n\r".'ERROR ON QUERY: '.$query;
            }
        }
    }

    function down()
    {
    	Schema::dropIfExists('Users');
    }

}
