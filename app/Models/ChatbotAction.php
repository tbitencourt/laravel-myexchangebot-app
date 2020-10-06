<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Class ChatbotAction
 * @package App\Models
 * @property integer $id
 * @property string $hash
 * @property int $action_enum
 * @property string $action
 * @property mixed $content
 * @property int $status_enum
 * @property string $status
 * @property string $start_date
 * @property string $end_date
 * @property string $created_at
 * @property string $updated_at
 */
class ChatbotAction extends Model
{
    use HasFactory;

    const KEY_ACTION_LOGIN = 1;
    const VALUE_ACTION_LOGIN = "Login";
    const KEY_STATUS_PENDING = 1;
    const KEY_STATUS_FINISHED = 2;
    const KEY_STATUS_EXPIRED = 3;
    const KEY_STATUS_CANCELED = 4;
    const VALUE_STATUS_PENDING = "Pending";
    const VALUE_STATUS_FINISHED = "Finished";
    const VALUE_STATUS_EXPIRED = "Expired";
    const VALUE_STATUS_CANCELED = "Canceled";
    const VALUE_NA = "N/A";

    /**
     * @var array
     */
    protected $fillable = ['hash', 'action_enum', 'content', 'status_enum', 'start_date', 'end_date', 'created_at', 'updated_at'];

    /**
     * @return string
     */
    public function getActionAttribute()
    {
        switch ($this->action_enum) {
            case self::KEY_ACTION_LOGIN:
                return __(self::VALUE_ACTION_LOGIN);
            default:
                return __(self::VALUE_NA);
        }
    }

    /**
     * @return string
     */
    public function getStatusAttribute()
    {
        switch ($this->status_enum) {
            case self::KEY_STATUS_PENDING:
                return __(self::VALUE_STATUS_PENDING);
            case self::KEY_STATUS_FINISHED:
                return __(self::VALUE_STATUS_FINISHED);
            case self::KEY_STATUS_EXPIRED:
                return __(self::VALUE_STATUS_EXPIRED);
            case self::KEY_STATUS_CANCELED:
                return __(self::VALUE_STATUS_CANCELED);
            default:
                return __(self::VALUE_NA);
        }
    }

    /**
     * @return void
     */
    public function generateHash(): void
    {
        $this->hash = Hash::make($this->id);
        $this->save();
    }

    /**
     * @return void
     */
    public function endAction(): void
    {
        $this->end_date = now();
        $this->status_enum = ChatbotAction::KEY_STATUS_FINISHED;
        $this->save();
    }
}
