<?php

namespace App\Models;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReinsialiseBase extends Seeder {
public $timestamps=false;

   public function resetBase() {
    $sql = "
        DO $$ 
        DECLARE
            table_record RECORD;
        BEGIN
            FOR table_record IN
                SELECT table_name 
                FROM information_schema.tables 
                WHERE table_schema = 'public' 
                AND table_type = 'BASE TABLE'
                AND table_name NOT IN ('matiere','semestre','semestre_matiere','users')  
            LOOP
                EXECUTE format('TRUNCATE TABLE %I RESTART IDENTITY CASCADE', table_record.table_name);
            END LOOP;
        END $$;
    ";
    DB::statement($sql);
    
    return redirect()->route('home')->with('success', 'Suppression avec succès.');
}
}