<?php

namespace App\Policies;

use App\User;
use App\Imovel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImovelPolicy
{
    use HandlesAuthorization;

    /**
     * 
     * @param  \App\User  $user
     * @param  \App\Imovel  $Imovel
     * @return mixed
     */
    public function view(User $user, Imovel $imovel)
    {
        
        return true;
    }

    /**
     *
     * @param  \App\User  $user
     * @param  \App\Imovel  $Imovel
     * @return mixed
     */
    public function create(User $user, Imovel $imovel)
    {
        
        return true;
    }

    /**
     * 
     *
     * @param  \App\User  $user
     * @param  \App\Imovel  $Imovel
     * @return mixed
     */
    public function update(User $user, Imovel $imovel)
    {
        
        return true;
    }

    /**
     * 
     *
     * @param  \App\User  $user
     * @param  \App\Imovel  $Imovel
     * @return mixed
     */
    public function delete(User $user, Imovel $imovel)
    {
       
        return true;
    }
}
