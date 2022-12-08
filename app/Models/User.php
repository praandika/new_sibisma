<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dealer_code',
        'username',
        'access',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Relasi to created, updated Dealer
    public function dealerC(){
        return $this->hasMany(Dealer::class, 'created_by');
    }

    public function dealerU(){
        return $this->hasMany(Dealer::class, 'updated_by');
    }

    // Relasi to created, updated Unit
    public function unitC(){
        return $this->hasMany(Unit::class, 'created_by');
    }

    public function unitU(){
        return $this->hasMany(Unit::class, 'updated_by');
    }

    // Relasi to created, updated Color
    public function colorC(){
        return $this->hasMany(Color::class, 'created_by');
    }

    public function colorU(){
        return $this->hasMany(Color::class, 'updated_by');
    }

    // Relasi to created, updated Entry
    public function entryC(){
        return $this->hasMany(Entry::class, 'created_by');
    }

    public function entryU(){
        return $this->hasMany(Entry::class, 'updated_by');
    }

    // Relasi to created, updated Sale
    public function saleC(){
        return $this->hasMany(Sale::class, 'created_by');
    }

    public function saleU(){
        return $this->hasMany(Sale::class, 'updated_by');
    }

    // Relasi to created, updated Leasing
    public function leasingC(){
        return $this->hasMany(Leasing::class, 'created_by');
    }

    public function leasingU(){
        return $this->hasMany(Leasing::class, 'updated_by');
    }

    // Relasi to created, updated Sale Deliveries
    public function saleDeliveryC(){
        return $this->hasMany(SaleDelivery::class, 'created_by');
    }

    public function saleDeliveryU(){
        return $this->hasMany(SaleDelivery::class, 'updated_by');
    }

    // Relasi to created, updated Manpower
    public function manpowerC(){
        return $this->hasMany(Manpower::class, 'created_by');
    }

    public function manpowerU(){
        return $this->hasMany(Manpower::class, 'updated_by');
    }

    // Relasi to created, updated Branch Deliveries
    public function branchDeliveryC(){
        return $this->hasMany(BranchDelivery::class, 'created_by');
    }

    public function branchDeliveryU(){
        return $this->hasMany(BranchDelivery::class, 'updated_by');
    }

    // Relasi to created, updated Out
    public function outC(){
        return $this->hasMany(Out::class, 'created_by');
    }

    public function outU(){
        return $this->hasMany(Out::class, 'updated_by');
    }

    // Relasi to created, updated Opname
    public function opnameC(){
        return $this->hasMany(Opname::class, 'created_by');
    }

    public function opnameU(){
        return $this->hasMany(Opname::class, 'updated_by');
    }

    // Relasi to created, updated Document
    public function documentC(){
        return $this->hasMany(Document::class, 'created_by');
    }

    public function documentU(){
        return $this->hasMany(Document::class, 'updated_by');
    }

    // Relasi to created, updated History Stock
    public function historyC(){
        return $this->hasMany(StockHistory::class, 'created_by');
    }

    public function historyU(){
        return $this->hasMany(StockHistory::class, 'updated_by');
    }

    // Relasi to created, updated Stock
    public function stockC(){
        return $this->hasMany(Stock::class, 'created_by');
    }

    public function stockU(){
        return $this->hasMany(Stock::class, 'updated_by');
    }

    public function user(){
        return $this->hasMany(Log::class);
    }
}
