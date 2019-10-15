Erlang调优
====================
::

  [erlang:garbage_collect(P) || P <- erlang:processes(),{status, waiting} == erlang:process_info(P, status)].








