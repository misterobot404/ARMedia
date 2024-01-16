<?php

namespace App\Http\Controllers\Api;

use App\Models\Place;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDealRequest;
use App\Models\Deal;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;


class DealsController extends BaseController
{
    public function index(Request $request)
    {
        return Deal::all();
    }

    public function indexMy(Request $request)
    {
        return Deal::where('customer_id', auth()->id())->get();
    }

    public function indexOnMyObjects(Request $request)
    {
        return Deal::where('object_owner_id', auth()->id())->get();
    }

    public function info($obj)
    {
        return Deal::where('id', $obj)->first();
    }

    public function store(StoreDealRequest $request)
    {
        $data = $request->validated();
        Deal::create($data);
        return response()->json(['success' => true], 201);
    }

    public function contract($id)
    {
        $deal = Deal::where('id', $id)->first();
        $object = Place::where('id', $deal->object_id)->first();
        $user_owner = User::where('id', $deal->object_owner_id)->first();
        $user_taker = User::where('id', $deal->customer_id)->first();

        $phpWord = new PhpWord();
        $doc = new TemplateProcessor(public_path('contract_template.docx'));
        $doc->setValue('num_dogovor', $deal->id);
        $doc->setValue('owner_fio', $user_owner->surname.' '.$user_owner->name.' '.$user_owner->patronymic);
        $doc->setValue('taker_fio', $user_taker->surname.' '.$user_taker->name.' '.$user_taker->patronymic);
        $doc->setValue('address', $object->address);

        // вывод непосредственно в браузер
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="Договор #'.$deal->id.'_'.$object->title.'.docx"');
        header('Cache-Control: max-age=0');
        $doc->saveAs('php://output');
        exit();
    }

    public function confirm($id)
    {
        $deal = Deal::where('id', $id)->first();
        $deal->confirmed = true;
        $deal->save();

        return response()->json(['success' => true], 201);
    }

    public function destroy($id)
    {
        Deal::where('id', $id)->first()->delete();
        return response()->json(['success' => true], 200);
    }

    public function user_deals(User $user) {
        return $user->deals;
    }
}
