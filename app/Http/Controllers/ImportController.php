<?php

namespace App\Http\Controllers;
use App\Models\Import;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index() {
        return view('admin.import');
    }
   
    public function importCsv(Request $request) {
        $request->validate([
            'configuration'=>['required'],
            

        ]);
        $configuration =$request->file('configuration');
        try {
            $filename1 = "CSV1_".time().".".$configuration->getClientOriginalExtension();

            $path1 = 'data/'. $filename1;
            $configuration->move(storage_path('data/'), $filename1);
            $import = new Import();
            $error = $import->importDonne($path1);
            
            if (count($error) > 0){
                return back()->with([
                    'errtm'=> $error
                ]);
            }
            return back()->with([
                'message'=> ['Import termine']
            ]);
        } catch (\Exception $e) {
            $err[] = $e->getMessage();
            return back()->with('cath',$err);
        }
    }
  
    public function import_note(Request $request){
    $request->validate([
    'note' => ['required']
    ]);
        
    $note = $request->file('note');
    try {
                $filename2 = "CSV2_".time().".".$note->getClientOriginalExtension();
                $path2 = 'data/'. $filename2;
                $note->move(storage_path('data/'), $filename2);
                $import = new Import();

                $error = $import->importNote($path2);

                if (count($error) > 0) {
                    return back()->with([
                        'errtm'=> $error
                    ]);
                }
                return back()->with([
                    'message'=> ['Import termine']
                ]);
        } catch (\Exception $e) {
            $err[] = $e->getMessage();
            return back()->with('cath', $err);
        }
   }   
}