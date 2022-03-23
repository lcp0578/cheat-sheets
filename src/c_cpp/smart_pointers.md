## 智能指针
> In modern C++ programming, the Standard Library includes *smart pointers*, which are used to help ensure that programs are free of memory and resource leaks and are exception-safe.  
> https://docs.microsoft.com/en-us/cpp/cpp/smart-pointers-modern-cpp?view=msvc-170
### C++ Standard Library smart pointers
Use these smart pointers as a first choice for encapsulating pointers to plain old C++ objects (POCO).

- `unique_ptr`
	- Allows exactly one owner of the underlying pointer. Use as the default choice for POCO unless you know for certain that you require a `shared_ptr`. 
	- Can be moved to a new owner, but not copied or shared. 
	- Replaces `auto_ptr`, which is deprecated. Compare to `boost::scoped_ptr`. `unique_ptr` is small and efficient; the size is one pointer and it supports rvalue references for fast insertion and retrieval from C++ Standard Library collections. 
	- Header file: `<memory>`.
	- [ How to: Create and Use unique_ptr Instances](https://docs.microsoft.com/en-us/cpp/cpp/how-to-create-and-use-unique-ptr-instances?view=msvc-170)
- `shared_ptr`
	- Reference-counted smart pointer. Use when you want to assign one raw pointer to multiple owners, for example, when you return a copy of a pointer from a container but want to keep the original. 
	- The raw pointer is not deleted until all `shared_ptr` owners have gone out of scope or have otherwise given up ownership. 
	- The size is two pointers; one for the object and one for the shared control block that contains the reference count. 
	- Header file: `<memory>`.
	- [How to: Create and Use shared_ptr Instances](https://docs.microsoft.com/en-us/cpp/cpp/how-to-create-and-use-shared-ptr-instances?view=msvc-170)
- `weak_ptr`
	- Special-case smart pointer for use in conjunction with `shared_ptr`. A `weak_ptr` provides access to an object that is owned by one or more `shared_ptr` instances, but does not participate in reference counting.
	-  Use when you want to observe an object, but do not require it to remain alive. Required in some cases to break circular references between `shared_ptr` instances. 
	- Header file: <memory>.
	- [How to: Create and Use weak_ptr Instances](https://docs.microsoft.com/en-us/cpp/cpp/how-to-create-and-use-weak-ptr-instances?view=msvc-170)