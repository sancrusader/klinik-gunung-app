<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Contracts\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'birth_date',
        'profile_photo_path',
        'role',
        'queue_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getProfilePhotoUrl()
    {
        return $this->profile_photo_path ? Storage::url($this->profile_photo_path) : asset('storage/avatar/klinik_gunung_avatar.jpg');
    }

    public function generateQrCode()
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'queue_number' => $this->queue_number
        ];

        $qrCode = QrCode::format('png')->size(200)->generate(json_encode($data));
        $fileName = 'qrcodes/' . $this->id . '_qr.png';
        Storage::put('public/' . $fileName, $qrCode);

        return $fileName;
    }

    public function screenings(): HasMany
    {
        return $this->hasMany(Screening::class);
    }
}