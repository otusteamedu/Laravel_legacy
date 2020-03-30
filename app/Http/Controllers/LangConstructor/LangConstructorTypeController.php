<?php

namespace App\Http\Controllers\LangConstructor;

use App\Http\Controllers\Controller;
use App\Models\ConstructionType;
use Illuminate\Http\Request;

class LangConstructorTypeController extends Controller
{
    public function index()
    {
        /** @var ConstructionType $langConstructorType */
        $langConstructorTypes = ConstructionType::All();

        return view('lang-constructor.lang-constructor-type.index',['langConstructorTypes' => $langConstructorTypes]);
    }

    public function edit($id = null)
    {

        /** @var ConstructionType $langConstructorType */
        $langConstructorType = ConstructionType::findOrNew($id);

        return view('lang-constructor.lang-constructor-type.edit',['langConstructorType' => $langConstructorType]);
    }

    public function save(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|regex:/^[a-zA-Z0-9\-\_]+$/u|unique:construction_types|max:255',
            'description' => 'required|string'
        ]);

        $request->request->add(['created_account_id' => '1']);
        $langConstructorType  = ConstructionType::create($request->except(['_token']));

        return redirect(route('lang-constructor-type-edit', ['id' => $langConstructorType->id]))->with('status',__('system.saved'));

    }

    public function delete($id)
    {
        /** @var ConstructionType $langConstructorType */
        $langConstructorType = ConstructionType::find($id);
        $langConstructorType->delete();

        return redirect(route('lang-constructor-type-index'))->with('status',__('system.deleted'));
    }
}
