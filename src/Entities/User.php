<?php

namespace ApiArchitect\Compass\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Tymon\JWTAuth\Contracts\JWTSubject;
use LaravelDoctrine\ACL\Mappings as ACL;
use LaravelDoctrine\ACL\Contracts\HasRoles as HasRolesContract;
use Illuminate\Contracts\Auth\Authenticatable AS AuthenticatableContract;
use LaravelDoctrine\ACL\Contracts\HasPermissions as HasPermissionContract;
use Illuminate\Contracts\Auth\CanResetPassword AS CanResetPasswordContract;

/**
 * Class User
 *
 * @package app\Entities
 * @ORM\Entity(repositoryClass="ApiArchitect\Compass\Repositories\UserRepository")
 * @ORM\Table(name="users", indexes={@ORM\Index(name="search_idx", columns={"email"})})
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks
 *
 * @package app\Http\Controllers
 * @author James Kirkby <jkirkby91@gmail.com>
 */

class User extends \App\Entities\Person implements AuthenticatableContract, JWTSubject, CanResetPasswordContract, HasRolesContract, HasPermissionContract {

	use \LaravelDoctrine\ACL\Roles\HasRoles,
	\LaravelDoctrine\ACL\Permissions\HasPermissions,
	\LaravelDoctrine\ORM\Auth\Authenticatable,
	\Illuminate\Auth\Passwords\CanResetPassword;

	/**
	 * @var
	 *
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer", unique=true, nullable=false)
	 */
	protected $id;

	/**
	 * @var ArrayCollection
	 * @ORM\ManyToMany(targetEntity="Roles", cascade={"all"}, fetch="EAGER")
	 * @ORM\JoinTable(name="user_roles",
	 *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id", unique=true)})
	 */
	protected $roles;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 */
	protected $username;

	/**
	 * @var
	 * @ORM\Column(type="string",unique=true, nullable=false)
	 */
	protected $email;

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
	 * @param $password
	 * @param $email
	 * @param $name
	 */
	public function __construct($password, $email, $name, $username) {
		$this->password = $password;
		$this->setName($name);
		$this->setEmail($email);
		$this->setUserName($username);
		$this->setNodeType('User');
	}

	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param $password
	 * @return $this
	 */
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUserName() {
		return $this->username;
	}

	/**
	 * @param $username
	 * @return $this
	 */
	public function setUserName($username) {
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
	public function getRoles() {
		return $this->roles;
	}

	/**
	 * @param OpeningHoursSpecification $openingHoursSpecification
	 * @return $this
	 */
	public function addRoles(Role $role) {
		if (!$this->roles->contains($role)) {
			$this->role->add($role);
		}
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPermissions() {
		return $this->permissions;
	}

	/**
	 * @param mixed $permissions
	 * @return User
	 */
	public function setPermissions($permissions) {
		$this->permissions = $permissions;
		return $this;
	}

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier() {
		return $this->getId();
	}
	/**
	 * Return a key value array, containing any custom claims to be added to the JWT
	 *
	 * @return array
	 */
	public function getJWTCustomClaims() {
		return [];
	}

}
