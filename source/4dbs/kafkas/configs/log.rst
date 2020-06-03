日志相关
########


    log.cleanup.policy: 保留窗口之外segments的清理机制

    # log.retention.{hours,minutes,ms} 
    # 日志保留时间(小时，分钟，毫秒。优先级依次升高), 超出保留时间的日志执行cleanup.policy定义的操作
    log.retention.ms: 删除保留日志文件的毫秒数
    log.retention.minutes: 删除保留日志文件的分钟数
    log.retention.hours: 删除保留日志文件的小时数,默认168


    # 最大日志保留大小
    log.retention.bytes: 删除保留日志文件的最大size,默认为-1
    log.retention.check.interval.ms: 日志清理程序检查频率,默认为300000ms

    offsets.retention.check.interval.ms:
    offsets.retention.minutes:

    log.cleaner.delete.retention.ms:默认86400000ms



