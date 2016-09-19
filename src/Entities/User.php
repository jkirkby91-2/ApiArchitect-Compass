<?php

namespace ApiArchitect\Compass\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiArchitect\Compass\Entities\Thing;
use LaravelDoctrine\ACL\Roles\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use LaravelDoctrine\ACL\Mappings as ACL;
use ApiArchitect\Compass\Libraries\EntityTrait;
use ApiArchitect\Compass\Contracts\EntityContract;
use LaravelDoctrine\ACL\Permissions\HasPermissions;
use LaravelDoctrine\ACL\Contracts\HasRoles as HasRolesContract;
use LaravelDoctrine\ORM\Auth\Authenticatable AS AuthenticatableTrait;
use Illuminate\Auth\Passwords\CanResetPassword AS CanResetPasswordTrait;
use Illuminate\Contracts\Auth\Authenticatable AS AuthenticatableContract;
use LaravelDoctrine\ACL\Contracts\HasPermissions as HasPermissionContract;
use Illuminate\Contracts\Auth\CanResetPassword AS CanResetPasswordContract;

use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use LaravelDoctrine\ORM\Facades\EntityManager;
use ApiArchitect\Compass\Repositories\NodeRepository;

/**
 * Class User
 *
 * @package app\Entities
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="ApiArchitect\Compass\Repositories\UserRepository")
 * @ORM\Table(name="users", indexes={@ORM\Index(name="search_idx", columns={"email"})})
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks
 *
 * @package app\Http\Controllers
 * @author James Kirkby <jkirkby91@gmail.com>
 */
final class User extends Thing implements EntityContract, AuthenticatableContract, JWTSubject, CanResetPasswordContract,HasRolesContract, HasPermissionContract
{

    use HasRoles, EntityTrait, HasPermissions, AuthenticatableTrait, CanResetPasswordTrait;

    /**
     * @ORM\Column(type="string",unique=true, nullable=false)
     */
    protected $email;

    /**
     * @ACL\HasRoles()
     * @var \Doctrine\Common\Collections\ArrayCollection|\LaravelDoctrine\ACL\Contracts\Role[]
     */
    protected $roles;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $password;

    /**
     * @ACL\HasPermissions
     */
    public $permissions;

    /**
     * @ORM\Column(name="remember_token", type="string", nullable=true)
     */
    protected $rememberToken;

    /**
     * User constructor.
     * @param $email
     * @param $password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->setNodeType('User');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->username;
    }

    /**
     * @param $username
     * @return $this
     */
    public function setUserName($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken() {
        return $this->rememberToken;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setRememberToken($value) {
        $this->rememberToken = $value;
        return $this;
    }
    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName() {
        return "rememberToken";
    }


    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\LaravelDoctrine\ACL\Contracts\Role[]
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection|\LaravelDoctrine\ACL\Contracts\Role[] $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param mixed $permissions
     * @return User
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getId();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
