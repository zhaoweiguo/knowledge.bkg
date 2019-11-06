GizmoAPI
########

The graph object
================

唯一入口对象::

    Name: graph, Alias: g

::

    graph.Emit(*)
    g.Emit({name:"bob"}) // push {"name":"bob"} as a result



    graph.M(), graph.Morphism()
    var shorterPath = graph.Morphism().Out("foo").Out("bar")

    graph.V(*), graph.Vertex([nodeId],[nodeId]...)

    graph.Uri(s)


Path object
===========
::

    path.All()
    path.And(path), 
    
    path.Back(tag)
    path.Both([predicatePath], [tags])
    path.Count()
    path.Difference(path), path.Except(path)

    path.Save(predicate, tag)
    

path.As(tags), path.Tag(tags)
-----------------------------
saves a list of nodes to a given tag.
tag::

    A string or list of strings to act as a result key. 
    The value for tag was the vertex the path was on at the time it reached "Tag" 

Example::

    // Start from all nodes, save them into start, follow any status links, and return the result.
    $> g.V().Tag("start").Out("<status>").All()
    {"id": "cool_person", "start": "<bob>"},
    {"id": "cool_person", "start": "<dani>"},
    {"id": "cool_person", "start": "<greg>"},
    {"id": "smart_person", "start": "<emily>"},
    {"id": "smart_person", "start": "<greg>"}


path.Out([predicatePath], [tags])
---------------------------------

predicatePath (Optional): One of::

    null or undefined: All predicates pointing out from this node
    a string: The predicate name to follow out from this node
    a list of strings: The predicates to follow out from this node
    a query path object: The target of which is a set of predicates to follow.

tags (Optional): One of::

    null or undefined: No tags
    a string: A single tag to add the predicate used to the output set.
    a list of strings: Multiple tags to use as keys to save the predicate used to the output set.

Example::

    $> g.V("<charlie>").All()
    {
      "result": [
        {
          "id": "<charlie>"
        }
      ]
    }
    // The working set of this is bob and dani
    $> g.V("<charlie>").Out("<follows>").All()
    {
      "result": [
        {
          "id": "<bob>"
        },
        {
          "id": "<dani>"
        }
      ]
    }

    // The working set of this is fred, as alice follows bob and bob follows fred.
    $> g.V("<alice>").Out("<follows>").Out("<follows>").All()
    {
      "result": [
        {
          "id": "<fred>"
        }
      ]
    }

    // Finds all things dani points at. Result is bob, greg and cool_person
    $> g.V("<dani>").Out().All()
    {
      "result": [
        {
          "id": "cool_person"
        },
        {
          "id": "<bob>"
        },
        {
          "id": "<greg>"
        }
      ]
    }

    // Finds all things dani points at on the status linkage.
    // Result is bob, greg and cool_person
    $> g.V("<dani>").Out(["<follows>", "<status>"]).All()
    等同于: g.V("<dani>").Out().All()

    // Finds all things dani points at on the status linkage, given from a separate query path.
    $> g.V("<dani>").Out(g.V("<status>"), "pred").All()
    {
      "result": [
        {
          "id": "cool_person",
          "pred": "<status>"
        }
      ]
    }

.. literalinclude:: ./demo.nq











