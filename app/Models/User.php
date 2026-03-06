<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'first_name',
        'last_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function fotos()
    {
        return $this->morphMany(Fotos::class, 'foto_model');
    }

    public static function createNewAdmin(array $data = [])
    {
        $user = self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'password' => Hash::make($data['password']),
            'admin' => (bool)(isset($data['admin']) ? $data['admin'] : false),
        ]);

        if (!empty($data['foto'])) {

            $foto = $data['foto'];

            $path = Fotos::storeFoto($foto);

            Fotos::createNew([
                'model_id' => $user->id,
                'model_class' => self::class,
                'path' => $path
            ]);
        }

        return $user;
    }
    public static function createNew(array $data = [])
    {

        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'password' => Hash::make($data['password']),
            'role' => 'User',
        ]);
    }

    public static function deleteUser($id)
    {

        $user = self::findOrFail($id);

        foreach ($user->fotos as $foto) {
            Storage::disk('public')->delete($foto->path);
            $foto->delete();
        }

        $user->delete();
    }

    public static function updateUser(int $id, array $data = [])
    {

        $user = self::findOrFail($id);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'admin' => (bool)(isset($data['admin']) ? $data['admin'] : false),
        ]);

        if (!empty($data['foto'])) {

            $foto = $data['foto'];

            $path = Fotos::storeFoto($foto);

            Fotos::createNew([
                'model_id' => $user->id,
                'model_class' => self::class,
                'path' => $path
            ]);
        }

        return $user;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
