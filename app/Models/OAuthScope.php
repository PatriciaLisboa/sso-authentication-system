namespace App\Models;

use App\Models\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OAuthScope extends Model
{
    use HasFactory, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'description',
    ];

    /**
     * Get the clients for the scope.
     */
    public function clients()
    {
        return $this->belongsToMany(OAuthClient::class, 'oauth_client_scopes');
    }
} 