<?php

namespace vendorspace\models;

use vendorspace\models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use vendorspace\Notifications\VerifyEmail;
use vendorspace\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'email', 
        'password',
        'first_name',
        'last_name',
        'city',
        'state',
        'country',
        'email_token',
        'verified',
        'login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }
        if ($this->first_name) {
            return "{$this->first_name}";
        }
        return null;
    }

    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    public function getAvatarUrl($size)
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=$size";
    }

    public function statuses()
    {
        return $this->hasMany('vendorspace\models\Status', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('vendorspace\models\Like', 'user_id');
    }

    public function friendsOfMine(){
        return $this->belongsToMany('vendorspace\models\User', 'friends', 
            'user_id', 'friend_id');
    }
    public function friendOf(){
        return $this->belongsToMany('vendorspace\models\User', 'friends', 
            'friend_id', 'user_id');       
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->
            merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestsPending(User $user) 
    {
        return (bool) $this->friendRequestsPending()
            ->where('id', $user->id)->count();
    }

    public function hasFriendRequestsReceived(User $user)
    {
        return (bool) $this->friendRequests()
            ->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    public function deleteFriend(User $user)
    {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->
            update([
                'accepted' => true,
            ]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()
            ->where('id', $user->id)->count();        
    }

    public function hasLikedStatus(Status $status)
    {
        return (bool) $status->likes->where('user_id', $this->id)->count();
    }

    public function verified()
    {
        return $this->email_token === null;
    }

    public function sendVerificationEmail(User $user)
    {
        $this->notify(new VerifyEmail($user));
    }

    public function sendResetPasswordEmail(User $user)
    {
        $this->notify(new ResetPassword($user));
    }

}
