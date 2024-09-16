<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Note;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
  public function bord(){
    $etudiant= new Etudiant();
    $admis = $etudiant->nb_admis();
    $count=count(Etudiant::all());
     
    
    return view('admin.bord',[
        'count'=>$count,
        'admis' => $admis['admis'],
        'non_admis' => $admis['non_admis']
    
    ]);
    
  }

  public function liste_admis(){
    $etudiant= new Etudiant();
    $admis = $etudiant->liste();
     
    
    // return view('admin.liste_etudiant',[
    //     'admis' => $admis['admis']
    
    // ]);
}
    public function index(){
        $etudiants = DB::table('etudiant')
        ->join('promotion', 'etudiant.promo_id', '=', 'promotion.id_prom')
        ->select('etudiant.*', 'promotion.promotion')
        ->get();
        
      $etuId=DB::table('etudiant')->first();
      
      if ($etuId) {
        $id_etudiant = $etuId->id_etudiant;
    } else {
        $id_etudiant = null; 
        
    }
    ;
        return view('admin.acceil',[
            'etudiants' => $etudiants,
            'id_etudiant'=>$id_etudiant
        ]);
    }

    public function ajouterEtu(Request $request){
        $request->validate([
            'promotion'=>'required',
            'anarana'=>'required',
            'fanampiny'=>'required',
            'semestre'=>'required',
            'teraka'=>'required',
        ]);
        $promotion=DB::table('promotion')->where('id_promotion',$request->promotion)->first();
        if(!$promotion){
            $promId=DB::table('promotion')->insertGetId([
                'id_promo'=>$request->promotion,
            ]);
        }else{
            $promId=$promotion->id_prom;
        }
        dd($promotion);
        Etudiant::insert([
            'id_promo'=>$promId,
            'nom'=>$request->anarana,
            'prenom'=>$request->fanampiny,
            'semestre'=>$request->semestre,
            'date_naissance'=>$request->teraka,
        ]);
        return view('admin.acceil')->with('mety');
        
    }

                    // public function matiere(){
                    //     return view('admin.matiere');
                    // }
                        
                    // public function ajouterMatier(Request $request){
                    //     $request->validate([
                    //         'semestre'=>'required',
                    //         'nom_matiere'=>'required',
                    //         'code_matiere'=>'required',
                    //         'credit'=>'required',
                    //         'optionel'=>'required',
                    //         'groupe'=>'required',
                    //     ]);

                    // $semetre=DB::table('semestre')->where('id_semestre',$request->semestre);
                    // if(!$semetre){
                    //     $semId=DB::table('semestre')->insertGetId([
                    //         'id_semestre'=>$request->semestre
                    //     ]);
                    // }else{
                    //     $semId=$semetre->id_semestre;
                    // }
                    
                    // Matiere::insert([
                    //     'id_semestre'=>$semId,
                    //     'nom_matiere'=>$request->nom_matiere,
                    //     'code_matiere'=>$request->code_matiere,
                    //     'credit'=>$request->credit,
                    //     'credit'=>$request->credit,
                    //     'groupe'=>$request->groupe,
                    // ]);
                    // return view('admin.acceil');
                        
                        
                    // }

                    
        public function note(){
            $matier= DB::table('matiere')->get();
            return view('admin.note',['matier'=>$matier]);
        }
        
        public function ajouterNote(Request $request ,$id_etudiant){
            $request->validate([
                'matiere_id'=>'required',
                'credit'=>'required',
                'resultat'=>'required',
                'date_saisie'=>'required',
            ]);
            $etudiant=Etudiant::find($id_etudiant);
            DB::table('note')->insertGetId([
                'id_etudiant'=>$etudiant,
                'matiere_id'=>$request->matiere_id,
                'credit'=>$request->credit,
                'resultat'=>$request->resulat,
                'date_saisie'=>$request->date_saisie,
            ]);
            return back(route('admin.acceil'))->with('mety');
        } 


        
        public function search(Request $request)
        {
            $query = $request->input('rechercher'); 
            $promotionId = $request->input('promotion');
            
            // Construire la requête pour récupérer les étudiants avec la promotion
            $queryBuilder = DB::table('etudiant')
            ->join('promotion', 'etudiant.promo_id', '=', 'promotion.id_prom')
                ->select('etudiant.*', 'promotion.promotion as promotion');
            
            // Filtrer par nom et prénom si une recherche a été effectuée
            if ($query) {
                $queryBuilder->whereRaw('lower(nom || \' \' || prenom) ILIKE ?', ['%' . strtolower($query) . '%']);
            }

            // Filtrer par promotion si une promotion a été sélectionnée
            if ($promotionId) {
                $queryBuilder->where('etudiant.promo_id', $promotionId);
            }

            // Exécuter la requête
            $etudiants = $queryBuilder->get();
            
            $promotions = DB::table('promotion')->get();  
            
            // Passer les résultats à la vue, y compris les promotions
            return view('admin.acceil', [
                
                'etudiants' => $etudiants,
                'prom' => $promotions
                
            ]);
        }
 

        
    public function semetre($id_etudiant){
        $semestres = Semestre::all();
        $etudiant = Etudiant::find($id_etudiant);
    
     $note= new Note();
     for ($i=0;$i<count($semestres);$i++){
        $semestres[$i]['moyenne']=$note->noteSemestre_etudiant($id_etudiant,$semestres[$i]->id_semestre)['moyenne'];
        $semestres[$i]['resultat_status']=$note->noteSemestre_etudiant($id_etudiant,$semestres[$i]->id_semestre)['resultat_status'];
    }
    //  $notes=$note->noteSemestre_etudiant($id_etudiant,$id_semestre);
    //  dd($notes);
    return view('admin.semestre', [
        'semestre' => $semestres,
        'etudiant' => $etudiant,
        'id_etudiant' => $id_etudiant, // Passer id_etudiant à la vue
    ]);
    }


    public function resulat_semestre($id_etudiant, $id_semestre) {

         $note=new Note();
         $semestre_note= $note->noteSemestre_etudiant($id_etudiant,$id_semestre);
         
            return view('admin.note_semestre', [
                'etudiant' => $id_etudiant,
                'nom' => $semestre_note['nom'],
                'prenom' => $semestre_note['prenom'],
                'resultat' => $semestre_note['note'],
                'semestre' => $id_semestre,
                'total_note' => $semestre_note['total_note'],
                'total_credit' => $semestre_note['total_credit'],
                'moyenne' => $semestre_note['moyenne'],
                'credit' => $semestre_note['credit_obtenu'],
                'resultat_status' => $semestre_note['resultat_status'],
            ]);
        
    }

  
}