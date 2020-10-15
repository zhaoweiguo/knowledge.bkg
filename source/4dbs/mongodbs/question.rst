常见问题
########


1. Why does Mongo hint make a query run up to 10 times faster?[1]_ ::

    Mongo uses an algorithm to determine which index to be used when no hint is provided and then caches the index used for the similar query for next 1000 calls

    But whenever you explain a mongo query it will always run the index selection algorithm, thus the explain() with hint will always take less time when compared with explain() without hint.

    Similar question was answered here Understanding mongo db explain










.. [1] https://stackoverflow.com/questions/7730591/why-does-mongo-hint-make-a-query-run-up-to-10-times-faster