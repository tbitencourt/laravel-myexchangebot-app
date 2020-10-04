<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BotHint
 * @package App\Models
 * @property integer $id
 * @property string $question
 * @property string $reply
 * @property string $created_at
 * @property string $updated_at
 */
class ChatbotHint extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['question', 'reply'];
}
