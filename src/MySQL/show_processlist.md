## show processlist
> 查看状态，官方文档：https://dev.mysql.com/doc/refman/5.7/en/general-thread-states.html


		mysql> SHOW PROCESSLIST;
        +-------+------+-----------------+-----------+---------+------+--------------+-------------------------------------------------------------------------------------+
        | Id    | User | Host            | db        | Command | Time | State        | Info                                                                                |
        +-------+------+-----------------+-----------+---------+------+--------------+-------------------------------------------------------------------------------------+
        |  9596 | root | localhost:56906 | new_cheng | Execute |    1 | Sending data | SELECT COUNT(*) FROM `water` T0 WHERE T0.`create_at` >= ? AND T0.`device_no` = ?    |
        | 10352 | root | localhost:58444 | new_cheng | Execute |   12 | Sending data | SELECT COUNT(*) FROM `water` T0 WHERE T0.`create_at` >= ? AND T0.`device_no` = ?    |
        | 10851 | root | localhost:59440 | new_cheng | Sleep   |    1 |              | NULL                                                                                |
        | 11042 | root | localhost:59808 | new_cheng | Sleep   |    5 |              | NULL                                                                                |
        | 11180 | root | localhost:60084 | new_cheng | Sleep   |    8 |              | NULL                                                                                |
        | 11236 | root | localhost:60196 | new_cheng | Sleep   |    0 |              | NULL                                                                                |
        | 11242 | root | localhost:60208 | new_cheng | Sleep   |    1 |              | NULL                                                                                |
        | 11278 | root | localhost:60282 | new_cheng | Execute |    1 | Sending data | SELECT COUNT(*) FROM `electric` T0 WHERE T0.`create_at` >= ? AND T0.`device_no` = ? |
        | 11282 | root | localhost:60290 | new_cheng | Execute |   34 | Sending data | SELECT COUNT(*) FROM `electric` T0 WHERE T0.`create_at` >= ? AND T0.`device_no` = ? |
        | 11301 | root | localhost:60328 | new_cheng | Execute |   28 | Sending data | SELECT COUNT(*) FROM `electric` T0 WHERE T0.`create_at` >= ? AND T0.`device_no` = ? |