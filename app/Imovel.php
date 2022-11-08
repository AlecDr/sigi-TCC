<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $table = 'imoveis';
    /**
     * 
     *
     * @var array
     */
   
    protected $fillable = [
        'seq','setor','quadra','lote','owner_id','latitude','longitude','creator_id',
    ];
     
    /**
     * Get all of the Owner for the Imovel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function owner() {
        
        return $this->belongsTo(Owner::class);
    }
    
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
        $link = '<a href="'.route('imoveis.show', $this).'"';
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
        $mapPopupContent .= '<div class="title"><strong>'.__('imovel.seq').':</strong>'.$this->seq_link. '</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('imovel.setor').':</strong>'.$this->setor.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('imovel.quadra').':</strong>'.$this->quadra.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('imovel.lote').':</strong>'.$this->lote.'</div>';
            return $mapPopupContent;
    } 
    
}
