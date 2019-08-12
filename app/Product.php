<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pro_title', 'pro_desc', 'pro_brand', 'pro_origin' , 'pro_type' , 'pro_model', 'pro_packing', 'pro_termsSale', 'pro_incoterms', 'pro_payType', 'pro_color', 'pro_photo', 'category_id', 'user_id', 'comment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
