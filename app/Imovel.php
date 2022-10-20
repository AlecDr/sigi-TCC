<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;
    protected $table = 'imoveis';

     /**
     * Get all of the Owner for the Imovel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function owner() {
        #Aqui foi o contrário.. era pra um imóvel pertencer a um dono
        #belongsTo
        #lembrando, que se você não mudar o nome da id, e usar tabela_id na chave estrangeira,
        #nao precisa definir os outros parametros, só a classe a qual ela pertence, fica mais simples
        return $this->belongsTo(Owner::class);
    }
    

    /**
     * 
     *
     * @var array
     */
   
    protected $fillable = [
       'imovel_type_id','seq','setor','quadra','lote',
       'owner_id','latitude','longitude','creator_id',
    ];

       
    

    /**
     * 
     *
     * @var array
     */
    public $appends = [
        'coordinate', 'map_popup_content',
    ];

    /**
     * 
     *
     * @return string
     */
    public function getSeqLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'seq' => $this->seq, 'type' => __('imovel.imovel'),
        ]);
        $link = '<a href="'.route('imovels.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->seq;
        $link .= '</a>';

        return $link;
    }

 

    /**
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
        
    }

    /**
     * 
     *
     * @return string|null
     */
    public function getCoordinateAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->latitude.', '.$this->longitude;
        }
    }

    /**
     * 
     *
     * @return string
     */
    public function getMapPopupContentAttribute()
    {
        $mapPopupContent = '';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('imovel.seq').':</strong><br>'.$this->seq_link.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('imovel.setor').':</strong><br>'.$this->setor.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('imovel.quadra').':</strong><br>'.$this->quadra.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('imovel.lote').':</strong><br>'.$this->lote.'</div>';

        return $mapPopupContent;
    } 
}
