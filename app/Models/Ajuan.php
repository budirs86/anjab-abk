<?php

namespace App\Models;

use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuan extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;

    protected $table = 'ajuan';
    protected $guarded = ['id'];

    public function verifikasi()
    {
        return $this->hasMany(Verifikasi::class);
    }

    public function role_verifikasi()
    {
        return $this->hasMany(RoleVerifikasi::class);
    }

    // Ajuan for manajer kepegawaian
    // Get ajuan where jenis = anjab and already approved by admin
    public static function anjab_for_manajer_kepegawaian()
    {
        $previousVerificatorId = Role::where('name', 'Admin Kepegawaian')->first()->id;
        $roleId = auth()->user()->id;
        return Ajuan::where('jenis', 'anjab')
            ->whereHas('role_verifikasi', function ($query) use ($previousVerificatorId) {
                $query->where('role_id', $previousVerificatorId)->where('is_approved', true);
            })
            ->orWhereHas('verifikasi', function ($query) use ($roleId) {
                $query->whereHas('user', function ($query) use ($roleId) {
                    $query->where('id', $roleId);
                });
            })
            ->get();
    }

    // Ajuan for kepala buk
    // Get ajuan where jenis = anjab and already approved by manajer kepegawaian
    public static function anjab_for_kepala_buk()
    {
        $previousVerificatorId = Role::where('name', 'Manajer Kepegawaian')->first()->id;
        $roleId = auth()->user()->id;
        return Ajuan::where('jenis', 'anjab')
            ->whereHas('role_verifikasi', function ($query) use ($previousVerificatorId) {
                $query->where('role_id', $previousVerificatorId)->where('is_approved', true);
            })
            ->orWhereHas('verifikasi', function ($query) use ($roleId) {
                $query->whereHas('user', function ($query) use ($roleId) {
                    $query->where('id', $roleId);
                });
            })
            ->get();
    }

    // Ajuan for wakil rektor 2
    // Get ajuan where jenis = anjab and already approved by kepala buk
    public static function anjab_for_wakil_rektor_2()
    {
        $previousVerificatorId = Role::where('name', 'Kepala BUK')->first()->id;
        $roleId = auth()->user()->id;
        return Ajuan::where('jenis', 'anjab')
            ->whereHas('role_verifikasi', function ($query) use ($previousVerificatorId) {
                $query->where('role_id', $previousVerificatorId)->where('is_approved', true);
            })
            ->orWhereHas('verifikasi', function ($query) use ($roleId) {
                $query->whereHas('user', function ($query) use ($roleId) {
                    $query->where('id', $roleId);
                });
            })
            ->get();
    }

    // Get the latest verifikasi
    public function latest_verifikasi()
    {
        return $this->verifikasi()->latest()->first();
    }

    // Get the latest verifikasi (excluding admin)
    public function latest_verifikasi_without_admin()
    {
        $adminIds = ModelHasRole::where('role_id', 1)->pluck('model_id');

        return $this->verifikasi()->whereNotIn('user_id', $adminIds)->latest()->first();
    }

    // get the latest verifikasi by current user
    public function latest_verifikasi_by_current_user()
    {
        return $this->verifikasi()->where('user_id', auth()->user()->id)->latest()->first();
    }

    // Get the role name of the verificator who verifed the latest verifikasi
    public function latest_verificator()
    {
        if (!$this->latest_verifikasi()) {
            return null;
        }

        $id = $this->latest_verifikasi()->user_id;
        $verificator = User::find($id);
        return $verificator->getRoleNames()->first();
    }

    // Get the next verificator that has not approved the ajuan
    public function next_verificator()
    {
        return $this->role_verifikasi()->where('is_approved', false)->first();
    }

    public function current_verificator()
    {
        return $this->role_verifikasi()->where('is_approved', false)->first();
    }

    // Get all verificator that has approved the ajuan, but exclude role_verifikasi with role_id = 1
    public function approved_verificator()
    {
        $adminId = Role::where('name', 'Admin Kepegawaian')->first()->id;
        $operatorId = Role::where('name', 'Operator Unit Kerja')->first()->id;

        if ($this->jenis == 'anjab') {
            return $this->role_verifikasi()->where('is_approved', true)->where('role_id', '!=', $adminId)->get();
        } elseif ($this->jenis == 'abk') {
            return $this->role_verifikasi()->where('is_approved', true)->where('role_id', '!=', $operatorId)->get();
        }
    }

    // Check if all verificator has approved the ajuan
    public function is_approved()
    {
        return $this->role_verifikasi()->where('is_approved', true)->count() == $this->role_verifikasi()->count();
    }

    public function abkAnjab()
    {
        return $this->hasMany(AbkAnjab::class);
    }

    public function detailAbk()
    {
        return $this->hasMany(DetailAbk::class);
    }

    // return abk instances for an anjab
    public function abk()
    {
        return $this->belongsToMany(Ajuan::class, 'abk_anjab', 'anjab_id', 'abk_id');
    }

    // return anjab instance of the anjab
    public function anjab()
    {
        return $this->belongsToMany(Ajuan::class, 'abk_anjab', 'abk_id', 'anjab_id');
    }

    // return the count of approved abk for an anjab
    public function approvedAbkCount()
    {
        $roleIdWD2 = Role::where('name', 'Wakil Dekan 2')->first()->id;
        $roleIdKepalaUnit = Role::where('name', 'Kepala Unit Kerja')->first()->id;

        // return $this->abk() whereHas 'role_verifikasi' approved by wakil dekan 2 or kepala unit kerja
        return $this->children()->whereHas('role_verifikasi', function ($query) use ($roleIdWD2, $roleIdKepalaUnit) {
            $query->where('role_id', $roleIdWD2)->where('is_approved', true)->orWhere('role_id', $roleIdKepalaUnit)->where('is_approved', true);
        })->count();
    }

    // Ajuan for manajer kepegawaian
    // Get ajuan where jenis = anjab and already approved by admin
    public static function abk_for_verificator_after($previousVerificatorId)
    {
        $roleId = auth()->user()->id;
        return Ajuan::where('jenis', 'abk')
            ->whereHas('role_verifikasi', function ($query) use ($previousVerificatorId) {
                $query->where('role_id', $previousVerificatorId)->where('is_approved', true);
            })
            ->orWhereHas('verifikasi', function ($query) use ($roleId) {
                $query->whereHas('user', function ($query) use ($roleId) {
                    $query->where('id', $roleId);
                });
            })
            ->get();
    }
}
