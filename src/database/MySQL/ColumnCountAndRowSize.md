## Limits on Table Column Count and Row Size
> https://dev.mysql.com/doc/refman/8.0/en/column-count-limit.html

- Column Count Limits
	- MySQL has hard limit of 4096 columns per table, but the effective maximum may be less for a given table. 
- Row Size Limits
	- The internal representation of a MySQL table has a maximum row size limit of 65,535 bytes, even if the storage engine is capable of supporting larger rows. BLOB and TEXT columns only contribute 9 to 12 bytes toward the row size limit because their contents are stored separately from the rest of the row.
	- The maximum row size for an InnoDB table, which applies to data stored locally within a database page, is slightly less than half a page for 4KB, 8KB, 16KB, and 32KB innodb_page_size settings. For example, the maximum row size is slightly less than 8KB for the default 16KB InnoDB page size. For 64KB pages, the maximum row size is slightly less than 16KB. 