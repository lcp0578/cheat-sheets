### fatal error: concurrent map read and map write
> Go 语言中的 map 在并发情况下，只读是线程安全的，同时读写线程不安全。

- 解决方案一（通过读写锁sync.RWMutex实现对map的并发访问控制）

        package main

        import "sync"

        type SafeMap struct {
            sync.RWMutex
            Map map[int]int
        }

        func main() {
            safeMap := newSafeMap(10)

            for i := 0; i < 100000; i++ {
                go safeMap.writeMap(i, i)
                go safeMap.readMap(i)
            }

        }

        func newSafeMap(size int) *SafeMap {
            sm := new(SafeMap)
            sm.Map = make(map[int]int)
            return sm

        }

        func (sm *SafeMap) readMap(key int) int {
            sm.RLock()
            value := sm.Map[key]
            sm.RUnlock()
            return value
        }

        func (sm *SafeMap) writeMap(key int, value int) {
            sm.Lock()
            sm.Map[key] = value
            sm.Unlock()
        }
- 解决方案二（Go Version >= 1.9,直接使用sync.Map）

		package main
        import (
              "fmt"
              "sync"
        )
        func main() {
            var safeMap sync.Map
            
            // save key/value
            safeMap.Store("a", 1)
            safeMap.Store("b", 2)
            safeMap.Store("c", 3)
            
            // get value
            fmt.Println(safeMap.Load("c"))
            
            // remove key
            safeMap.Delete("b")
            
            // range map
            safeMap.Range(func(k, v interface{}) bool {
                fmt.Println("iterate:", k, v)
                return true
            })
        }