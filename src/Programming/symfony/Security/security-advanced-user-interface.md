## security advanced user interface

    use Symfony\Component\Security\Core\User\AdvancedUserInterface;
    // ...

    class User implements AdvancedUserInterface, \Serializable
    {
        // ...
		// checks whether the user's account has expired
        public function isAccountNonExpired()
        {
            return true;
        }
		// checks whether the user is locked
        public function isAccountNonLocked()
        {
            return true;
        }
		// checks whether the user's credentials (password) has expired
        public function isCredentialsNonExpired()
        {
            return true;
        }
		checks whether the user is enabled
        public function isEnabled()
        {
            return $this->isActive;
        }

        // serialize and unserialize must be updated - see below
        public function serialize()
        {
            return serialize([
                // ...
                $this->isActive,
            ]);
        }
        public function unserialize($serialized)
        {
            list (
                // ...
                $this->isActive,
            ) = unserialize($serialized);
        }
    }

The `AdvancedUserInterface` interface adds four extra methods to validate the account status:
- `isAccountNonExpired()` checks whether the user's account has expired;
- `isAccountNonLocked()` checks whether the user is locked;
- `isCredentialsNonExpired()` checks whether the user's credentials (password) has expired;
- `isEnabled()` checks whether the user is enabled.
If any of these return false, the user won't be allowed to login. You can choose to have persisted properties for all of these, or whatever you need.