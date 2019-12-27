## Entity State(Entity的四个状态)
- `UnitOfWork::STATE_MANAGED`
	- An entity is in MANAGED state if it is associated with an `EntityManager` and it is not REMOVED.
- `UnitOfWork::STATE_REMOVED`
	- An entity is in REMOVED state after it has been passed to `EntityManager#remove()` until the next flush operation of the same EntityManager. A REMOVED entity is still associated with an `EntityManager` until the next flush operation.
- `UnitOfWork::STATE_DETACHED`
	- An entity is in DETACHED state if it has persistent state and identity but is currently not associated with an `EntityManager`.
- `UnitOfWork::STATE_NEW`
	- An entity is in NEW state if it has no persistent state and identity and is not associated with an `EntityManager` (for example those just created via the "new" operator).