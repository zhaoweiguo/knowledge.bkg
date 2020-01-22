JSONPath Support [1]_
###########################

json input::

    {
      "kind": "List",
      "items":[
        {
          "kind":"None",
          "metadata":{"name":"127.0.0.1"},
          "status":{
            "capacity":{"cpu":"4"},
            "addresses":[{"type": "LegacyHostIP", "address":"127.0.0.1"}]
          }
        },
        {
          "kind":"None",
          "metadata":{"name":"127.0.0.2"},
          "status":{
            "capacity":{"cpu":"8"},
            "addresses":[
              {"type": "LegacyHostIP", "address":"127.0.0.2"},
              {"type": "another", "address":"127.0.0.3"}
            ]
          }
        }
      ],
      "users":[
        {
          "name": "myself",
          "user": {}
        },
        {
          "name": "e2e",
          "user": {"username": "admin", "password": "secret"}
        }
      ]
    }

函数说明::

    text:     kind is {.kind} 
    @:        {@} (the current object )
    . or []:  {.kind} or {[‘kind’]}
    ..:       {..name}
    *:        {.items[*].metadata.name} 
    [start:end :step]:    {.users[0].name}
    [,]:      {.items[*][‘metadata.name’, ‘status.capacity’]} 
    ?():      {.users[?(@.name==“e2e”)].user.password}  
    range, end:   {range .items[*]}[{.metadata.name}, {.status.capacity}] {end} 
    “:            {range .items[*]}{.metadata.name}{’\t’}{end}

实例::

    kubectl get pods -o json
    kubectl get pods -o=jsonpath='{@}'
    kubectl get pods -o=jsonpath='{.items[0]}'
    kubectl get pods -o=jsonpath='{.items[0].metadata.name}'
    kubectl get pods -o=jsonpath='{range .items[*]}{.metadata.name}{"\t"}{.status.startTime}{"\n"}{end}'

On Windows::

    C:\> kubectl get pods -o=jsonpath="{range .items[*]}{.metadata.name}{'\t'}{.status.startTime}{'\n'}{end}"
    C:\> kubectl get pods -o=jsonpath="{range .items[*]}{.metadata.name}{\"\t\"}{.status.startTime}{\"\n\"}{end}"











.. [1] https://kubernetes.io/docs/reference/kubectl/jsonpath/





