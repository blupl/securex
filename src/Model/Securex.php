<?php namespace Blupl\Securex\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Securex
 * @package Blupl\Securex\Model
 */
class Securex extends Model {

    protected $table = 'securex';

    public function roleName($role){
        $roles =[
            'security_officer'=>'Security Liaison Officer', 'ansar'=>'Ansar &amp; VDP', 'private_security'=>'Private Security Staff'
        ];

        return array_get($roles, $role);
    }

    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'mobile',
        'email',
        'personal_id',
        'date_of_birth',
        'role',
        'workstation',
        'present_address1',
        'present_address2',
        'permanent_address1',
        'permanent_address2',
        'photo',
        'attachment',
        'status'
    ];

    public function zone()
    {
        return $this->morphMany('Blupl\PrintMedia\Model\Zone', 'zoneable');
    }

    public function grade()
    {
        return $this->morphOne('Blupl\PrintMedia\Model\Grade', 'gradeable');
    }

}
