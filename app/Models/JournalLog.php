<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class JournalLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['encrypted_note'];
    protected $appends = ['note'];

    public function setEncryptedNote(?string $note): void
    {
        if ($note) {
            $this->encrypted_note = Crypt::encryptString($note);
        }
    }

    public function getNoteAttribute(): ?string
    {
        if ($this->encrypted_note) {
            return Crypt::decrypt($this->encrypted_note, false);
        }

        return null;
    }
}
