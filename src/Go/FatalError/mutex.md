### fatal error: sync: unlock of unlocked mutex
- RUnlock() 之前不存在 RLock()

		package main
		
		import (
		   "sync"
		)
		
		func main() {
		   var rwmutex *sync.RWMutex
		   rwmutex = new(sync.RWMutex)
		   rwmutex.RUnlock()
		}
	- 程序输出：

			fatal error: sync: RUnlock of unlocked RWMutex
- RUnlock() 个数多于 RLock()

		package main
		
		import (
		   "sync"
		)
		
		func main() {
		   var rwmutex *sync.RWMutex
		   rwmutex = new(sync.RWMutex)
		   rwmutex.RLock()
		   rwmutex.RLock()
		   rwmutex.RUnlock()
		   rwmutex.RUnlock()
		   rwmutex.RUnlock()
		}
	- 程序输出：

			fatal error: sync: RUnlock of unlocked RWMutex