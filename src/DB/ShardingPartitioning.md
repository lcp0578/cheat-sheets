## Sharding VS Partitioning
- Partitioning is a general term used to describe the act of breaking up your logical data elements into multiple entities for the purpose of performance, availability, or maintainability.  
- Sharding is the equivalent of "horizontal partitioning".
- When to Partition a Table
    - Here are some suggestions for when to partition a table:
        - Tables greater than 2 GB should always be considered as candidates for partitioning.
        - Tables containing historical data, in which new data is added into the newest partition. A typical example is a historical table where only the current month's data is updatable and the other 11 months are read only.
        - When the contents of a table need to be distributed across different types of storage devices.
	- Partition Pruning
		Partition pruning is the simplest and also the most substantial means to improve performance using partitioning. Partition pruning can often improve query performance by several orders of magnitude. For example, suppose an application contains an Orders table containing a historical record of orders, and that this table has been partitioned by week. A query requesting orders for a single week would only access a single partition of the Orders table. If the Orders table had 2 years of historical data, then this query would access one partition instead of 104 partitions. This query could potentially execute 100 times faster simply because of partition pruning.
	- Partitioning Strategies
		- Range
		- Hash
		- List