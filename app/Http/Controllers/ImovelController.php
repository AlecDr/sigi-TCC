<?php

namespace App\Http\Controllers;

use App\Imovel;
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
        $imovelQuery->orWhere('name_owner_id', 'like', '%'.request('q').'%');
        $imovels = $imovelQuery->paginate(5);

          
        return view('imovels.index', compact('imovels'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Imovel);
      
        return view('imovels.create');

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

        $imovel = Imovel::create($newImovel);

        return redirect()->route('imovels.show', $imovel);
    }

    /**
     * 
     *
     * @param  \App\Imovel  $Imovel
     * @return \Illuminate\View\View
     */
    public function show(Imovel $imovel)
    {
        return view('imovels.show', compact('imovel'));
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

        return view('imovels.edit', compact('imovel'));
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
        
        $imovel->update($imovelData);

        return redirect()->route('imovels.show', $imovel);
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
            return redirect()->route('imovels.index');
        }

        return back();
    }
}
