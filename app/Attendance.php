<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    protected $fillable = [
        'name',
        'email',
        'body',
        'flagged_at',
        'updated_at',
    ];
 
    /**
     * [QueryScope] 通報済みユーザの除外
     * 
     * @param $query
     * @return mixed
     */
    public function scopeIgnoreFlagged($query)
    {
        return $query->where('flagged_at', null);
    }

    /**
     * 通報処理（flagged_at の更新）
     * 
     * @return bool
     */

    public function flag()
    {
        return $this->update( [ 'flagged_at' => now() ] );
    }

     public function getAvaterAttribute(){
         return sprintf('https://www.gravatar.com/avatar/%s?s=100', md5( strtolower( trim( $this->email ) ) ) );
     }
}
