## ULID：通用唯一按字典排序的标识符
- 全称是Universally Unique Lexicographically Sortable Identifier，直译过来就是通用唯一按字典排序的标识符。
- ULID is a specification for generating unique and lexicographically sortable 128-bit identifiers. As a result, the generated identifiers can be used in many cases where sorting is important.
	- For example, ULIDs can be used as database keys where guaranteed ordering allows for efficient indexing and sharding. Additionally, we can use ULIDs as identifiers in distributed systems for better tracing. Furthermore, we can also use them as transaction and event-sourcing identifiers, which, due to the timestamp component, makes them easier to track, validate, and audit.

	- Unlike UUIDs, which are typically generated using pseudo-random or time-based algorithms, ULIDs combine time-based components with randomness to achieve uniqueness while preserving the ability to be sorted lexicographically.

- Advantages and Disadvantages
	- ULIDs provide several advantages as random identifiers:
		- Efficient lexicographical and chronological sorting of generated identifiers without any additional processing
		- Compact and readable representation using 26 characters without any special characters
		- Case-insensitive and avoids similar-looking characters using Crockford encoding
	- However, ULIDs do come with a few disadvantages in some instances:
		- The randomness component may weaken when multiple identifiers are generated within the same millisecond, as the least significant bit (LSB) increment may not provide enough variance
		- Limited adoption and less support compared to more established identifiers
		- Dependency on timestamps could pose challenges when obtaining accurate timestamps, which is problematic
- Comparison with UUID
	- Despite UUID and ULID utilizing 128 bits for identification purposes, their representations have significant differences.
	- UUID typically has 36 characters, while ULID requires only 26 characters. Additionally, UUID lacks sorting capability, making it inefficient in scenarios where sorting is crucial for optimal performance, such as database keys.