## commands 常用命令
- `info` [redis.io/commands/info](https://redis.io/commands/info)
``` shell
127.0.0.1:6379> info memory
# Memory
used_memory:3577968
used_memory_human:3.41M
used_memory_rss:1150976
used_memory_rss_human:1.10M
used_memory_peak:3910144
used_memory_peak_human:3.73M
used_memory_peak_perc:91.50%
used_memory_overhead:1052222
used_memory_startup:980784
used_memory_dataset:2525746
used_memory_dataset_perc:97.25%
total_system_memory:17179869184
total_system_memory_human:16.00G
used_memory_lua:41984
used_memory_lua_human:41.00K
maxmemory:0
maxmemory_human:0B
maxmemory_policy:noeviction
mem_fragmentation_ratio:0.32
mem_allocator:libc
active_defrag_running:0
lazyfree_pending_objects:0
127.0.0.1:6379>
```