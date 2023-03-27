<?php

namespace App\Http\Controllers\Pre_Writing\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Http\Controllers\Notification\EmailUserController;
use App\Models\User;

use App\Models\DocumentProject;

class DocumentProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function add_concept_note_doc(Request $request)
    {
        // if (!$request->file('document')->isValid()) {
        //     return redirect()->back()->withErrors(['error' => 'Ocorreu um erro ao carregar o documento'])->withInput();
        // }

        $rules = [
            'document' => 'required|file|max:5000|mimes:pdf,docx,doc',
            'doc_concept_note' => 'required|file|max:5000|mimes:pdf,docx,doc'
        ];
        $messages = [
            'document.required'=>translate('documento_invalido'),
            'doc_concept_note.required'=>translate('documento_invalido'),
            'doc_concept_note.mimes'=>translate('documento_invalido'),
            'document.mimes'=>translate('documento_invalido'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $dp_local_path = '';

        if($request->hasFile('document'))
        {
            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $document = time().'.'.$extension;
            $dp_local_path = $document;
            $request->document->move(public_path('docs'), $document);
            $dp_id = DB::table('dp_document_project')->max('dp_id') + 1;
            //dd(base64_decode($request->input('document_type')));
            DocumentProject::create([
                'dp_id' => $dp_id,
                'p_id' => base64_decode($request->input('p_id')),
                'dt_id' => 4,
                'psm_id' => 2,
                'dp_name' => 'Outros',
                'dp_description' => 'Outros',
                'dp_local_path' => $dp_local_path
            ]);
        }

        $dp_local_path = '';
        if($request->hasFile('doc_concept_note'))
        {
            $file = $request->file('doc_concept_note');
            $extension = $file->getClientOriginalExtension();
            $doc_concept_note = time().'.'.$extension;
            $dp_local_path = $doc_concept_note;
            $request->doc_concept_note->move(public_path('docs'), $doc_concept_note);

            DocumentProject::create([
                'dp_id' => $dp_id,
                'p_id' => base64_decode($request->input('p_id')),
                'dt_id' => 1,
                'psm_id' =>2,
                'dp_name' => 'Concept note',
                'dp_description' => 'Concept note',
                'dp_local_path' => $dp_local_path
            ]);
        }


        $old_project = DB::table('p_projects')->where('p_id', base64_decode($request->input('p_id')))->first();
                Project::where('p_id', base64_decode($request->input('p_id')))
                ->update([
                    'deleted_at' => now()
                ]);

           Project::create([
                'p_id' => base64_decode($request->input('p_id')),
                'p_name' => $old_project->p_name,
                'p_consortium' => $old_project->p_consortium,
                'p_acronym' => $old_project->p_acronym,
                'p_description' => $old_project->p_description,
                'p_submitted_at' => $old_project->p_submitted_at,
                'p_end_date' => $old_project->p_end_date,
                'p_deadline' => $old_project->p_deadline,
                'p_budget' => $old_project->p_budget,
                'p_web_url' => $old_project->p_web_url,
                'p_support_document' => $old_project->p_support_document,
                'p_source' => $old_project->p_source,
                'p_general_budget' => $old_project->p_general_budget,
                'p_state' => "Em curso",
                'u_id' => $old_project->u_id,
                'sa_id' => $old_project->sa_id,
                'p_currency' => $old_project->p_currency,
                'psm_id' => 3,
                'p_updated_by' => Auth::user()->u_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $email = new EmailUserController();
        $email_user = $email->getEmailUsers(2); // busca os emails dos usuários com role pre-award-manager

        array_push($email_user, Auth::user()->email);
        $message = array(
            'title'=> 'Concept Note', 'body'=>'Hello, The PI added the Concept Note document to proposal '.$old_project->p_name.'.'
        );
        $email->sendEmail($email_user, $message, 'Concept Note');


        return redirect()->back()->with(['success' => translate('requisao_submetida_sucesso')
        ])->withInput();

    }
}
