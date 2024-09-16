<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\TryCatch;

class Import extends Model
{
    use HasFactory;

    public function importDonne($configuration): array
    {
        $dataconfiguration=Excel::toArray(new \App\Imports\Import(),storage_path($configuration))[0];


        $message = [];
        $i = 0;
        foreach ($dataconfiguration as $d) {
            try {
                $validation = Validator::make([
                    'code'=>$d['code'],
                    'config' => $d['config'],
                    'valeur' => $d['valeur']

                ], [
                    'code'=>['required'],
                    'config' => ['required'],
                    'valeur' => ['required']
                ]);

                $validation->validated();
                $comm = str_replace(',', '.',$d['valeur']);
                $comm = str_replace('%', '',$comm);
                DB::table('configuration')->insert([
                    'code'=>$d['code'],
                    'config' => $d['config'],
                    'valeur' => $d['valeur']
                ]);
            } catch (\Exception $e) {
                $message[] = $e->getMessage() . ' || ligne : ' . $i;
            }
        }    

    return $message;
}



public function importNote($note): array{   
    $note = Excel::toArray(new \App\Imports\Import(),storage_path($note))[0];
    $message = [];
    $i = 0;
    foreach ($note as $data) {
        try {
            $validation = Validator::make([
                'numetu' => $data['numetu'],
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'genre' => $data['numetu'],
                'datenaissance' => $data['datenaissance'],
                'promotion' => $data['promotion'],
                'codematiere' => $data['codematiere'],
                'semestre' => $data['semestre'],
                'note' => $data['note'],
            ], [
                'numetu' => ['required'],
                'nom' => ['required'],
                'prenom' => ['required'],
                'genre' => ['required'],
                'datenaissance' => ['required'],
                'promotion' => ['required'],
                'codematiere' => ['required'],
                'semestre' => ['required'],
                'note' => ['required'],
            ]);


            $validation->validated();

            $note = str_replace(',', '.',$data['note']);

            DB::table('note_csv')->insert([
                'numetu' => $data['numetu'],
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'genre' => $data['numetu'],
                'datenaissance' => $data['datenaissance'],
                'promotion' => $data['promotion'],
                'codematiere' => $data['codematiere'],
                'semestre' => $data['semestre'],
                'note' => $note,
            ]);
        

        } catch (\Exception $e) {
            $message[] = $e->getMessage() . ' || ligne : ' . $i;
        }
    }


    // insertion promotion
  try{
      DB::insert('insert into promotion(promotion )  
          select distinct 
          promotion 
              from note_csv 
           
      ');
     }catch (\Exception $e) {
        $message[] = $e->getMessage();
    }
       
    
    ///insertion etudiant 
    try {
        DB::insert('insert into etudiant(id_etudiant,promo_id,nom,prenom,date_naissance) 
            SELECT DISTINCT on(numetu)
                    nc.numetu,
                    p.id_prom , 
                    nc.nom,
                    nc.prenom,
                    nc.datenaissance
                FROM note_csv nc
                   JOIN promotion p on p.promotion=nc.promotion  
        ');
    }catch (\Exception $e) {
        $message[] = $e->getMessage();
    }
  
    //insertion matiere etudiant 
    try {
        DB::insert('insert into semestre_etud(id_sem,etudiant_id)
            SELECT   DISTINCT
                  se.id_semestre ,
                  et.id_etudiant
                FROM note_csv  cs 
                  join semestre se on se.semestre=cs.semestre
                  join etudiant et on et.id_etudiant=cs.numetu ;
        ');
    }catch (\Exception $e) {
        $message[] = $e->getMessage();
    }
   
    try{
        DB::statement ('
        insert into note(id_etu,matiere_id,resultat) 
           SELECT   distinct
                 et.id_etudiant,
                m.id_matiere,
                cv.note
            FROM note_csv cv
               join etudiant et on et.id_etudiant=cv.numetu
               JOIN matiere m ON TRIM(m.code_matiere)=TRIM(cv.codematiere)
        ');
    }catch (\Exception $e) {
    $message[] = $e->getMessage();

}
    
DB::commit();
return $message;
}

}