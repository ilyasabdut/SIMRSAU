<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
             protected $table = "tb_user";
    protected $fillable = [
       'id', 'nama', 'email', 'password','level','status'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
    public function role($role) {
    $role = (array)$role;
    return in_array($this->role, $role);
}
    public function tbdokter(){
        return $this->hasOne("App\Tb_biodokter",'id');
    }
     public function deletedok(){
        $this->tbdokter()->delete();
        return parent::delete();
    }
    public function tbdaftar(){
        return $this->hasMany("App\Tb_daftar",'user_id','id');
    }
    public function tbhasil(){
        return $this->hasMany("App\Tb_hasil",'user_id','id');
    }
   
    public function tbpasien(){
        return $this->hasOne("App\Tb_biopasien",'id','id');
    }
    public function deletepas(){
        $this->tbpasien()->delete();
        return parent::delete();
    }
}