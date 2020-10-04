<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatMessage
 * @package App\Models
 * @property integer $id
 * @property string $message
 * @property string $added_on
 * @property int $type_enum
 * @property string $type
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class ChatbotMessage extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['message', 'added_on', 'type_enum', 'user_id', 'created_at', 'updated_at'];

    /**
s     * @return string
     */
    public function getTypeAttribute()
    {
        return $this->type_enum == 1 ? 'bot' : 'user';
    }
}
