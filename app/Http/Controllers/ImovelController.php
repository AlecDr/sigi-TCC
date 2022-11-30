<?php

namespace App\Http\Controllers;

use App\Imovel;
use App\Owner;
use Illuminate\Http\Request;

class ImovelController extends Controller
{

   
    /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('manage_imovel');

        $imovelQuery = Imovel::query();
        $imovelQuery->where('seq', 'like', '%'.request('q').'%');
        #$imovelQuery->where('owner_name_owner', 'like', '%'.request('q').'%');
        $imoveis = $imovelQuery->paginate(5);

          
        return view('imoveis.index', compact('imoveis'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Imovel);
      
        return view('imoveis.create');

    }

  
    /**

     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Imovel);

        $newImovel = $request->validate([
            'seq'       => 'required|max:10',
            'setor'     => 'required|max:02',
            'quadra'    => 'required|max:05',
            'lote'      => 'required|max:05',
            'cpf'       => 'required|max:15',
            'name_owner'=> 'required|max:60',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',

        ]);

        
        $newImovel['creator_id'] = auth()->id();

        #aqui está o role, antes eu verifico se aquele owner para aquele CPF já existe
        #se não existir, cria, se existir apenas usa o que já existe
        $owner = Owner::where('cpf', $newImovel['cpf'])->first();
        if ($owner == null) {
            $owner = Owner::create($newImovel);
        }
        #uma vez criado ou buscou do banco, seto a id no imovel para ser salvo
        $newImovel['owner_id'] = $owner->id;

        $imovel = Imovel::create($newImovel);

        return redirect()->route('imoveis.index', $imovel);
    }

    /**
     * 
     *
     * @param  integer  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $imovel = Imovel::find($id);
        return view('imoveis.show', compact('imovel'));
    }

    /**
     * 
     *
     * @param  \App\Imovel  $Imovel
     * @return \Illuminate\View\View
     */
    public function edit(Imovel $imovel)
    {
        $this->authorize('update', $imovel);

        return view('imoveis.edit', compact('imovel'));
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Imovel  $Imovel
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Imovel $imovel)
    {
        $this->authorize('update', $imovel);

        $imovelData = $request->validate([
            'seq'       => 'required|max:10',
            'setor'     => 'required|max:02',
            'quadra'    => 'required|max:05',
            'lote'      => 'required|max:05',
            'cpf'       => 'required|max:15',
            'name_owner'=> 'required|max:60',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);

        #detalhe, isso nao foi feito para alterar os dados do owner, apenas cadastrar ou usar um que já existe
        #aqui está o role, antes eu verifico se aquele owner para aquele CPF já existe
        #se não existir, cria, se existir apenas usa o que já existe
        $owner = Owner::where('cpf', $imovelData['cpf'])->first();
        if ($owner == null) {
            $owner = Owner::create($imovelData);
        }
        
        $newImovel['owner_id'] = $owner->id;
     
        $imovel->update($imovelData);

        return redirect()->route('imoveis.index', $imovel);
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Imovel  $Imovel
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Imovel $imovel)
    {
        $this->authorize('delete', $imovel);

        $request->validate(['imovel_id' => 'required']);

        if ($request->get('imovel_id') == $imovel->id && $imovel->delete()) {
            return redirect()->route('imoveis.index');
        }

        return back();
    }
}
